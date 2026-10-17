<?php

/**
 * Render the administrator settings and route catalogue.
 *
 * Native routes are shown separately because URLCleaner does not register or override them.
 * Related test: tests/PresentationCompatibilityTest.php
 */

$routesCore = $this->helper->cleanURLHelper->newCoreRoutes();
$routesPlugins = $this->helper->cleanURLHelper->newPluginRoutes();
$cleanUrlsEnabled = isset($values['clean-url-options']) && $values['clean-url-options'] === 'enable';
?>
<div id="URLCleanerPage">
    <header class="url-cleaner-page-header">
        <span class="url-cleaner-icon" aria-hidden="true"></span>
        <div>
            <h2><?= t('URL Management') ?></h2>
            <p><?= t('Review native Kanboard routes and optional clean aliases for installed plugins.') ?></p>
        </div>
    </header>

    <div class="url-cleaner-intro">
        <p>
            <?= t('Kanboard already supplies its current application routes. URLCleaner adds an alias only when a supported installed plugin does not provide its own clean route.') ?>
            <span class="url-cleaner-help" aria-label="<?= t('Route behavior information') ?>">
                <?= $this->app->tooltipHTML($this->text->e(t('Native Kanboard routes are informational. Plugin aliases are checked at startup and never replace a route supplied by Kanboard or another plugin.')), 'fa-info-circle') ?>
            </span>
        </p>
        <a href="https://en.wikipedia.org/wiki/Clean_URL" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>">
            <?= t('What are clean URLs?') ?>
        </a>
    </div>

    <section class="url-cleaner-summary" aria-label="<?= t('URL Cleaner status') ?>">
        <article class="url-cleaner-status-card <?= ENABLE_URL_REWRITE ? 'is-ready' : 'needs-attention' ?>">
            <span class="url-cleaner-status-icon" aria-hidden="true">
                <i class="fa <?= ENABLE_URL_REWRITE ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
            </span>
            <div>
                <strong><?= ENABLE_URL_REWRITE ? t('URL rewriting is configured') : t('URL rewriting is not configured') ?></strong>
                <?php if (!ENABLE_URL_REWRITE): ?>
                    <p>
                        <?= t('Configure URL rewriting before enabling plugin aliases.') ?>
                        <a href="https://docs.kanboard.org/v1/admin/url-rewriting/" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>"><?= t('View setup guidance') ?></a>
                    </p>
                <?php endif ?>
            </div>
        </article>

        <article class="url-cleaner-status-card">
            <span class="url-cleaner-app-icon" aria-hidden="true"></span>
            <div>
                <strong><?= t('Native Kanboard URLs') ?></strong>
                <span class="route-count"><?= count($routesCore) ?></span>
                <p><?= t('Shown for reference and left unchanged.') ?></p>
            </div>
        </article>

        <article class="url-cleaner-status-card">
            <span class="url-cleaner-plugin-icon" aria-hidden="true"></span>
            <div>
                <strong><?= t('Installed plugin URLs') ?></strong>
                <span class="route-count"><?= count($routesPlugins) ?></span>
                <p><?= t('Available from supported plugins installed on this Kanboard instance.') ?></p>
            </div>
        </article>
    </section>

    <section class="url-cleaner-panel url-cleaner-settings-panel">
        <div class="url-cleaner-panel-heading">
            <div>
                <h3><?= t('Plugin alias activation') ?></h3>
                <p><?= t('Enable aliases only after URL rewriting is configured.') ?></p>
            </div>
        </div>
        <form method="post" action="<?= $this->url->href('URLCleanerController', 'save', array('plugin' => 'URLCleaner')) ?>" autocomplete="off">
            <?= $this->form->csrf() ?>
            <div class="url-cleaner-options">
                <?= $this->form->radio('clean-url-options', t('Enable plugin aliases'), 'enable', $cleanUrlsEnabled) ?>
                <?= $this->form->radio('clean-url-options', t('Disable plugin aliases'), 'disable', !$cleanUrlsEnabled) ?>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-blue"><?= t('Save Settings') ?></button>
            </div>
        </form>
    </section>

    <?php if ($cleanUrlsEnabled && ENABLE_URL_REWRITE): ?>
        <section id="ApplicationPanel" class="url-cleaner-panel">
            <div class="url-cleaner-panel-heading">
                <span class="url-cleaner-app-icon" aria-hidden="true"></span>
                <div>
                    <h3><?= t('Native Kanboard URLs') ?> <span class="route-count"><?= count($routesCore) ?></span></h3>
                    <p><?= t('These routes are supplied by Kanboard and are not registered or overridden by URLCleaner.') ?></p>
                </div>
            </div>
            <div class="route-table-wrapper" tabindex="0" aria-label="<?= t('Scrollable native route table') ?>">
                <table class="route-table">
                    <caption><?= t('Representative native routes resolved from the current Kanboard route registry.') ?></caption>
                    <thead>
                        <tr>
                            <th scope="col"><?= t('Request') ?></th>
                            <th scope="col"><?= t('Native clean URL') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($routesCore as $route): ?>
                        <tr>
                            <td><?= $this->text->e($route['before_route']) ?></td>
                            <td><?= $this->text->e($route['after_route']) ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="PluginPanel" class="url-cleaner-panel">
            <div class="url-cleaner-panel-heading">
                <span class="url-cleaner-plugin-icon" aria-hidden="true"></span>
                <div>
                    <h3><?= t('Installed plugin URLs') ?> <span class="route-count"><?= count($routesPlugins) ?></span></h3>
                    <p><?= t('Only routes available from supported plugins installed on this Kanboard instance are shown.') ?></p>
                </div>
            </div>
            <?php if ($routesPlugins): ?>
                <div class="route-table-wrapper" tabindex="0" aria-label="<?= t('Scrollable plugin route table') ?>">
                    <table class="route-table">
                        <caption><?= t('Plugin routes currently supplied natively or registered as compatibility aliases.') ?></caption>
                        <thead>
                            <tr>
                                <th scope="col"><?= t('Request') ?></th>
                                <th scope="col"><?= t('Clean URL') ?></th>
                                <th scope="col"><?= t('Plugin') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($routesPlugins as $route): ?>
                            <tr>
                                <td><?= $this->text->e($route['before_route']) ?></td>
                                <td><?= $this->text->e($route['after_route']) ?></td>
                                <td><?= $this->text->e($route['plugin']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="url-cleaner-empty-state">
                    <i class="fa fa-plug" aria-hidden="true"></i>
                    <p><?= t('No supported plugin routes are currently available. Install a supported plugin to see its routes here.') ?></p>
                </div>
            <?php endif ?>
        </section>
    <?php endif ?>
</div>
