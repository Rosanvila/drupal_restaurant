<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloWorldSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hello_world.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hello_world_settings_form';
  }

  /**
   * Build the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hello_world.settings');
    $form['welcome_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Welcome Message'),
      '#default_value' => $config->get('welcome_message'),
      '#description' => $this->t('Enter the welcome message to display.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $welcome_message = $form_state->getValue('welcome_message');
    if (strlen($welcome_message) < 10) {
      $form_state->setErrorByName('welcome_message', $this->t('The welcome message is too short. It must be at least 10 characters long.'));
    }
  }

  /**
   * Submit the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hello_world.settings')
      ->set('welcome_message', $form_state->getValue('welcome_message'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
