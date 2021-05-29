<img width="120" src="https://raw.githubusercontent.com/codebjorn/mjolnir/main/logo.png?token=AMTPZ3F6NAXEMZEZBYI2Q3LAWKWO4" />

# Mjölnir, WordPress Utility Framework

[![Generic badge](https://img.shields.io/badge/Version-0.0.1-<COLOR>.svg)](https://shields.io/)
[![Generic badge](https://img.shields.io/badge/Stability-Alpha-<COLOR>.svg)](https://shields.io/)

Mjölnir is small utility framework that gives utilities and possibilities to create WordPress plugins & themes using
best of PHP. This package is compliant with PSR-1, PSR-2, PSR-4 and PSR-11.

If you think this approach is not working, please open an issue and let's discuss :)

## Already made implementations

To see already made implementations please check official boilerplates:

- [Loki](https://github.com/codebjorn/loki) - WordPress Theme Boilerplate
- [Thor](https://github.com/codebjorn/thor) - WordPress Plugin Boilerplate

## Pre-Requirements

Before we proceed further:

1. I suggest you to read documentation of [PHP League Container](https://container.thephpleague.com/3.x/).  
   Mjölnir it uses as to provide Dependency Injection in your application.

2. Also, if you will use default template engine, check documentation of [BladeOne](https://github.com/EFTEC/BladeOne)

## Requirements

Requirements for this framework are:

- PHP 7.1+
- Composer

## Installation

You can install framework via composer:

```bash
composer require codebjorn/mjolnir
```

Copy stubs from folder `stubs` to your folder, rename `app` folder if is need it and update `{{namespace}}` with
application namespace

## In a nutshell

Base of framework is dependency injection container, that stores some utility classes for: configuration, render,
exception handling, hooks, blocks and all other services that you add and resolve, after all of that you add your
service to hook.

As example, you have class that add some WP functionality `PostTypes.php`, you resolve all dependencies
in `ServiceProvider` and after apply it to a hook

## Utilities

To explain how utilities works, let's take a look to each namespace that has utilities

#### Admin

Admin namespace contains utilities for add new features on admin side:

1. `Option.php` is a wrapper of functions related to Option Api, examples:

``` php
\Mjolnir\Admin\Option::get('someOption');
\Mjolnir\Admin\Option::update('someOption', 'someContent');
```

2. `Page.php` is a wrapper for all functions related to creating a page in admin, examples:

``` php
\Mjolnir\Admin\Page::dashboard('Page', 'Page', 'read', 'page');
\Mjolnir\Admin\Page::management('Page', 'Page', 'read', 'page');
```

#### Content

Content namespace contains utilities for creating different content solutions that WordPress has:

1. `PostType.php` allows you easy to create different custom post types, example:

``` php
$books = \Mjolnir\Content\PostType::make('Books')
    ->supports(['title', 'editor'])
    ->public(true)
    ->showInRest(true);

$books->register(); //Call register to exit creating of arguments
```

2. `Taxonomy.php` allows you easy to create different taxonomies, example:

``` php
$countries = \Mjolnir\Content\Taxonomy::make('Countries')
    ->postTypes(['books'])
    ->public(true)
    ->showInRest(true);

$countries->register(); //Call register to exit creating of arguments
```

3. `Shortcode.php` is a wrapper for functions related to Shortcode Api, example:

``` php
\Mjolnir\Content\Shortcode::add('hello', [$this, 'hello']);
\Mjolnir\Content\Shortcode::do('[hello]');
```

#### Database

Database namespace contains utilities for database interaction:

1. `Query.php` is a wrapper for WP Query arguments

``` php
$metaQuery = new \Mjolnir\Database\Parameter\Meta([
    new \Mjolnir\Database\Parameter\MetaArgument('key', 'value', 'NUMERIC', '='),
    new \Mjolnir\Database\Parameter\MetaArgument('key', 'value', 'DATE', '>'),
]);
$tax = new \Mjolnir\Database\Parameter\Tax(null, [
    new \Mjolnir\Database\Parameter\TaxArgument('taxonomy', 'field', 'term1'),
    new \Mjolnir\Database\Parameter\TaxArgument('taxonomy', 'field', 'term2'),
]);

$posts = new \Mjolnir\Database\Query();
$posts->postType('posts')
    ->meta($metaQuery)
    ->tax($tax)
    ->pagination(5);

$posts->make(); // return new WP_Query
$posts->get(); // returns Collection
$posts->getRaw(); //return Array
```

#### Routing

Routing namespace contains utilities related to routing system of WordPress such as Api:

1. `Api.php` is a wrapper of all functions related to REST API, example:

``` php
\Mjolnir\Routing\Api::make('/namespace', '/users')
    ->get([$this, 'getUsers'], '_return_true')
    ->post([$this, 'postUsers'], [$this, 'isAdmin']);
```

#### Support

Support namespace contains utilities that will help you work with data:

1. `Arr.php` is utility class that allows you to manipulate with array, examples:

``` php
$first = \Mjolnir\Support\Arr::first($array);
$key = \Mjolnir\Support\Arr::get($array, 'key');
```

2. `Collection.php` is class for working with arrays of data, examples:

``` php
$collection = \Mjolnir\Support\Collection::make($array);
$filtered = $collection->where('key', 'value');
$reversed = $filtered->reverse();
```

2. `Is.php` is wrapper for functions to determine type of variable, examples:

``` php
\Mjolnir\Support\Is::file($value);
\Mjolnir\Support\Is::str($value);
\Mjolnir\Support\Is::int($value);
```

3. `Str.php` is class to manipulate with string, examples:

``` php
$string = \Mjolnir\Support\Str::make('some string');
$reversed = $string->flip();
$contains = $string->has('some');
```

#### Utils

Utils namespace contains utilities for working with plugins and themes:

1. `Enqueue.php` is wrapper of functions related to enqueue, example:

``` php
\Mjolnir\Utils\Enqueue::style('theme-style', 'folder/style.css', [], '1.0.0', 'all');
\Mjolnir\Utils\Enqueue::script('theme-script', 'folder/script.css', [], '1.0.0', true);
\Mjolnir\Utils\Enqueue::all();
```

2. `Post.php` is wrapper of WP_Post that gives better API to get post, example:

``` php
$currentPost = \Mjolnir\Utils\Post::current();
$post = \Mjolnir\Utils\Post::get(1);
$postId = $post->getId();
$postSlug = $post->getSlug();
```

3. `Theme.php` is wrapper of functions related to theme, example:

``` php
\Mjolnir\Utils\Theme::support('feature');
\Mjolnir\Utils\Theme::textDomain('domain', 'path');
\Mjolnir\Utils\Theme::mod()->set('item', 'value');
\Mjolnir\Utils\Theme::mod()->get('item');
```

## Facades

Facades are API that allows you to create a class that will get resolved class from container, check `stubs/app/Facades`
to check default facades:

1. `Action.php` give access to action hook, example:

``` php
{{Namespace}}\Facades\Action::do('hook');
{{Namespace}}\Facades\Action::add('hook', [$this, 'function']);
{{Namespace}}\Facades\Action::group('hook')
    ->add([$this, 'function'])
    ->add(SomeClass::class)
    ->add(function () {
        echo "something todo";
    });
```

2. `Filter.php` give access to filter hook, example:

``` php
{{Namespace}}\Facades\Filter::apply('filter');
{{Namespace}}\Facades\Filter::add('filter', [$this, 'function']);
{{Namespace}}\Facades\Filter::group('filter')
    ->add([$this, 'function'])
    ->add(SomeClass::class)
    ->add(function () {
        echo "something todo";
    });
```

3. `Block.php` give access to class related to block, example:

``` php
{{Namespace}}\Facades\Block::add('namespace', 'name');
{{Namespace}}\Facades\Block::exists('namespace/name');
{{Namespace}}\Facades\Block::group('namespace')
    ->add('name')
    ->add('name');
```

4. `Config.php` give access to config files, example:

``` php
{{Namespace}}\Facades\Config::get('configFile.index.anotherIndex');
{{Namespace}}\Facades\Config::get('app.view.folder');
```

5. `View.php` give access to view file for render, example:

``` php
{{Namespace}}\Facades\View::render('books.single');
{{Namespace}}\Facades\View::render('books/single.blade.php');
```

### Testing

//TODO

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email quotesun@gmail.com instead of using the issue tracker.

## Credits

- [Dorin Lazar](https://github.com/quotesun)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
