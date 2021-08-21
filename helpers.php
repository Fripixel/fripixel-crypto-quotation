<?php

if (!function_exists("getQuery")) {
  function getQuery($data)
  {
    return http_build_query($data, "", "&");
  }
}

if (!function_exists("getTimestamp")) {
  function getTimestamp()
  {
    return round(microtime(true) * 1000);
  }
}

if (!function_exists("getSignature")) {
  function getSignature($data)
  {
    $data = getQuery($data);
    return hash_hmac("sha256", $data, BINANCE_API_SECRET);
  }
}

if (!function_exists("toJson")) {
  function toJson($data)
  {
    return json_decode((string) $data->getBody());
  }
}

if (!function_exists("toCurrency")) {
  function toCurrency($value, $locale = "en-US", $maxFractionDigits = 4)
  {
    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $maxFractionDigits);
    return $formatter->format($value);
  }
}

if (!function_exists("toPercent")) {
  function toPercent($value, $maxFractionDigits = 4)
  {
    return number_format(abs($value), $maxFractionDigits);
  }
}

if (!function_exists("isNegative")) {
  function isNegative($value)
  {
    return preg_match("/-/", $value);
  }
}
