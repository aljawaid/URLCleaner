<?php

/**
 * Verifies responsive, theme-aware and accessible settings presentation.
 *
 * Related files: Assets/css/url-cleaner.css and Template/config/*.php.
 */

$root = dirname(__DIR__);
$stylesheet = file_get_contents($root . '/Assets/css/url-cleaner.css');
$settingsTemplate = file_get_contents($root . '/Template/config/url-cleaner.php');
$sidebarTemplate = file_get_contents($root . '/Template/config/sidebar.php');

$presentationContracts = array(
    'var(--panel-background-color)',
    'var(--button-primary-background-color)',
    '@media (max-width: 780px)',
    '@media (prefers-reduced-motion: reduce)',
    '--url-cleaner-transition: 180ms ease-in-out',
    'overflow-x: auto',
    'url("../icons/url-cleaner-icon.svg")',
    'url("../icons/app-icon.svg")',
    'url("../icons/plugin-icon.svg")',
);

foreach ($presentationContracts as $contract) {
    urlCleanerAssertContains($contract, $stylesheet, 'The presentation contract is incomplete.');
}

urlCleanerAssertNotContains(
    '@media (prefers-color-scheme: dark)',
    $stylesheet,
    'The selected Kanboard theme must not be overridden by the operating-system colour preference.'
);

urlCleanerAssertContains('fa-info-circle', $settingsTemplate, 'Complex route behavior must include an information popover.');
urlCleanerAssertContains('tooltipHTML', $settingsTemplate, 'The information control must use Kanboard tooltip behavior.');
urlCleanerAssertContains('rel="noopener noreferrer"', $settingsTemplate, 'External links must preserve opener and referrer privacy.');
urlCleanerAssertContains('url-cleaner-empty-state', $settingsTemplate, 'Missing supported plugins must render a clear empty state.');
urlCleanerAssertContains('$this->url->icon', $sidebarTemplate, 'The settings navigation must retain an accessible icon link.');

$renderedSettings = $container['template']->render('uRLCleaner:config/url-cleaner', array(
    'values' => array('clean-url-options' => 'enable'),
));
urlCleanerAssertContains('id="URLCleanerPage"', $renderedSettings, 'The settings page must render through Kanboard.');
urlCleanerAssertContains('Native Kanboard URLs', $renderedSettings, 'The native route catalogue must render separately.');
urlCleanerAssertContains('No supported plugin routes are currently available.', $renderedSettings, 'The plugin empty state must render.');
