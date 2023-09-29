<?php

namespace Kanboard\Plugin\URLCleaner\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Plugin\Directory;

/**
 * Plugin URLCleaner
 *
 * Class URLCleanerController
 * @package  Kanboard\Controller
 * @author   aljawaid
 */

class URLCleanerController extends \Kanboard\Controller\PluginController
{
    /**
     * Display the Settings Page
     * Use this function to create a page showing your template content.
     * This function must be checked with 'Views - Add Menu Item - Template Hook' in Plugin.php
     * This function must be checked with 'Extra Page - Routes' in Plugin.php
     * Use: $this->helper->layout->config for config settings menu sidebar
     * Use: $this->helper->layout->plugin for plugin menu sidebar
     * @access public
     */
    public function show()
    {
        $this->response->html($this->helper->layout->config('uRLCleaner:config/url-cleaner', array(
            'title' => t('Settings') . ' &#10562; ' . t('URL Cleaner'),
        )));
    }

    /**
     * Save Settings
     *
     * Use the save function for forms
     * @see     ConfgiController.php
     * @author  Frederic Guillot
     */
    public function save()
    {
        $values = $this->request->getValues();
        $redirect = $this->request->getStringParam('redirect', 'application');

        if ($this->configModel->save($values)) {
            $this->languageModel->loadCurrentLanguage();
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        $this->response->redirect($this->helper->url->to('URLCleanerController', $redirect, ['plugin' => 'URLCleaner']));
    }
}
