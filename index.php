<?php

/**
 * Kirby3 Gesetze - Linking german legal norms for Kirby v3
 *
 * @package   Kirby CMS
 * @author    S1SYPHOS <hello@twobrain.io>
 * @link      http://codeberg.org/S1SYPHOS\kirby3-gesetze
 * @version   1.0.0
 * @license   MIT
 */

@include_once __DIR__ . '/vendor/autoload.php';


/**
 * Links (valid) legal norms
 *
 * @param string $text Original (unprocessed) text
 * @return string Processed text
 */
function gesetzify(string $text): string
{
    # Create instance
    $object = new S1SYPHOS\Gesetze\Gesetz(option('kirby3-gesetze.drivers.preferred', 'gesetze'));

    # Set defaults
    $object->blockList  = option('kirby3-gesetze.drivers.blockList', []);
    $object->attributes = option('kirby3-gesetze.attributes', []);
    $object->title      = option('kirby3-gesetze.title', 'full');
    $object->validate   = option('kirby3-gesetze.validate', true);

    return $object->linkify($text);
}


Kirby::plugin('s1syphos/kirby3-ius', [
    'hooks' => [
        'kirbytext:after' => function (string $text): string
        {
            # Process text by all means when page template is allowlisted
            if (in_array(page()->intendedTemplate(), option('kirby3-gesetze.allowList', [])) === true) {
                return gesetzify($text);
            }

            # Leave text unmodified if ..
            # (1) .. plugin is disabled (default)
            if (!option('kirby3-gesetze.enabled', false)) {
                return $text;
            }

            # (2) .. page template is blocklisted
            if (in_array(page()->intendedTemplate(), option('kirby3-gesetze.blockList', [])) === true) {
                return $text;
            }

            return gesetzify($text);
        },
    ],
    'pageMethods' => [
        'gesetzify' => function (string $text): string
        {
            return gesetzify($text);
        },
        'analyzeNorm' => function (string $text): array
        {
            return S1SYPHOS\Gesetze\Gesetz::analyze($text);
        },
        'validateNorm' => function (string $text): bool
        {
            $object = new S1SYPHOS\Gesetze\Gesetz(option('kirby3-gesetze.drivers.preferred', 'gesetze'));

            return $object->validate($object::analyze($text));
        },
    ],
    'fieldMethods' => [
        'gesetzify' => function (Kirby\Cms\Field $field, bool $inline = false): string
        {
            return $inline ? $field->kti() : $field->kt();
        },
    ],
]);
