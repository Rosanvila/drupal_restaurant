<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Custom' Block.
 *
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom block"),
 * )
 */
class CustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello, this is a custom block!'),
    ];
  }
}