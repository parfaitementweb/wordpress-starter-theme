<?php

namespace Starter;

use DirectoryIterator;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;

class Choke
{
    private static $instance = null;

    public $container = null;

    public $request = null;

    public $validation = null;

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
        $this->container = new Container();

        $this->load_environment();
        $this->load_validation();
        $this->clean_wordpress();

//        $this->login_and_register();

        $this->loadAcfBlocks();

        $this->request = Request::capture();
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

    public function load_validation()
    {
        $wp_locale = substr(get_locale(), 0, 2);
        $locale = in_array($wp_locale, ['fr', 'nl', 'en']) ? $wp_locale : 'en';

        $loader = new FileLoader(new Filesystem, __DIR__ . '/lang');
        $translator = new Translator($loader, $locale);
        $this->validation = new ValidationFactory($translator, $this->container);
    }

    private function login_and_register()
    {
        add_action('after_setup_theme', function () {
            foreach ([['title' => 'Login Page', 'name' => 'login', 'env' => 'LOGIN_PAGE'], ['title' => 'Registration Page', 'name' => 'register', 'env' => 'REGISTER_PAGE']] as $page) {
                if ((new \WP_Query(['post_type' => 'page', 'pagename' => $page['name'],]))->post_count == 0) {
                    $data = array(
                        'post_title' => $page['title'],
                        'post_content' => '',
                        'post_status' => 'publish',
                        'post_author' => 1,
                        'post_type' => 'page',
                        'post_name' => $page['name']
                    );

                    if (env($page['env'], false)) {
                        wp_insert_post($data);
                    }
                }
            }
        });
    }

    private function loadAcfBlocks()
    {
        if (function_exists('acf_register_block_type')) {
            add_action('acf/init', [$this, 'register_acf_block_types']);
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