<?php

/**
 * Verifies the administrator boundary and allowlisted settings write.
 *
 * Related files: Plugin.php and Controller/URLCleanerController.php.
 */

use Kanboard\Core\Security\Role;

$root = dirname(__DIR__);
$pluginSource = file_get_contents($root . '/Plugin.php');
$controllerSource = file_get_contents($root . '/Controller/URLCleanerController.php');

urlCleanerAssertContains(
    "applicationAccessMap->add('URLCleanerController', '*', Role::APP_ADMIN)",
    $pluginSource,
    'URLCleaner settings must require an application administrator.'
);
urlCleanerAssertContains(
    'if (!$this->userSession->isAdmin())',
    $controllerSource,
    'Direct controller calls must retain an explicit administrator guard.'
);
urlCleanerAssertContains(
    '$this->checkCSRFForm()',
    $controllerSource,
    'Settings writes must validate CSRF tokens.'
);
urlCleanerAssertContains(
    "array('enable', 'disable'), true",
    $controllerSource,
    'Settings writes must allowlist the supported values.'
);
urlCleanerAssertContains(
    "save(array('clean-url-options' => \$cleanUrlOption))",
    $controllerSource,
    'Only the URLCleaner option may be persisted.'
);
urlCleanerAssertNotContains(
    'configModel->save($values)',
    $controllerSource,
    'Unfiltered form values must never be written to the global configuration.'
);

$allowedRoles = $container['applicationAccessMap']->getRoles('URLCleanerController', 'save');
urlCleanerAssertTrue(
    in_array(Role::APP_ADMIN, $allowedRoles, true),
    'Administrators must be authorised to save URLCleaner settings.'
);
urlCleanerAssertFalse(
    in_array(Role::APP_USER, $allowedRoles, true),
    'Ordinary application users must not be authorised to save URLCleaner settings.'
);
