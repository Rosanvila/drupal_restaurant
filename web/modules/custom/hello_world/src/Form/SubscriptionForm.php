<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

class SubscriptionForm extends FormBase {

  public function getFormId() {
    return 'subscription_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#required' => TRUE,
    ];

    $form['confirm_password'] = [
      '#type' => 'password',
      '#title' => $this->t('Confirm Password'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Subscribe'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('The email address is not valid.'));
    }

    $password = $form_state->getValue('password');
    $confirm_password = $form_state->getValue('confirm_password');

    if (strlen($password) < 8) {
      $form_state->setErrorByName('password', $this->t('The password is too short. It must be at least 8 characters long.'));
    }

    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
      $form_state->setErrorByName('password', $this->t('The password must contain at least one special character.'));
    }

    if ($password !== $confirm_password) {
      $form_state->setErrorByName('confirm_password', $this->t('The passwords do not match.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $password = $form_state->getValue('password');

    // Créez un nouvel utilisateur avec le rôle d'administrateur
    $user = User::create([
      'name' => $email,
      'mail' => $email,
      'pass' => $password,
      'status' => 1,
      'roles' => ['administrator'],
    ]);

    $user->save();

    $this->messenger()->addMessage($this->t('A new administrator account has been created.'));
  }
}