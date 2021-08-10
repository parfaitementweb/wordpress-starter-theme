<?php

namespace Starter;

use DirectoryIterator;
use Dotenv\Dotenv;

class Choke
{
    private static $instance = null;

    private function __construct()
    {
        $this->init();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Choke();
        }

        return self::$instance;
    }

    protected function init()
    {
        $this->load_environment();
        $this->clean_wordpress();
        $this->loadAcfBlocks();
    }

    protected function load_environment()
    {
        if (file_exists(get_template_directory() . '/.env')) {
            $dotenv = Dotenv::create(get_template_directory());
            $dotenv->load();
        }
    }

    protected function clean_wordpress()
    {
        define('DISALLOW_FILE_MODS', ! env('ALLOW_FILE_MODS', true));
        define('DISALLOW_FILE_EDIT', ! env('DISALLOW_FILE_EDIT', true));

        $files = glob(__DIR__ . '/clean_wordpress/*.php');
        collect($files)->each(function ($file) {
            $env_var = strtoupper(basename(str_replace('.php', '', $file)));
            if (env($env_var, true)) {
                require_once $file;
            }
        });
    }

    private function loadAcfBlocks()
    {
        if (function_exists('acf_register_block_type')) {
            add_action('acf/init', [$this, 'register_acf_block_types']);
        }

        // Fix an issue with wpauto ands ACF Blocks
        add_filter('render_block', function ($block_content, $block) {
            if (strpos($block['blockName'], 'acf') !== false) {
                remove_filter('the_content', 'wpautop');
                remove_filter('the_excerpt', 'wpautop');
            }

            return $block_content;
        }, 10, 2);
    }

    function register_acf_block_types()
    {
        foreach (new DirectoryIterator(__DIR__ . '/../template-parts/blocks') as $fileinfo) {
            if (! $fileinfo->isDot()) {
                $slug = str_replace('.php', '', $fileinfo->getFilename());

                $path = $fileinfo->getPath() . '/' . $fileinfo->getFilename();

                $file_headers = get_file_data($path, [
                    'title' => 'Title',
                    'description' => 'Description',
                    'category' => 'Category',
                    'icon' => 'Icon',
                    'keywords' => 'Keywords',
                    'jsx' => 'JSX',
                ]);

                if (empty($file_headers['title'])) {
                    die(_e('This block needs a title: ' . $path));
                }
                if (empty($file_headers['category'])) {
                    die(_e('This block needs a category: ' . $path));
                }

                $data = [
                    'name' => $slug,
                    'title' => $file_headers['title'],
                    'description' => $file_headers['description'],
                    'category' => $file_headers['category'],
                    'icon' => $file_headers['icon'],
                    'keywords' => explode(' ', $file_headers['keywords']),
                    'render_template' => 'template-parts/blocks/' . $slug . '.php',
                    'supports' => [
                        'align' => false,
                        'jsx' => $file_headers['jsx'] ?: false,
                    ],
                ];
                acf_register_block($data);
            }
        }
    }
}