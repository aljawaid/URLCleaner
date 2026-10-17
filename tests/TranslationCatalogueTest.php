<?php

/**
 * Verifies complete English catalogues and a clean translation starter.
 *
 * Related files: Locale/en_GB/translations.php, Locale/en_US/translations.php
 * and Locale/translations-starter-template.php.
 */

$root = dirname(__DIR__);
$starterPath = $root . '/Locale/translations-starter-template.php';
$starterSource = file_get_contents($starterPath);
$requiredStrings = array(
    'URL Cleaner',
    'Route behavior information',
    'Native Kanboard URLs',
    'Installed plugin URLs',
    'Enable plugin aliases',
    'No supported plugin routes are currently available. Install a supported plugin to see its routes here.',
    'Select whether clean URLs should be enabled or disabled.',
);

urlCleanerAssertTrue(strpos($starterSource, '<?php') === 0, 'The translation starter must begin with PHP without stray HTML.');

foreach (array('en_GB', 'en_US') as $locale) {
    $catalogue = require $root . '/Locale/' . $locale . '/translations.php';

    foreach ($requiredStrings as $string) {
        urlCleanerAssertTrue(isset($catalogue[$string]), $locale . ' is missing a required source string.');
        urlCleanerAssertTrue($catalogue[$string] !== '', $locale . ' contains an empty required translation.');
    }
}
