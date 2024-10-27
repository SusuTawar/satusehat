<?php

namespace PhpSatuSehat\HttpClient;

class Curl implements Base
{
    private function init(string $url, RequestData $requestData)
    {
        $urlWithQuery = $url . '?' . http_build_query($requestData->query);
        $ch = curl_init($urlWithQuery);
        if (!$ch) {
            throw new \Exception('Curl init failed');
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestData->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);

        return $ch;
    }

    private function executeRequest($ch): ResponseData
    {
        $headers = [];
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header) use (&$headers) {
            $length = strlen($header);
            $header = explode(':', $header, 2);
            if (count($header) < 2) {
                return $length;
            }
            $headers[trim($header[0])] = trim($header[1]);
            return $length;
        });

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);

        curl_close($ch);

        return new ResponseData($statusCode, $headers, $body);
    }

    public function get(string $url, RequestData $requestData): ResponseData
    {
        $ch = $this->init($url, $requestData);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        return $this->executeRequest($ch);
    }

    public function post(string $url, RequestData $requestData): ResponseData
    {
        $ch = $this->init($url, $requestData);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData->body);
        return $this->executeRequest($ch);
    }

    public function put(string $url, RequestData $requestData): ResponseData
    {
        $ch = $this->init($url, $requestData);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData->body);
        return $this->executeRequest($ch);
    }

    public function delete(string $url, RequestData $requestData): ResponseData
    {
        $ch = $this->init($url, $requestData);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        return $this->executeRequest($ch);
    }

    public function patch(string $url, RequestData $requestData): ResponseData
    {
        $ch = $this->init($url, $requestData);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData->body);
        return $this->executeRequest($ch);
    }
}
