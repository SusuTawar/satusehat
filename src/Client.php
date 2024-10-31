<?php

namespace PhpSatuSehat;

use Exception;
use PhpSatuSehat\HttpClient\Base as HttpClient;
use PhpSatuSehat\HttpClient\Curl;
use PhpSatuSehat\HttpClient\Guzzle;
use PhpSatuSehat\HttpClient\RequestData;
use PhpSatuSehat\Module\Encounter;
use PhpSatuSehat\Module\Location;
use PhpSatuSehat\Module\Organization;
use PhpSatuSehat\Module\Patient;
use PhpSatuSehat\Module\Practitioner;

/**
 * Class Client
 *
 * @package PhpSatuSehat
 *
 * @property Location $location
 * @property Organization $organization
 */
class Client {
  private $clientId;
  private $clientSecret;
  private $token;
  private $sandbox = false;
  private HttpClient $http;
  private ?Practitioner $practioner = null;
  private ?Patient $patient = null;
  private ?Organization $organizationIns = null;
  private ?Location $location = null;
  private ?Encounter $encounter = null;
  private array $eventListeners = [];

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
    }
  }

  public function init() {
    $this->organizationIns = new Organization($this->http, $this->getUrl()["v1"]["fhir"], $this->token, fn () => $this->getToken());
    $this->location = new Location($this->http, $this->getUrl()["v1"]["fhir"], $this->token, fn () => $this->getToken());
    $this->practioner = new Practitioner($this->http, $this->getUrl()["v1"]["fhir"], $this->token, fn () => $this->getToken());
    $this->patient = new Patient($this->http, $this->getUrl()["v1"]["fhir"], $this->token, fn () => $this->getToken());
    $this->encounter = new Encounter($this->http, $this->getUrl()["v1"]["fhir"], $this->token, fn () => $this->getToken());
    if (!$this->token) {
      $this->getToken();
    }
    return $this;
  }

  public function addListener(EventListener $listener): int {
    $this->eventListeners[] = $listener;
    return count($this->eventListeners) - 1;
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
      'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
      'body' => 'client_id=' . $this->clientId . '&client_secret=' . $this->clientSecret
    ];
    $response = $this->http->post($url, RequestData::create($data));
    $token = json_decode($response->body, true);
    if (isset($token['access_token'])) {
      $this->token = $token['access_token'];
      $this->organizationIns->setToken($token['access_token']);
      $this->location->setToken($token['access_token']);

      foreach ($this->eventListeners as $listener) {
        if ($listener->getEvent() !== EventListener::ON_TOKEN_RECEIVED) return;
        $listener->handle($token);
      }
    }
  }

  public function practitioner(): Practitioner {
    return $this->practioner;
  }

  public function patient(): Patient {
    return $this->patient;
  }

  public function organization(): Organization {
    return $this->organizationIns;
  }

  public function location(): Location {
    return $this->location;
  }

  public function encounter(): Encounter {
    return $this->encounter;
  }
}
