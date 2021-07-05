# Wordpress Starter Theme, done *Perfectly*.

This Wordpress starter theme is built with Modern PHP development practises in mind.

## The starter theme includes out-of-the-box

- PHP **Composer** support
- Compiling views using **Laravel Blade**
- **Gutenberg Blocks** using ACF Blocks
- **Laravel Collections**
- Strings Helpers
- **Laravel Mix**  
- **Tailwind CSS** 2
- **Tailwind JIT** Compiler
- **PostCSS**
- PostCSS Nested
- PostCSS Import
---

[![Latest Version on Packagist](https://img.shields.io/packagist/v/parfaitementweb/wordpress-starter-theme.svg?style=flat-square)](https://packagist.org/packages/parfaitementweb/wordpress-starter-theme)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/parfaitementweb/wordpress-starter-theme.svg?style=flat-square)](https://packagist.org/packages/parfaitementweb/wordpress-starter-theme)

## Installation
Execute the following commands:

    cd wp-content/themes
    composer create-project parfaitementweb/wordpress-starter-theme
    composer install

    cd yourtemplatename
    npm install
    npm run watch

    # Build your assets for production using
    # npm run production
    # Read more about Laravel Mix on their official documentation.

---

## Passing data aka. Controllers
The starter theme includes a `theme/template/{$class}/data` filter that can be used to pass data to templates. This is the most simple way to pass data.

```
add_filter('theme/template/page/data', function (array $data) {
    $data['header_image'] = get_field('header_image');
    $data['header_content'] = get_field('header_content');
    return $data;
});
```


The [Laravel HTTP Request](https://laravel.com/docs/5.7/requests) is automatically injected in jour template view under the `$request` variable.
It's useful for retrieving input with `$request->input('name')` by exemple.
- Inject specific a CSS file for **this template only** using `$core->include_style()`
- Inject specific a JS file for **this template only** using `$core->include_script()`


## Views
Blade views `*.blade.php` are stored under the `resources/views` folder and are parsed using the [Laravel Blade](https://laravel.com/docs/5.7/blade) template engine.

## Assets
All assets are stored in the ``resources/assets`` folder. Normally as follow:

 - resources/assets/images
 - resources/assets/js
 - resources/assets/sass

Assets are compiled using [Laravel Mix](https://laravel-mix.com/docs/6.0/).
Laravel Mix is a clean layer on top of webpack to make the 80% use case laughably simple to execute.

CSS files are processed using *PostCSS*.

#### mix()
We've added support for the `mix()` helper for cache-busting from within your template.
When using `$core->include_style()` or `$core->include_script()` in your controllers, your scripts ans styles will be automatically cache-busted.

#### Linking to assets from templates
Link your assets (images, icon, ...) using our custom `asset()` helper.

    <img src="{{ asset('/images/logo.png') }}" />`

## Tailwind CSS
This theme comes with [Tailwind CSS](https://tailwindcss.com), an utility-CSS framework pre-installed. You can still remove it form the `package.json` dependencies and edit the CSS style as you like.  

> CSS files are processed using *POSTCSS* by default.
>
## Forms
Custom Form can be handle this way:

In your `page.php`

    $validator = $core->validation->make(
        $core->request->input(),
        [
            'name' => 'required',
            // other rules
        ]
    );

    if ($validator->fails()) {
        $errors = $validator->errors();
    }

    $data = [
        'errors' => $errors
    ];
    $core->render('page', $data);

In your page.blade.php

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ site_url() }}/wp-admin/admin-post.php" method="post">
            <?php wp_nonce_field('contact_form') ?>

            <input type="hidden" name="action" value="contact_form">
            <input type="text" name="name" placeholder="Your Name">

            <input type="submit" value="Submit">
        </form>

In `app/ContactForm/php`

    <?php

    namespace App;

    class ContactForm
    {
        public function __construct()
        {
            add_action('admin_post_nopriv_contact_form', [$this, 'handle_contact_form']);
            add_action('admin_post_contact_form', [$this, 'handle_contact_form']);
        }

        function handle_contact_form()
        {
            if (wp_verify_nonce($_POST['_wpnonce'], 'contact_form')) {
                $redirect = add_query_arg('form', 'success', site_url('contact'));
                wp_redirect($redirect);
            }
        }
    }

Add this in your `functions.php` under Custom Functions section.

    $contactForm = new \App\ContactForm();

### Validation
Our core had support for [Laravel Validation](https://laravel.com/docs/5.7/validation).

## Helpers
Here is below a list of additional helpers you can use anywhere in your theme.

#### Collections.
We added support for [Laravel Collections](https://laravel.com/docs/5.5/collections).

#### Arrays & Strings
You can use any **Arrays & Objects** and **Strings** Laravel Helper listed here: https://laravel.com/docs/5.7/helpers

#### Dump & Die
We've also add support for the famous `dd()` ("dump and die") helper function. This function dumps the variables using dump() and immediately ends the execution of the script (using exit).

## Custom Theme Functions

All PHP Class files placed under the `/app` folder will be autoloaded and accessible throughout your theme files. Use them for a convienent and testable place to store your custom logic.

    <?php

    namespace App;

    class Custom
    {
        public function get_articles()
        {
            return [
                'article' => 'foo',
                'title' => 'bar'
            ];
        }
    }

    ?>

    ## Usage
    $custom = new \App\Custom();
    $articles = $custom->get_articles();

## Gutenberg ACF Blocks
This starter theme supports ACF Blocks for easy Gutenberg Block creation. Please read the [ACF Blocks Documentation](https://www.advancedcustomfields.com/resources/blocks/) to learn how to proceed.
In this theme, the blocks are registered in the `inc/acf-blocks.php` file. Views for the blocks are rendered from the `/resources/views/blocks` folder.

> The Blocks views does not support Laravel Balde synthax. Regular PHP is needed.

## Cleaner Wordpress
We've included several classes to offer a cleaner version of Wordpress by default.

You can enable or disable any of them by copying the `.env.example` configuration file at the root of your theme folder to `.env` and customize its content with the following options:

| Option | Default | Description |
|---|---|---|
| DISABLE_COMMENTS | true | Disables all comments features |
| DISABLE_EMOJIS | true |  Disables emojis scripts |
| DISABLE_GENERATOR | true | Removes Generator meta tag |
| DISABLE_GUTENBERG_BLOCK | true | Removes Block Library scripts |
| DISABLE_OEMBED | true | Disable oEmebed scripts |
| HIDE_FRONTEND_TOOLBAR | true | Hides the admin toolbar on front and hides the option in the Profile Options page. |
| HIDE_FRONTPAGE_ADMIN_ATTRS | true | Hides the page attributes in the admin when editing the frontpage. |
| ADD_SLUG_BODY_CLASS | true | Add the current slug to the body classes list. |
| ALLOW_FILE_MODS | true | Allow file edition within the backoffice. When set to false it also prevents installing and updating themes and plugins manually. **We've updated the native Wordpress function to updates notifications are still displayed.** |
| MENU_CLASSES_BY_CONTEXT | true | Adds the menu items classes when using `wp_get_nav_menu_items` as it it the case with `wp_nav_menu`. |