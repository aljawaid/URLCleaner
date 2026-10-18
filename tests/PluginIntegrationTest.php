<?php

/**
 * Verifies URLCleaner metadata and helper registration against Kanboard.
 *
 * Related file: Plugin.php.
 */

$plugin = $loadedPlugins['URLCleaner'];

urlCleanerAssertSame('3.0.2', $plugin->getPluginVersion(), 'The production rebuild must expose version 3.0.2.');
urlCleanerAssertSame('>=1.2.54', $plugin->getCompatibleVersion(), 'Compatibility must match the tested Kanboard baseline.');
urlCleanerAssertSame('URLCleaner', $plugin->getPluginName(), 'Plugin identity must remain stable.');
urlCleanerAssertTrue(
    $container['helper']->cleanURLHelper instanceof \Kanboard\Plugin\URLCleaner\Helper\CleanURLHelper,
    'The clean URL helper must be registered.'
);
