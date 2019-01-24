# Wordpress Starter Theme, done *Parfaitement*.

This Wordpress starter theme is built with Modern PHP development practises in mind.

---

## Installation
From your `wp-content/themes` folder, execute the following command.

    php composer create-project parfaitement/wordpress-starter-theme yourtemplatename
    
    cd yourtemplatename
    npm install
    npm run watch
    
    # For production building: npm run production

---

> No specific footprint
---
This starter theme is based on the underscores.me file structure and only includes an additional and optional set of tools to ease your development.  
You will and can still develop your theme as any other basic Wordpress Theme.

---

## Views
Wordpress Templates views ending with `.blade.php` instead of the regular `.php` will be parsed using the [Laravel Blade](https://laravel.com/docs/5.7/blade) template engine.

We recommend placing all your templates in the `resources/views` folder, although default Wordpress location is supported.

## Controllers
You can execute and pass code for a specific template using a dedicated controller. This feature offers the C part of "MVC".

### How to use
1. All controllers are stored in the `app/controllers` folder.
2. The Class name and filename should be CamelCase and the same as the targeted Wordpress Template file. Example: `Single.php, Page.php, FrontPage.php`
3. The `view()`public function should returns an array with the data you want to pass to the template.
4. The controller is called automatically. No action from your part is needed.

The view() function offers additional features:
- Access The [Laravel HTTP Request](https://laravel.com/docs/5.7/requests) using `$this->$request`  
It's useful for retrieving input with `$this->request->input('name');` by exemple.
- Inject specific a CSS file for **this template only** using `$this->include_style()`
- Inject specific a JS file for **this template only** using `$this->include_script()`


## Assets
All assets are stored in the ``resources/assets`` folder. Normally as follow:

 - resources/assets/images
 - resources/assets/js
 - resources/assets/sass

Assets are compiled using [Laravel Mix](https://laravel-mix.com/docs/4.0/basic-example).  
Laravel Mix is a clean layer on top of webpack to make the 80% use case laughably simple to execute.

Out-of-the box, it includes:
- Minification & Compression
- JS with ES2017, Vue Support, Hot Replacement
- CSS Preprocessors. LESS, SASS, Stylus & PostCss
- Browsersync
- Cache-busting (Automatic versioning)

#### mix()
We've added support for the `mix()` helper for cache-busting from within your template.  
When using `$this->include_style()` or `$this->include_script()` in your controllers, your scripts ans styles will be automatically cache-busted.

#### Linking to assets from templates
Link your assets (images, icon, ...) using our custom `asset()` helper.

    <img src="{{ asset('/images/logo.png') }}" />`

## Classic Editor. Goodby Gutenberg.
Using the following command, you can download and install the [Classic Editor plugin](https://wordpress.org/plugins/classic-editor/) in your Wordpress default plugins folder.
>You still need to manually activate the plugin in the Plugins page.

    composer install

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
| HIDE_FRONTPAGE_ADMIN_ATTRS | true | hides the page attributes in the admin when editing the frontpage. |

## Helpers

Here is below a list of additional helpers you can use anywhere in your theme.

#### Collections.
We added support for [Laravel Collections](https://laravel.com/docs/5.5/collections).

#### Arrays & Strings
You can use any **Arrays & Objects** and **Strings** Laravel Helper listed here: https://laravel.com/docs/5.7/helpers

#### Dump & Die
We've also add support for the famous `dd()` ("dump and die") helper function. This function dumps the variables using dump() and immediately ends the execution of the script (using exit).