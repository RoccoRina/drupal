<?php

namespace Drupal\custom_rina\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure custom_rina settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_rina_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_rina.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->config('custom_rina.settings')->get('example'),
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#default_value' => $this->config('custom_rina.settings')->get('name'),
    ];
    $form['text'] = [
      '#type' => 'textarea',
      '#rows' => 10,
      '#title' => $this
        ->t('Text'),
      '#default_value' => $this->config('custom_rina.settings')->get('text'),
    ];
    $form['copy'] = [
      '#type' => 'checkbox',
      '#title' => $this
        ->t('Send me a copy'),
      '#default_value' => $this->config('custom_rina.settings')->get('copy'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('example') != 'example') {
      $form_state->setErrorByName('example', $this->t('The value is not correct.'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_rina.settings')
      ->set('example', $form_state->getValue('example'))
      ->set('name', $form_state->getValue('name'))
      ->set('text', $form_state->getValue('text'))
      ->set('copy', $form_state->getValue('copy'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
