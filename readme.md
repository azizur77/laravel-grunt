> Please note that this project is a [Grunt](http://gruntjs.com/) version of [Jeffrey Way](http://jeffrey-way.com/)'s [Laravel-Guard](https://github.com/JeffreyWay/Laravel-Guard) package. 

[![Build Status](https://travis-ci.org/codenexus/laravel-grunt.png?branch=develop)](https://travis-ci.org/codenexus/laravel-grunt)
[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)


# Instant Compilation, Concatenation, and Minification in Laravel 4 (Alpha) 

[Prefer a video overview?](https://dl.dropbox.com/u/774859/GitHub-Repos/laravel-guard-intro.mp4)

This plugin improves asset management in Laravel, by:

- Compiling Sass or Less files automatically
- Compiling CoffeeScript
- Automatically running tests on save
- Concatenating and minifying JavaScript and CSS (if not using a preprocessor)
- Instant browser refreshing


## Installation

> Before continuing, this package requires NPM. Please install this first.

Install this package through Composer. To your `composer.json` file, add:

```js
"require-dev": {
	"codenexus/laravel-grunt": "dev-master"
}
```

Next, run `composer install --dev` to download it.

Finally, add the service provider to `app/config/app.php`, within the `providers` array.

```php
'providers' => array(
	// ...

	'Codenexus\LaravelGrunt\LaravelGruntServiceProvider'
)
```

That's it! Run `php artisan` to view the three new Grunt commands:

- **grunt:make** - Create a new Gruntfile, and specify desired preprocessors
- **grunt:watch** - Begin watching filesystem for changes, and run tests
- **grunt:refresh** - Refresh your grunt file

## Creating a Gruntfile

The first step is to install the necessary dependencies (done automatically for you), and create the Gruntfile. Run `php artisan grunt:make` to do this as quickly as possible. Once you answer the questions, a new `Gruntfile` will be added to the root of your project.

## Configuring Paths

Unless you specify custom paths for these directories, Grunt-Laravel will use sensible defaults.

- **Sass**: app/assets/sass
- **Less**: app/assets/less
- **CoffeeScript**: app/assets/coffee
- **JS**: public/js
- **CSS**: public/css

To override these defaults, publish the default configuration options to your `app/config` directory. You'll only have to do this once per project, of course.

```bash
php artisan config:publish codenexus/laravel-grunt
```

You may now edit these options at `app/config/packages/codenexus/laravel-grunt/config.php`. When you do, your Gruntfile will automatically update to reflect the changes.

## Sass/Less/CoffeeScript Compilation

After you've generated a Gruntfile with `php artisan grunt:make` (which will also download any necessary dependencies), you'll see a new `app/assets` directory. This is where your Sass/Less/CoffeeScript files will be stored. Try creating a new file, `app/assets/sass/buttons.sass`, and add:

```css
.button
  background: red
```

If you save the file, nothing will happen. We have to tell Grunt to begin watching the filesystem. Run `php artisan grunt:watch` to do so. Now, save the file again, and you'll find the compiled output within `public/css/buttons.css`. This same process will be true for compiling Less (if you choose that option) as well as CoffeeScript.


## Concatenation and Minification

By default, when concatenating JavaScript and CSS, this package will simply grab all of the files in their respective directories, and concatenate them in, essentially, random order. Most of the time, this won't be acceptable.

When you need to specify the order, do so in `app/config/packages/codenexus/laravel-grunt/config.php` (which we created above). Within this file, edit `js_concat` and `css_concat` to contain a list of the files, in order, that you want to merge and minify.

```php
js_concat => ['module1', 'module2', 'module3']
```

## LiveReloading

This package also includes support for live reloading the browser when you make changes to stylesheets, JavaScripts, or Blade files.

To make use of it, you only need to install the necessary LiveReload extension for your browser of choice. [See here for a list of options.](http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-).

> One important note is that, for Chrome, you need to visit *chrome://extensions/* and check "*Allow access to file URLs*."

Once installed, run your server and click the LiveReload icon next to your address bar.

## Continuous Testing

When you run `php artisan grunt:watch`, in addition to compiling assets, it will also automatically run your tests when applicable files are saved.

Grunt will run PHPUnit:

1. When any test within `app/tests` is saved
2. When a view file is saved, all tests will run. You may want to update this to only run integration tests
3. When any class file is saved, it will attempt to find an associated test and call it. For example, save `app/models/User.php`, and it will test `app/tests/models/UserTest.php`.


## Grunt Plugin Options

Unless adding new or custom Grunt plugins, you should never modify the Gruntfile. This is because many of the settings are generated dynamically. In the instances when you want to add options for a plugin (such as selecting compressed Sass over the default nested), specify them as an array within `app/config/packages/codenexus/laravel-grunt/config.php`.

Set the key to the name of the grunt plugin (see the Gruntfile) The value should be an array of config options. Refer to the plugin readmes on GitHub for a full list of options. Below is an example for [Sass config](https://github.com/gruntjs/grunt-contrib-sass).

```php
'grunt_options' => array(
	'sass' => array(
		'lineNumbers' => true,
		'style' => ':compressed'
	)
)
```

## View Helpers

This package also includes two global helper functions: `stylesheet()` and `script()`. Without any arguments, these two functions spit out the necessary HTML for a stylesheet and script, respectively, using the concatenated/minified file as its `href`/`src`.

```php
{{ stylesheet() }}
```

Will create:

```html
<link rel="stylesheet" href="/css/styles.min.css">
```

And:

```php
{{ script() }}
```

Will create:

```html
<script src="/js/scripts.min.js"></script>
```

You can optionally pass an argument to either of these functions, which should reference a file name that is relative to what you have set under `js_path` or `css_path` in the configuration file. For example, to pull in the stylesheet, `public/css/normalize.css`, and assuming that `css_path` is set to `public/css`, simply do:

```php
{{ stylesheet('normalize.css') }}
```

This will produce:

```html
<link rel="stylesheet" href="/css/normalize.css">
```

## Workflow

Here's a basic bit of workflow for a new project. First, install package through Composer. Then:

```bash
# Create a new grunt file
php artisan grunt:make

# Publish config options to tailor to your project
php artisan config:publish codenexus/laravel-grunt

# Begin watching filesystem for changes
php artisan grunt:watch

# Edit Sass or CoffeeScript file, and watch it auto-compile
# Edit a test, and PHPUnit fires

# Update js_concat to an ordered list of your JS files. Now, they'll be concatenated in
# that exact order.
```

Have fun!