<?php

namespace PhpSatuSehat\HttpClient;

class Guzzle implements Base
{
  private function makeRequest(string $method, string $url, RequestData $requestData): ResponseData
  {
    $client = new \GuzzleHttp\Client();
    $data = [
      'query' => $requestData->query,
      'headers' => $requestData->headers,
      'http_errors' => false,
    ];
    if ($method !== 'GET') {
      $data['body'] = $requestData->body;
    }
    $response = $client->request($method, $url, $data);

    $body = $response->getBody()->getContents();
    $headers = $response->getHeaders();
    $statusCode = $response->getStatusCode();

    return new ResponseData($statusCode, $headers, $body);
  }


  public function get(string $url, RequestData $requestData): ResponseData
  {
    return $this->makeRequest('GET', $url, $requestData);
  }

  public function post(string $url, RequestData $requestData): ResponseData {
    return $this->makeRequest('POST', $url, $requestData);
  }

  public function put(string $url, RequestData $requestData): ResponseData {
    return $this->makeRequest('PUT', $url, $requestData);
  }

  public function delete(string $url, RequestData $requestData): ResponseData {
    return $this->makeRequest('DELETE', $url, $requestData);
  }

  public function patch(string $url, RequestData $requestData): ResponseData {
    return $this->makeRequest('PATCH', $url, $requestData);
  }
}
