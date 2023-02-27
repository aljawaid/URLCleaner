<div id="URLCleanerPage" class="url-cleaner-page-margin">
    <div class="url-cleaner-page-header">
        <h2 class=""><?= t('URL Management') ?></h2>
    </div>
    <p class="section-intro"><?= t('URLs are sanitized based on routes and activities within the application. Clean URLs improve the usability and accessibility of a website encouraging consistency and productivity. Learn more about clean URLs on Wikipedia.') ?> <a href="https://en.wikipedia.org/wiki/Clean_URL" class="" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>"><?= t('What are clean URLs?') ?></a>
    </p>
    <fieldset class="options-block">
        <legend class=""><?= t('Options') ?></legend>
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
            <?php $routesCore = $this->helper->cleanURLHelper->newCoreRoutes(); ?>
            <h3 class=""><?= t('Application URLs') ?> <span class="route-count"><?= count($routesCore) ?></span></h3>
            <div class="table-responsive table-responsive-sm route-table-wrapper">
                <table class="table table-sm route-table">
                    <caption><?= t('The list below extends existing routes in the application') ?></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="route-table-column" scope="col"><?= t('Before [Route]') ?></th>
                            <th class="route-table-column" scope="col"><?= t('After [Clean URL]]') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($routesCore as $route): ?>
                        <tr>
                            <td class="route-table-row route-before"><?= $this->helper->text->e($route['before_route']) ?></td>
                            <td class="route-table-row route-after"><?= $this->helper->text->e($route['after_route']) ?></td>
                        </tr>
                    </tbody>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div id="PluginPanel" class="panel">
            <h3 class=""><?= t('Plugin URLs') ?></h3>
            <p class="">The URLs listed below are curated from plugins in the <?= $this->url->link(t('Extensions Directory'), 'PluginController', 'directory') ?> </p>
        </div>
    <?php endif ?>
</div>
