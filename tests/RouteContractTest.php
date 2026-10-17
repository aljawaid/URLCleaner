<?php

/**
 * Verifies native route discovery and compatibility-aware plugin aliases.
 *
 * Related files: Plugin.php and Helper/CleanURLHelper.php.
 */

$root = dirname(__DIR__);
$pluginSource = file_get_contents($root . '/Plugin.php');
$helper = $container['helper']->cleanURLHelper;
$coreRoutes = $helper->newCoreRoutes();
$pluginRoutes = $helper->newPluginRoutes();
$definitions = $helper->getPluginRouteDefinitions();

urlCleanerAssertTrue(count($coreRoutes) >= 20, 'Current Kanboard native routes must be resolved dynamically.');
urlCleanerAssertSame(array(), $pluginRoutes, 'No plugin routes should appear when supported plugins are absent.');

$resolvedByRequest = array();
foreach ($coreRoutes as $route) {
    $resolvedByRequest[$route['before_route']] = $route['after_route'];
}

urlCleanerAssertSame(
    '/list/37/search/status%3Aopen',
    $resolvedByRequest['?controller=TaskListController&action=show&project_id=37&search=status%3Aopen'],
    'The catalogue must use Kanboard current task-list route instead of a stale guessed path.'
);
urlCleanerAssertSame(
    '/board/37/search/status%3Aopen',
    $resolvedByRequest['?controller=BoardViewController&action=show&project_id=37&search=status%3Aopen'],
    'The catalogue must use Kanboard current board route instead of a stale guessed path.'
);

$definitionKeys = array();
foreach ($definitions as $definition) {
    $key = implode('|', array(
        $definition['plugin_name'],
        $definition['controller'],
        $definition['action'],
        $definition['path'],
    ));
    urlCleanerAssertFalse(isset($definitionKeys[$key]), 'Plugin route definitions must be unique.');
    $definitionKeys[$key] = true;
    urlCleanerAssertNotContains('/help', $definition['path'], 'Retired generic Wiki help aliases must not return.');
}

urlCleanerAssertNotContains("APP_VERSION < '1.2.28'", $pluginSource, 'Unsupported legacy core route overrides must be removed.');
urlCleanerAssertContains(
    'registerPluginRoutes()',
    $pluginSource,
    'Enabled plugin aliases must be registered through the single helper registry.'
);
