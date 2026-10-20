<?php

namespace Kanboard\Plugin\URLCleaner;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;
use Kanboard\Core\Translator;

/**
 * Registers URLCleaner settings, helpers and compatibility-aware plugin routes.
 *
 * Related tests: tests/AuthorizationContractTest.php,
 * tests/RouteContractTest.php and tests/PluginIntegrationTest.php.
 */
class Plugin extends Base
{
    public function initialize()
    {
        // URL settings affect the whole application and must remain administrator-only.
        $this->applicationAccessMap->add('URLCleanerController', '*', Role::APP_ADMIN);

        // Keep the stylesheet globally available, but scope every selector to the settings page.
        $this->hook->on('template:layout:css', array('template' => 'plugins/URLCleaner/Assets/css/url-cleaner.css'));

        // Add the administrator settings entry and its clean URL.
        $this->template->hook->attach('template:config:sidebar', 'uRLCleaner:config/sidebar');
        $this->route->addRoute('/settings/url-cleaner', 'URLCleanerController', 'show', 'URLCleaner');

        // The helper owns the single route registry used by registration and presentation.
        $this->helper->register('cleanURLHelper', '\Kanboard\Plugin\URLCleaner\Helper\CleanURLHelper');
    }

    public function onStartup()
    {
        // Load a complete English fallback before applying an available locale override.
        Translator::load('en_US', __DIR__ . '/Locale');

        $language = $this->languageModel->getCurrentLanguage();
        if ($language !== 'en_US') {
            Translator::load($language, __DIR__ . '/Locale');
        }

        if ($this->configModel->get('clean-url-options', 'disable') === 'enable' && ENABLE_URL_REWRITE) {
            // Startup runs after every installed plugin has registered its own native routes.
            $this->helper->cleanURLHelper->registerPluginRoutes();
        }
    }

    public function getPluginName()
    {
        // Plugin Name MUST be identical to namespace for Plugin Directory to detect updated versions - do not translate the plugin name here
        return 'URLCleaner';
    }

    public function getPluginDescription()
    {
        return t('Provide clean URL aliases for supported Kanboard plugins while showing the native clean routes already supplied by Kanboard. URL rewriting must be configured before aliases can be enabled.');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '3.0.3';
    }

    public function getCompatibleVersion()
    {
        // The compatibility workflow and focused regression suite run against this baseline.
        return '>=1.2.54';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/URLCleaner';
    }
}
