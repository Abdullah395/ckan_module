<?php

namespace Drupal\ckan_module\Connect;

use Drupal\Core\Config\ConfigFactoryInterface;
use GuzzleHttp\Client;

/**
 * Provides a CKAN client.
 */
class CkanClient implements CkanClientInterface {

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
  public function __construct(Client $http_client, $api_url, $api_key) {
    $this->httpClient = $http_client;
    //$this->configFactory = $config_factory;

    //$config = $this->configFactory->get('ckan_connect.settings');

    $this->apiUrl = $api_url; //$config->get('api.url');
    $this->apiKey = $api_key; //$config->get('api.key');
  }

  /**
   * {@inheritdoc}
   */
  public function getApiUrl() {
    return $this->apiUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function setApiUrl($api_url) {
    $this->apiUrl = $api_url;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * {@inheritdoc}
   */
  public function setApiKey($api_key) {
    $this->apiKey = $api_key;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function get($path, array $query = []) {
    $uri = $this->getApiUrl() . '/' . $path;
    $options = ['query' => $query];

    if ($this->getApiKey()) {
      $options['headers']['Authorization'] = $this->getApiKey();
    }

    $response = $this->httpClient->get($uri, $options)->getBody()->getContents();
    $response = json_decode($response);

    return $response;
  }

}
