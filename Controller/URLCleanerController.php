<?php

namespace Kanboard\Plugin\URLCleaner\Controller;

use Kanboard\Core\Controller\AccessForbiddenException;

/**
 * Plugin URLCleaner
 *
 * Class URLCleanerController
 * @package  Kanboard\Controller
 * @author   aljawaid
 *
 * Related test: tests/AuthorizationContractTest.php
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
        $this->requireAdmin();

        $this->response->html($this->helper->layout->config('uRLCleaner:config/url-cleaner', array(
            'title' => t('Settings') . ' &#10562; ' . t('URL Cleaner'),
            'values' => array(
                'clean-url-options' => $this->configModel->get('clean-url-options', 'disable'),
            ),
        )));
    }

    /**
     * Save Settings
     *
     * Use the save function for forms
     * @see     ConfigController.php
     * @author  Frederic Guillot
     */
    public function save()
    {
        $this->requireAdmin();
        $this->checkCSRFForm();

        $values = $this->request->getValues();
        $cleanUrlOption = isset($values['clean-url-options']) ? $values['clean-url-options'] : '';

        if (!in_array($cleanUrlOption, array('enable', 'disable'), true)) {
            $this->flash->failure(t('Select whether clean URLs should be enabled or disabled.'));
        } elseif ($this->configModel->save(array('clean-url-options' => $cleanUrlOption))) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        $this->response->redirect($this->helper->url->to('URLCleanerController', 'show', array(
            'plugin' => 'URLCleaner',
        )));
    }

    /**
     * Keep direct controller calls behind the same administrator boundary as the access map.
     */
    private function requireAdmin()
    {
        if (!$this->userSession->isAdmin()) {
            throw new AccessForbiddenException();
        }
    }
}
