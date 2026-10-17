<?php

/**
 * Add URLCleaner to the administrator settings navigation.
 *
 * Related test: tests/PresentationCompatibilityTest.php
 */

?>
<li <?= $this->app->checkMenuSelection('URLCleanerController', 'show', 'URLCleaner') ?>>
    <?= $this->url->icon('link', t('URL Cleaner'), 'URLCleanerController', 'show', array('plugin' => 'URLCleaner')) ?>
</li>
