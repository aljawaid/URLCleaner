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
            $this->route->addRoute('/project/:project_id/board/:search', 'BoardViewController', 'show');
            $this->route->addRoute('/project/:project_id/task/:task_id/edit', 'TaskModificationController', 'edit');
            $this->route->addRoute('/settings/email', 'ConfigController', 'email');
            $this->route->addRoute('/settings/link-labels', 'LinkController', 'show');
            $this->route->addRoute('/settings/currencies', 'CurrencyController', 'show');
            $this->route->addRoute('/project/:project_id/task/list/:search', 'TaskListController', 'show');
            $this->route->addRoute('/project/:project_id/task/:task_id/recurrence/edit', 'TaskRecurrenceController', 'edit');
            $this->route->addRoute('/project/:project_id/task/:task_id/subtask/add', 'SubtaskController', 'create');
            $this->route->addRoute('/project/:project_id/task/:task_id/link/internal/add', 'TaskInternalLinkController', 'create');
            $this->route->addRoute('/project/:project_id/task/:task_id/link/external/add', 'TaskExternalLinkController', 'find');
            $this->route->addRoute('/project/:project_id/task/:task_id/comments/add', 'CommentController', 'create');
            $this->route->addRoute('/project/:project_id/task/:task_id/files/attach', 'TaskFileController', 'create');

            //PLUGINS
            $this->route->addRoute('/bigboard', 'Bigboard', 'index', 'Bigboard');
            $this->route->addRoute('/help', 'WikiController', 'index', 'Wiki');
            $this->route->addRoute('/help', 'WikiController', 'index', 'wiki');
            $this->route->addRoute('/help/overview/:search', 'WikiController', 'index', 'wiki');
            $this->route->addRoute('/project/:project_id/help/show/:search', 'WikiController', 'show', 'wiki');
            $this->route->addRoute('/project/:project_id/help/create', 'WikiController', 'create', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/show', 'WikiController', 'detail', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/show', 'WikiController', 'detail', 'Wiki');
            $this->route->addRoute('/help/page/:wiki_id/edit', 'WikiController', 'edit', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/attach', 'WikiFileController', 'create', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/delete', 'WikiController', 'confirm', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/editions', 'WikiController', 'editions', 'wiki');
            $this->route->addRoute('/project/:project_id/help/page/:wiki_id/editions/restore/:edition', 'WikiController', 'confirm_restore', 'wiki');
            $this->route->addRoute('/settings/wiki', 'ConfigController', 'show', 'Wiki');
            $this->route->addRoute('/my-calendar', 'CalendarController', 'user', 'Calendar');
            $this->route->addRoute('/settings/calendar', 'ConfigController', 'show', 'Calendar');
            $this->route->addRoute('/project/:project_id/calendar/:search', 'CalendarController', 'project', 'Calendar');
            $this->route->addRoute('/settings/custom-fields', 'MetadataTypesController', 'config', 'MetaMagik');
            $this->route->addRoute('/settings/custom-fields/:key/edit', 'MetadataTypesController', 'editType', 'metaMagik');
            $this->route->addRoute('/settings/custom-fields/:key/delete', 'MetadataTypesController', 'confirmTask', 'metaMagik');
            $this->route->addRoute('/project/:project_id/metadata', 'MetadataController', 'project', 'metaMagik');
            $this->route->addRoute('/project/:project_id/task/:task_id/metadata', 'MetadataController', 'task', 'metaMagik');
            $this->route->addRoute('/user/:user_id/metadata', 'MetadataController', 'user', 'metaMagik');
            $this->route->addRoute('/user/:user_id/metadata/:key/edit', 'MetadataController', 'editUser', 'metaMagik');
            $this->route->addRoute('/user/:user_id/metadata/:key/delete', 'MetadataController', 'confirmUser', 'metaMagik');
            $this->route->addRoute('/project/:project_id/analytics/metadata/total', 'AnalyticExtensionController', 'fieldTotalDistribution', 'metaMagik');
            $this->route->addRoute('/project/:project_id/analytics/metadata/range', 'AnalyticExtensionController', 'fieldTotalDistributionRange', 'metaMagik');
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
        return t('This simple tool extends the rewriting of browser URLs for your Kanboard application. Sanitize those long URLs automatically creating neat pretty easy to remember bookmarks. This plugin extends URLs from the core and from plugins. URL Rewriting must be correctly configured for this plugin to function properly.');
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
