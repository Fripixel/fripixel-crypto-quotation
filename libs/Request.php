<?php
namespace Fripixel\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
  public $client = null;

  public function __construct($baseURL)
  {
    $this->client = new Client([
      "base_uri" => $baseURL,
      "debug"    => false,
      "timeout"  => 0,
    ]);
  }

  public function get($url, $data = [], $headers = [])
  {
    if (!empty($data)) {
      $data = getQuery($data);
      $url  = "{$url}?{$data}";
    }

    try {
      $response = $this->client->get($url, [
        "headers" => $headers,
      ]);
    } catch (ClientException $e) {
      echo $e->getMessage();
    }
    return $response;
  }

  public function post($url, $data = [], $headers = [])
  {
    try {
      $response = $this->client->post($url, $data, [
        "headers" => $headers,
      ]);
    } catch (ClientException $e) {
      echo $e->getMessage();
    }
    return $response;
  }
}
