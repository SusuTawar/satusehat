<?php

namespace PhpSatuSehat\HttpClient;

interface Base {
  public function get(string $url, RequestData $requestData): ResponseData;

  public function post(string $url, RequestData $requestData): ResponseData;

  public function put(string $url, RequestData $requestData): ResponseData;

  public function delete(string $url, RequestData $requestData): ResponseData;

  public function patch(string $url, RequestData $requestData): ResponseData;
}