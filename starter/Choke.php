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

        // Register custom Editor Block Category
        add_action('block_categories', [$this, 'register_parfaitement_web_block_category'], 10, 2);

        // Auto Register all ACF JSON Blocks
        $dir = new DirectoryIterator(get_stylesheet_directory() . '/acf-json');
        foreach ($dir as $file) {
            if (! $file->isDot() && 'json' == $file->getExtension() && strpos($file->getFileName(), 'block_') !== false) {
                $array = json_decode(file_get_contents($file->getPathname()), true);
//                acf_add_local_field_group($array);
            }
        }
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
                    'mode' => 'Mode',
                    'jsx' => 'JSX',
                ]);

                if (empty($file_headers['title'])) {
                    die(_e('This block needs a title: ' . $path));
                }

                $data = [
                    'name' => $slug,
                    'title' => $file_headers['title'],
                    'description' => $file_headers['description'],
                    'category' => $file_headers['category'] ?: 'parfaitement-web',
                    'icon' => $file_headers['icon'] ?: 'schedule',
                    'mode' => $file_headers['mode'] ?: 'preview',
                    'keywords' => explode(' ', $file_headers['keywords']),
                    'render_template' => 'template-parts/blocks/' . $slug . '.php',
                    'supports' => [
                        'align' => false,
                        'align_text' => false,
                        'align_content' => false,
                        'jsx' => $file_headers['jsx'] ?: false,
                    ],
                    'example' => array(
                        'attributes' => array(
                            'mode' => 'preview',
                            'data' => array()
                        )
                    )
                ];
                acf_register_block($data);
            }
        }
    }

    function register_parfaitement_web_block_category($categories)
    {
        return array_merge(
            $categories,
            [
                [
                    'slug' => 'parfaitement-web',
                    'title' => __('Parfaitement Web', 'starter_theme'),
                ],
            ]
        );
    }
}