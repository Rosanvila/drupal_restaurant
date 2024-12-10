<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloWorldController extends ControllerBase
{
  protected $configFactory;

  public function __construct(ConfigFactoryInterface $config_factory)
  {
    $this->configFactory = $config_factory;
  }

  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('config.factory')
    );
  }

  public function index()
  {
    $config = $this->configFactory->get('hello_world.settings');
    $welcome_message = $config->get('welcome_message') ?? $this->t('Welcome to Hello World!');

    return [
      '#markup' => $welcome_message,
    ];
  }
}
