<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloWorldController extends ControllerBase {

  /**
   * Méthode pour afficher le message.
   *
   * @return array
   *   Retourne un tableau de rendu.
   */
  public function index() {
    return [
      '#markup' => '<p>Bonjour, Robin ! Bienvenue sur Drupal.</p>',
    ];
  }
}
