<?php

namespace PhpSatuSehat\HttpClient;

class RequestData
{
  public $headers = [];
  public $body = '';
  public $query = [];

  public function __construct($query = [], $body = '', $headers = []) {
    $this->query = $query;
    $this->body = $body;
    $this->headers = $headers;
  }

  public static function create(array $data) {
    $headers = isset($data['headers']) ? $data['headers'] : [];
    $body = isset($data['body']) ? $data['body'] : '';
    $query = isset($data['query']) ? $data['query'] : [];

    return new RequestData($query, $body, $headers);
  }
}