<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\hello_world\Form\SubscriptionForm;

class SubscriptionController extends ControllerBase {
  protected $configFactory;

  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  public function subscribe() {
    // Créez une instance du formulaire de souscription
    $form = \Drupal::formBuilder()->getForm(SubscriptionForm::class);

    return [
      '#type' => 'markup',
      '#markup' => \Drupal::service('renderer')->renderRoot($form),
    ];
  }
}