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
</div>
