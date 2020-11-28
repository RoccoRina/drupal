<?php

namespace Drupal\custom_rina\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for custom_rina routes.
 */
class CustomRinaController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
