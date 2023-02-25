<li <?= $this->app->checkMenuSelection('URLCleanerController', 'show', 'URLCleaner') ?>>
    <?= $this->url->link(t('URL Cleaner'), 'URLCleanerController', 'show', ['plugin' => 'URLCleaner']) ?>
</li>
