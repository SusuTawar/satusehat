<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\HttpClient\Base as HttpClient;
use PhpSatuSehat\HttpClient\RequestData;
use PhpSatuSehat\HttpClient\ResponseData;

class BaseModule {
  protected $http;
  protected $token;
  protected $baseUrl;
  protected $getTokenFn;

  public function __construct(HttpClient $httpClient, string $url, $token, $getTokenFn = null) {
    $this->http = $httpClient;
    $this->token = $token;
    $this->baseUrl = $url;
    $this->getTokenFn = $getTokenFn;
  }

  public function setToken($token) {
    $this->token = $token;
  }

  protected function isUnauthorized(ResponseData $respose) {
    $body = json_decode($respose->body, true);
    return ($respose->status == 401 && isset($body['issue'][0]['code']) && $body['issue'][0]['code'] == 'invalid-access-token');
  }

  protected function sendRequest($method, $endpoint, $data = null, $filter = [], $retry = true) {
    $url = $this->baseUrl . $endpoint;
    $requestData = RequestData::create([
        "headers" => [
            "Authorization" => "Bearer " . $this->token,
            "Content-Type" => "application/json",
        ],
        "body" => $data ? $data->toJson() : null,
        "query" => $filter,
    ]);

    $response = $this->http->$method($url, $requestData);

    if ($retry && $this->isUnauthorized($response) && $this->getTokenFn) {
        $tkn = $this->getTokenFn;
        $tkn();
        return $this->sendRequest($method, $endpoint, $data, $filter, false);
    }

    return $response;
  }
}