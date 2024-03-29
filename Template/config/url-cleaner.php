<?php
$routesCore = $this->helper->cleanURLHelper->newCoreRoutes();
$routesPlugins = $this->helper->cleanURLHelper->newPluginRoutes();
?>
<div id="URLCleanerPage" class="url-cleaner-page-margin">
    <div class="url-cleaner-page-header">
        <h2 class=""><span class="url-cleaner-icon"></span> <?= t('URL Management') ?></h2>
    </div>
    <p class="section-intro"><?= t('URLs are sanitized based on routes and activities within the application. Clean URLs improve the usability and accessibility of a website encouraging consistency and productivity. Learn more about clean URLs on Wikipedia.') ?> <a href="https://en.wikipedia.org/wiki/Clean_URL" class="" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>"><?= t('What are clean URLs?') ?></a>
    </p>
    <fieldset class="options-block">
        <legend class=""><?= t('Options') ?></legend>
        <fieldset class="options-section">
            <legend><?= t('Total URLs') ?></legend>
            <div class="total-urls"><span class="total-route-count"><?= (count($routesCore) + count($routesPlugins)) ?></span> <?= t('Clean URLs will be available when enabled') ?> </div>
        </fieldset>
        <fieldset class="options-section">
            <legend><?= t('Configuration') ?></legend>
            <div class="url-detection">
            <?php if (ENABLE_URL_REWRITE): ?>
                <i class="fa fa-toggle-on i-fw fa-lg pp-green" aria-hidden="true"></i> <?= t('URL rewriting is configured') ?>
            <?php else: ?>
                <i class="fa fa-toggle-off i-fw fa-lg pp-red" aria-hidden="true"></i> <?= t('URL rewriting is not configured') ?>
                <a href="https://docs.kanboard.org/v1/admin/url-rewriting/" class="" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>"><?= t('Learn more') ?></a>
            <?php endif ?>
            </div>
        </fieldset>
        <fieldset class="options-section">
            <legend><?= t('Activation') ?></legend>
            <form class="url-form" method="post" action="<?= $this->url->href('URLCleanerController', 'save', array('redirect' => 'show', 'plugin' => 'URLCleaner')) ?>" autocomplete="off">
                <?= $this->form->csrf() ?>
                <div class="url-radio-options">
                    <?= $this->form->radio('clean-url-options', t('Enable Clean URLs'), 'enable', true, '', isset($values['clean-url-options']) && $values['clean-url-options'] == 'enable') ?>
                    <?= $this->form->radio('clean-url-options', t('Disable Clean URLs'), 'disable', isset($values['clean-url-options']) && $values['clean-url-options'] == 'disable') ?>
                    <div class="form-actions">
                        <button type="submit" class="btn"><?= t('Save Settings') ?></button>
                    </div>
                </div>
            </form>
        </fieldset>
    </fieldset>
    <?php if ($this->task->configModel->get('clean-url-options', '') == 'enable'): ?>
        <div id="ApplicationPanel" class="panel">
            <h3 class=""><span class="url-cleaner-app-icon"></span> <?= t('Application URLs') ?> <span class="route-count"><?= count($routesCore) ?></span></h3>
            <div class="table-responsive table-responsive-sm route-table-wrapper">
                <table class="table table-sm route-table">
                    <caption><?= t('The list below extends existing routes throughout the application. These routes are merged into the core application in the latest version.') ?></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="route-table-column table-corner-tl" scope="col"><?= t('Before [Route]') ?></th>
                            <th class="route-table-column table-corner-tr" scope="col"><?= t('After [Clean URL]') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($routesCore as $route): ?>
                        <tr>
                            <td class="route-table-row route-before table-corner-bl">
                                <?= $this->helper->text->e($route['before_route']) ?>
                            </td>
                            <td class="route-table-row route-after table-corner-br">
                                <?php if (file_exists('plugins/CostControl') && (isset($route['moved_to']))): ?>
                                    <span class="plugin-override" title="<?= $this->helper->text->e($route['moved_to']) ?> <?= t('plugin overrides this clean URL setting') ?>"><?= t('Plugin Override') ?></span>
                                <?php endif ?>
                                <?= $this->helper->text->e($route['after_route']) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="PluginPanel" class="panel">
            <h3 class=""><span class="url-cleaner-plugin-icon"></span> <?= t('Plugin URLs') ?> <span class="route-count"><?= count($routesPlugins) ?></span></h3>
            <div class="table-responsive table-responsive-sm route-table-wrapper">
                <table class="table table-sm route-table">
                    <caption><?= t('The URLs listed below are curated from plugins in the') ?> <?= $this->url->link(t('Plugin Directory'), 'PluginController', 'directory') ?></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="route-table-column table-corner-tl" scope="col"><?= t('Before [Route]') ?></th>
                            <th class="route-table-column" scope="col"><?= t('After [Clean URL]') ?></th>
                            <th class="route-table-column table-corner-tr" scope="col"><?= t('Plugin') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($routesPlugins as $route): ?>
                        <tr>
                            <td class="route-table-row route-before table-corner-bl"><?= $this->helper->text->e($route['before_route']) ?></td>
                            <td class="route-table-row route-after"><?= $this->helper->text->e($route['after_route']) ?></td>
                            <td class="route-table-row table-corner-br"><?= $this->helper->text->e($route['plugin']) ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</div>
