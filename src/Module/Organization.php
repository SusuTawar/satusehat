<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Organization as BuilderOrganization;
use PhpSatuSehat\HttpClient\Base as HttpClient;
use PhpSatuSehat\HttpClient\RequestData;

class Organization {
  public $http;
  public $token;
  public $baseUrl;

  public function __construct(HttpClient $httpClient, string $url, $token) {
    $this->http = $httpClient;
    $this->token = $token;
    $this->baseUrl = $url;
  }

  public function get($filter = []) {
    $url = $this->baseUrl . "/Organization";
    $request = [
      "headers" => [
        "Authorization" => "Bearer " . $this->token,
        "Content-Type" => "application/json",
      ],
      "query" => $filter,
    ];
    return $this->http->get($url, RequestData::create($request));
  }

  public function post(BuilderOrganization $data) {
    $url = $this->baseUrl . "/Organization";
    $data = RequestData::create([
      "headers" => [
        "Authorization" => "Bearer " . $this->token,
        "Content-Type" => "application/json",
      ],
      "body" => $data->toJson(),
    ]);
    return $this->http->post($url, $data);
  }

  public function update($id, BuilderOrganization $data) {
    $url = $this->baseUrl . "/Organization/$id";
    $data = RequestData::create([
      "headers" => [
        "Authorization" => "Bearer " . $this->token,
        "Content-Type" => "application/json",
      ],
      "body" => $data->toJson(),
    ]);
    return $this->http->put($url, $data);
  }
}