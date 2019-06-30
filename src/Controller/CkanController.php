<?php

namespace Drupal\ckan_module\Controller;

use Drupal\Core\Controller\ControllerBase;
//use Drupal\ckan_module\Connect;
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
    $client = new Client();

    $config = $this->config('ckan_module.settings');
    $api_url = $config->get('ckan_module.ckan_api');
    $api_key = $config->get('ckan_module.ckan_key');

    $path = "action/group_list";
    $query = [];

    $uri = $api_url . '/' . $path;

    $options = ['query' => $query];

    if ($api_key) {
      $options['headers']['Authorization'] = $api_key;
    }

    $response = $client->get($uri, $options)->getBody()->getContents();
    $response = json_decode($response, true);

    //var_dump($response);

    return [
         '#type' => 'markup',
        '#markup' => $this->t($response["result"][0]),    
    ];

    // return [
    //   '#type' => 'markup',
    //   '#markup' => $this->t('Hello, this is the CKAN module for Drupal 8.'),
    // ];
  }
}