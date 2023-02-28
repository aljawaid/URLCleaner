<?php

namespace Kanboard\Plugin\URLCleaner;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        // CSS - Asset Hook
        //  - Keep filename lowercase
        $this->hook->on('template:layout:css', array('template' => 'plugins/URLCleaner/Assets/css/url-cleaner.css'));

        // Views - Add Menu Item - Template Hook
        //  - Override name should start lowercase e.g. pluginNameExampleCamelCase
        $this->template->hook->attach('template:config:sidebar', 'uRLCleaner:config/sidebar');

        // Extra Page - Routes
        //  - Example: $this->route->addRoute('/my/custom/route', 'MyController', 'show', 'PluginNameExampleStudlyCaps');
        //  - Must have the corresponding action in the matching controller
        $this->route->addRoute('/settings/url-cleaner', 'URLCleanerController', 'show', 'URLCleaner');

        if ($this->configModel->get('clean-url-options', '') == 'enable') {
            // CORE
            $this->route->addRoute('/project/:project_id/task/:task_id/move', 'TaskMovePositionController', 'show');
            $this->route->addRoute('/my-activity', 'ActivityController', 'user');
            $this->route->addRoute('/project/:project_id/overview/:search', 'ProjectOverviewController', 'show');
            $this->route->addRoute('/user/:user_id/notifications/show', 'WebNotificationController', 'show');
            $this->route->addRoute('/board/:project_id/:search', 'BoardViewController', 'show');
            $this->route->addRoute('/project/:project_id/task/:task_id/edit', 'TaskModificationController', 'edit');
            $this->route->addRoute('/settings/email', 'ConfigController', 'email');
            $this->route->addRoute('/settings/link-labels', 'LinkController', 'show');
            $this->route->addRoute('/settings/currencies', 'CurrencyController', 'show');

            //PLUGINS
            $this->route->addRoute('/bigboard', 'Bigboard', 'index', 'Bigboard');
            $this->route->addRoute('/help', 'WikiController', 'index', 'Wiki');
            $this->route->addRoute('/help', 'WikiController', 'index', 'wiki');
            $this->route->addRoute('/help/overview/:search', 'WikiController', 'index', 'wiki');
            $this->route->addRoute('/help/project/:project_id/show/:search', 'WikiController', 'show', 'wiki');
            $this->route->addRoute('/help/project/:project_id/create', 'WikiController', 'create', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/show', 'WikiController', 'detail', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/show', 'WikiController', 'detail', 'Wiki');
            $this->route->addRoute('/help/page/:wiki_id/edit', 'WikiController', 'edit', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/attach', 'WikiFileController', 'create', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/delete', 'WikiController', 'confirm', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/editions', 'WikiController', 'editions', 'wiki');
            $this->route->addRoute('/help/project/:project_id/page/:wiki_id/editions/restore/:edition', 'WikiController', 'confirm_restore', 'wiki');
            $this->route->addRoute('/settings/wiki', 'ConfigController', 'show', 'Wiki');
            $this->route->addRoute('/my-calendar', 'CalendarController', 'user', 'Calendar');
            $this->route->addRoute('/settings/calendar', 'ConfigController', 'show', 'Calendar');
            $this->route->addRoute('/project/:project_id/calendar/:search', 'CalendarController', 'project', 'Calendar');
        }

        // Helper
        //  - Example: $this->helper->register('helperClassNameCamelCase', '\Kanboard\Plugin\PluginNameExampleStudlyCaps\Helper\HelperNameExampleStudlyCaps');
        //  - Add each Helper in the 'use' section at the top of this file
        $this->helper->register('cleanURLHelper', '\Kanboard\Plugin\URLCleaner\Helper\CleanURLHelper');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        // Plugin Name MUST be identical to namespace for Plugin Directory to detect updated versions
        // Do not translate the plugin name here
        return 'URLCleaner';
    }

    public function getPluginDescription()
    {
        return t('This simple tool extends the rewriting of browser URLs for your Kanboard application. Sanitize those long URLs automatically creating neat pretty easy to remember bookmarks. This plugin extends URLs from the core and from plugins. URL Rewriting must be correctly configured for this plugin to function properly.
');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        // Examples:
        // >=1.0.37
        // <1.0.37
        // <=1.0.37
        return '>=1.2.20';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/URLCleaner';
    }
}
