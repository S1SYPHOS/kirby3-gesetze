# Kirby3 Gesetze
[![Release](https://img.shields.io/github/release/S1SYPHOS/kirby3-gesetze.svg)](https://github.com/S1SYPHOS/kirby3-gesetze/releases) [![License](https://img.shields.io/github/license/S1SYPHOS/kirby3-gesetze.svg)](https://github.com/S1SYPHOS/kirby3-gesetze/blob/main/LICENSE) [![Issues](https://img.shields.io/github/issues/S1SYPHOS/kirby3-gesetze.svg)](https://github.com/S1SYPHOS/kirby3-gesetze/issues)

This plugin automatically links german legal norms - GDPR-friendly, no strings (= API calls) attached, powered by [`php-gesetze`](https://github.com/S1SYPHOS/php-gesetze).


## Getting started

Use one of the following methods to install & use `kirby3-gesetze`:


### Git submodule

If you know your way around Git, you can download this plugin as a [submodule](https://github.com/blog/2104-working-with-submodules):

```text
git submodule add https://github.com/S1SYPHOS/kirby3-gesetze.git site/plugins/kirby3-gesetze
```


### Composer

```text
composer require s1syphos/kirby3-gesetze
```


### Clone or download

1. [Clone](https://github.com/S1SYPHOS/kirby3-gesetze.git) or [download](https://github.com/S1SYPHOS/kirby3-gesetze/archive/main.zip) this repository.
2. Unzip / Move the folder to `site/plugins`.


## Usage

Quick demonstration:

This markdown `text` content ..

```md
This is a **simple** HTML text. It contains legal norms, like Art. 12 I GG and § 433 II BGB!
```

.. easily ..

```php
# .. via `kirbytext()` ..
echo $page->text()->kt()

# .. or page method ..
echo $page->gesetzify($text);

# .. or field method ..
echo $page->text()->gesetzify();
```

.. becomes:

```html
<p>
  This is a <strong>simple</strong> HTML text. It contains legal norms, like <a href="https://www.gesetze-im-internet.de/gg/art_12.html" target="_blank">Art. 12 I GG</a> or <a href="https://www.gesetze-im-internet.de/bgb/__433.html" target="_blank">§ 433 II BGB</a>!
</p>
```


## Configuration

You may change certain options from your `config.php` globally (`'kirby3-gesetze.optionName'`):

| Option                | Type   | Default     | Description                       |
| --------------------- | ------ | ----------- | --------------------------------- |
| `'enabled'`           | bool   | `false`     | Enables `kirbytext:after` hook    |
| `'allowList'`         | array  | `[]`        | Allowed template names            |
| `'blockList'`         | array  | `[]`        | Blocked template names            |
| `'attributes'`        | array  | `[]`        | Controls HTML attributes          |
| `'validate'`          | bool   | `true`      | Enable/disable validation         |
| `'title'`             | string | `'full'`    | Controls `title` attribute. Possible values: `false`, `'light'`, `'normal'`, `'full'` |
| '`drivers.preferred`' | string | `'gesetze'` | Preferred driver. Possible values: `'gesetze'`, `'dejure'`, `'buzer'`, `'lexparency'` |
| '`drivers.blockList`' | array  | `[]`        | Unallowed driver(s). Possible values: see `drivers.preferred` |

When enabling the plugin via `kirby3-gesetze.enabled`, auto-linking is applied to all `kirbytext()` / `kt()` calls, with two exceptions:

1. If a page's `intendedTemplate()` name is allow(list)ed, this overrides `kirby3-gesetze.enabled` being `false`
1. If a page's `intendedTemplate()` name is block(list)ed, this overrides `kirby3-gesetze.enabled` being `true`

Besides that, there are additional methods you can use:


## Methods

There are several ways to do this, you can either use a standalone function, a page method or a field method:


### Method: `gesetzify(string $text): string`

Processes (valid) legal norms throughout given text


### Page method: `$page->gesetzify(string $text)`

Same as `gesetzify`


### Field method: `$field->gesetzify(string $text, bool $inline = false)`

Same as `gesetzify`, but supports applying `kt()` / `kti()` via `$inline` option.


## Roadmap

- [ ] Add tests


## Credits / License

`kirby3-gesetze` is based on [`php-gesetze`](https://github.com/S1SYPHOS/php-gesetze) library. It is licensed under the [MIT License](LICENSE), but **using Kirby in production** requires you to [buy a license](https://getkirby.com/buy).


## Special Thanks

I'd like to thank everybody that's making great software - you people are awesome. Also I'm always thankful for feedback and bug reports :)
