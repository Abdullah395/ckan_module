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
    $ckan = Connect($client);

    $response = get($ckan, $config->get('ckan_module.ckan_api'), $config->get('ckan_module.ckan_key'), 'action/group_list');

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


  ///////////////////////////////////////////////////////////////////////////
  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The API URL.
   *
   * @var string
   */
  protected $apiUrl;

  /**
   * The API key.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * Constructs a new CkanClient.
   *
   * @param \GuzzleHttp\Client $http_client
   *   The HTTP client.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function Connect(Client $http_client) {
    $httpClient = $http_client;
    //$this->configFactory = $config_factory;

    //$config = $this->configFactory->get('ckan_connect.settings');

    // $apiUrl = $api_url; //$config->get('api.url');
    // $apiKey = $api_key; //$config->get('api.key');
    return $httpClient
  }

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
}