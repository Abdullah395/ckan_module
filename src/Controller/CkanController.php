<?php

namespace Drupal\ckan_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ckan_connect\Client;
use GuzzleHttp\Client;

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
    $client = new GuzzleHttp\Client();

    $config = $this->config('ckan_module.settings');
    $ckan = new Drupal\ckan_connect\Client($client, $config->get('ckan_module.ckan_api'), $config->get('ckan_module.ckan_key'));

    $response = $ckan->get('action/group_list');

    var_dump($response);
    // return [
    //      '#type' => 'markup',
    //    '#markup' => $this->t('Hello, this is the CKAN module for Drupal 8.'),    
    // ]

    // return [
    //   '#type' => 'markup',
    //   '#markup' => $this->t('Hello, this is the CKAN module for Drupal 8.'),
    // ];
  }

}