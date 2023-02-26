<div class="page-margin">
    <div class="page-header">
        <h2 class="">Clean URL Management</h2>
    </div>
    <p class="">URLs are sanitized based on routes and activities within the application. Clean URLs improve the usability and accessibility of a website further improving user workflow and productivity.</p>
    <fieldset class="">
        <legend>Options</legend>
        <fieldset class="">
            <legend>Configuration</legend>
            <div class="url-detection">
            <?php if (ENABLE_URL_REWRITE): ?>
                <i class="fa fa-toggle-on i-fw fa-lg pp-green" aria-hidden="true"></i> <?= t('URL rewriting is configured') ?>
            <?php else: ?>
                <i class="fa fa-toggle-off i-fw fa-lg pp-red" aria-hidden="true"></i> <?= t('URL rewriting is not configured') ?> <a href="https://docs.kanboard.org/v1/admin/url-rewriting/" class="" target="_blank" rel="noopener noreferrer" title="<?= t('Opens in a new window') ?>"><?= t('Learn more') ?></a>
            <?php endif ?>
            </div>
        </fieldset>
        <fieldset class="">
            <legend>Activation</legend>
            <form class="url-form" method="post" action="<?= $this->url->href('URLCleanerController', 'save', array('redirect' => 'show', 'plugin' => 'URLCleaner')) ?>" autocomplete="off">
                <?= $this->form->csrf() ?>
                <div class="url-radio-options">
                    <?= $this->form->radio('clean-url-options', t('Enable Clean URLs'), 'enable', true, '', isset($values['clean-url-options']) && $values['clean-url-options'] == 'enable') ?>
                    <?= $this->form->radio('clean-url-options', t('Disable Clean URLs'), 'disable', isset($values['clean-url-options']) && $values['clean-url-options'] == 'disable') ?>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-blue" title="<?= t('Saves changes') ?>"><?= t('Save Settings') ?></button>
                </div>
            </form>
        </fieldset>
    </fieldset>
    <?php if ($this->task->configModel->get('clean-url-options', '') == 'enable'): ?>
        <div id="ApplicationPanel" class="panel">
            <h3 class=""><?= t('Application URLs') ?></h3>
            <div class="table-responsive table-responsive-sm">
                <table class="table table-striped table-sm">
                  <caption>URLs shown below extend existing core routes in the application.</caption>
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">before (route)</th>
                      <th scope="col">after (url)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $routes = $this->helper->cleanURLHelper->newCoreRoutes();
                    ?>
                    <?php foreach ($routes as $route): ?>


                    <tr>
                      <td><?= $this->helper->text->e($route['before_route']) ?></td>
                      <td><?= $this->helper->text->e($route['after_route']) ?></td>
                    </tr>
                    <tr>
                      <td>Core</td>
                      <td>Thornton</td>
                    </tr>
                    <tr>
                      <td>?controller=Bigboard&action=index&plugin=Bigboard</td>
                      <td>/bigboard</td>
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
