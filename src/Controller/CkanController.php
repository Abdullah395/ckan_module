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
   * {@inheritdoc}
   */
  public function get(Client $httpClient, $api_url, $api_key, $path, array $query = []) {
    $uri = $api_url . '/' . $path;
    $options = ['query' => $query];

    if ($api_key) {
      $options['headers']['Authorization'] = $api_key;
    }

    $response = $httpClient->get($uri, $options)->getBody()->getContents();
    $response = json_decode($response);

    return $response;
  }
  
  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    $client = new Client();

    $config = $this->config('ckan_module.settings');

    $response = get($client, $config->get('ckan_module.ckan_api'), $config->get('ckan_module.ckan_key'), 'action/group_list');

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