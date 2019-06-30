<?php

namespace Drupal\ckan_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CkanForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'ckan_module_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Form constructor.
        $form = parent::buildForm($form, $form_state);
        // Default settings.
        $config = $this->config('ckan_module.settings');

        // Page title field.
        $form['ckan_api'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CKAN API URL:'),
            '#description' => $this->t('Specify the endpoint URL. Example https://data.gov.au/api/3 (please note no trailing slash).'),
            );
            // Source text field.
            $form['ckan_key'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CKAN API Key'),
            '#description' => $this->t('Optionally specify an API key.'),
            );
        
        return $form;
    }

        /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('ckan_module.settings');
        $config->set('ckan_module.ckan_api', $form_state->getValue('ckan_api'));
        $config->set('ckan_module.ckan_key', $form_state->getValue('ckan_key'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'ckan_module.settings',
        ];
    }

}