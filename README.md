<h1 align="center">Nice plugin for <a href="https://github.com/craftcms">Craft CMS</a></h1>

<p align="center">
<img src="https://img.shields.io/badge/license-MIT-blue.svg?label=License" alt="License MIT"> <img alt="GitHub Repo stars" src="https://img.shields.io/github/stars/craft-plugins/nice?label=Stars"> <img alt="GitHub forks" src="https://img.shields.io/github/forks/craft-plugins/nice?label=Forks"> <a href="https://hitsofcode.com"><img alt="Hits of Code" src="https://hitsofcode.com/github/craft-plugins/nice?branch=1.x"></a>
</p>

A nice plugin with nice functions for nice data representation :)

## Requirements

* **Craft CMS**: ^4.0
* **PHP**: ^8.0

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:
    ```
    cd /path/to/project
    ```

2. In your terminal run `composer require craft-plugins/nice`.

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Nice.

### Usage

Display nice file size in the twig tempalates:

```
//=> 1 MB
{{ niceFileSize(1000000) }}

//=> 976.56 KiB
{{ niceFileSize(1000000, false) }}

//=> 1 MB
{{ 1000000 | niceFileSize }}

//=> 976.56 KiB
{{ 1000000 | niceFileSize(false) }}
```

Display nice number in the twig tempalates:

```
//=> 10,050,050
{{ niceNumber(10050050) }}

//=> 10,050,050.00
{{ niceNumber(10050050, 2) }}

//=> 10,050,050/00
{{ niceNumber(10050050, 2, '/') }}

//=> 10:050:050/00
{{ niceNumber(10050050, 2, '/', ':') }}

//=> 10,050,050
{{ 10050050 | niceNumber() }}

//=> 10,050,050.00
{{ 10050050 | niceNumber(2) }}

//=> 10,050,050/00
{{ 10050050 | niceNumber(2, '/') }}

//=> 10:050:050/00
{{ 10050050 | niceNumber(2, '/', ':') }}
```

Display nice date time in the twig tempalates:

```
//=> November 23, 2022, 4:24 am
{{ niceDateTime(1669177469) }}

//=> November 23, 2022, 4:24 am
{{ 1669177469 | niceDateTime }}


Display nice file name in the twig tempalates:

```
//=> foo-bar
{{ niceFileName('foo bar') }}

//=> foo-bar
{{ 'foo bar' | niceFileName }}
```

Use Nice `niceDateTime` function in the PHP:

```php
use function CraftPlugins\Nice\niceDateTime;

echo niceDateTime(1669177469);
```

## LICENSE
[The MIT License (MIT)](https://github.com/craft-plugins/nice/blob/master/LICENSE.md)
Copyright (c) [Sergey Romanenko](https://awilum.github.io/)
