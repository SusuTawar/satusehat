<?php

namespace PhpSatuSehat;

use Exception;
use PhpSatuSehat\HttpClient\Base as HttpClient;
use PhpSatuSehat\HttpClient\Curl;
use PhpSatuSehat\HttpClient\Guzzle;
use PhpSatuSehat\HttpClient\RequestData;
use PhpSatuSehat\Module\Location;
use PhpSatuSehat\Module\Organization;

class Client {
  private $clientId;
  private $clientSecret;
  private $token;
  private $sandbox = false;
  private HttpClient $http;

  public function __construct($sandbox, $clientId, $clientSecret, $token = null) {
    if (class_exists('GuzzleHttp\Client')) {
      $this->http = new Guzzle();
    } else {
      $this->http = new Curl();
    }
    $this->sandbox = $sandbox;
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    if ($token) {
      $this->token = $token;
    } else {
      $this->getToken();
    }
  }

  public function __get($name) {
    if (method_exists($this, $name)) {
        return $this->$name();
    }

    throw new Exception("Property or method '$name' does not exist.");
  }

  private function getUrl() {
    $baseUrl = "https://api-satusehat.kemkes.go.id";
    if ($this->sandbox) {
      $baseUrl = "https://api-satusehat-stg.dto.kemkes.go.id";
    }
    return [
      "v1" => [
        "auth" => $baseUrl . "/oauth2/v1",
        "fhir" => $baseUrl . "/fhir-r4/v1",
        "consent" => $baseUrl . "/consent/v1",
      ]
    ];
  }

  /**
   * Get access token
   *
   * fungsi ini akan berjalan secara otomatis jika token belum ada;
   */
  public function getToken(): void {
    $url = $this->getUrl()["v1"]["auth"] . "/accesstoken";
    $data = [
      'query' => ['grant_type' => 'client_credentials'],
      'headers' => ['Content-Type' => 'application/json'],
      'body' => json_encode([
        'client_id' => $this->clientId,
        'client_secret' => $this->clientSecret
      ])
    ];
    $response = $this->http->post($url, RequestData::create($data));
    $token = json_decode($response->body, true);
    $this->token = $token['access_token'];
  }

  public function organization() {
    return new Organization($this->http, $this->token, $this->sandbox);
  }

  public function location() {
    return new Location($this->http, $this->token, $this->sandbox);
  }
}