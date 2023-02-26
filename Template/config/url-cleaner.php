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
</div>
