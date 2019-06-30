<?php

namespace Drupal\ckan_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines CkanController class.
 */
class CkanController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, this is the CKAN module for Drupal 8.'),
    ];
  }

}