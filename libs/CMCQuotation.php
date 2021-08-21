<?php

namespace Fripixel\Libs;

use Fripixel\Libs\Request;

class CMCQuotation
{
  public $symbol = null;

  public $convert = null;

  public $skip_invalid = 'true';

  public $request = null;

  public function __construct($symbol = 'BTC', $convert = 'USD', $skip_invalid = 'true')
  {
    $this->symbol       = $symbol;
    $this->convert      = $convert;
    $this->skip_invalid = $skip_invalid;
    $this->request      = new Request(CMC_API_URL);
    return $this;
  }

  public function generate()
  {
    $quotations = $this->getQuotation();
    $quotation_data = (array) $quotations->data;
    $quotations = array_map(function ($token) {
      $obj = new \stdClass;
      $obj->slug = $token->slug;
      $obj->price = $token->quote->{$this->convert}->price;
      $obj->percent_change_24h = $token->quote->{$this->convert}->percent_change_24h;
      return $obj;
    }, $quotation_data);
    return $quotations;
  }

  public function getQuotation()
  {
    $url = "/v1/cryptocurrency/quotes/latest";

    $data = [
      "symbol"       => $this->symbol,
      "convert"      => $this->convert,
      "skip_invalid" => $this->skip_invalid,
    ];

    $headers = [
      "X-CMC_PRO_API_KEY" => CMC_API_KEY,
    ];

    $response = $this->request->get($url, $data, $headers);

    $response = toJson($response);

    return $response;
  }
}
