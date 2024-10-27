<?php

namespace PhpSatuSehat\HttpClient;

class ResponseData
{
  public $status;
  public $headers;
  public $body;

  public function __construct($status, $headers, $body) {
    $this->status = $status;
    $this->headers = $headers;
    $this->body = $body;
  }
}