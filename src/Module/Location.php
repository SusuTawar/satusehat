<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Location as BuilderLocation;
use PhpSatuSehat\HttpClient\Base as HttpClient;
use PhpSatuSehat\HttpClient\RequestData;

class Location {
  public $http;
  public $token;
  public $baseUrl;

  public function __construct(HttpClient $httpClient, string $url, $token) {
    $this->http = $httpClient;
    $this->token = $token;
    $this->baseUrl = $url;
  }

  public function get($filter = []) {
    $url = $this->baseUrl . "/Location";
    $request = [
      "headers" => [
        "Authorization" => "Bearer " . $this->token,
        "Content-Type" => "application/json",
      ],
      "query" => $filter,
    ];
    return $this->http->get($url, RequestData::create($request));
  }

  public function post(BuilderLocation $data) {
    $url = $this->baseUrl . "/Location";
    $data = RequestData::create([
      "headers" => [
        "Authorization" => "Bearer " . $this->token,
        "Content-Type" => "application/json",
      ],
      "body" => $data->toJson(),
    ]);
    return $this->http->post($url, $data);
  }

  public function update($id, BuilderLocation $data) {
    $url = $this->baseUrl . "/Location/$id";
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