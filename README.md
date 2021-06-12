# CodeIgniter 4 Encore

[![Latest Version on Packagist](https://img.shields.io/packagist/v/friendsofcodeigniter/encore_codeigniter4.svg?style=flat-square)](https://packagist.org/packages/friendsofcodeigniter/encore_codeigniter4)
![Tests](https://github.com/friendsofcodeigniter/encore-codeigniter4/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofcodeigniter/encore_codeigniter4.svg?style=flat-square)](https://packagist.org/packages/friendsofcodeigniter/encore_codeigniter4)

This package is a CodeIgniter 4 port from  [symfony/webpack-encore-bundle](https://github.com/symfony/webpack-encore-bundle)

work in progress

## Requirements

- PHP 8.0+
- CodeIgniter 4.1.3+

## Installation

You can install the package via composer:

```bash
composer require friendsofcodeigniter/encore_codeigniter4

```
Installing [Webpack Encore](https://symfony.com/doc/current/frontend/encore/installation.html#installing-encore-in-non-symfony-applications)
```bash
yarn add @symfony/webpack-encore --dev
or
npm install @symfony/webpack-encore --save-dev
```

## Usage
Loading the [helper](https://www.codeigniter.com/user_guide/general/helpers.html?#loading-a-helper)
```php
helper('Friendsofcodeigniter\Encore\encore');
```

Example webpack.config.js
```js
// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')

    .addEntry('app', './assets/app.js')

    // ...
;

// ...
```

Example view file

```html
<!DOCTYPE html>
<html>
<head>
    <?= encore_entry_link_tags('app')?>
    
</head>
<body>
...
<?= encore_entry_script_tags('app')?>
</body>
</html>
```

or

```php
<!DOCTYPE html>
<html>
<head>
    <?php foreach (encore_entry_css_files('main') as $cssFiles): ?>
    <link rel="stylesheet" href="<?=$cssFiles?>">
    <?php endforeach; ?>
</head>
<body>
...
<?php foreach (encore_entry_js_files('main') as $jsFile): ?>
<script src="<?=$jsFile?>"></script>
<?php endforeach; ?>
</body>
</html>
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
