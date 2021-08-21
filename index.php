<?php
/**
 * @pac
 * @version 5.4
 */
/*
Plugin Name: Fripixel Crypto Quotation
Plugin URI: http://wordpress.org/plugins/fripixel-crypto-quotation/
Description: Fripixel Crypto Quotation plugin, shows a list of crypto quotation values.
Author: Fripixel
Version: 5.4
Author URI: https://fripixel.com.br
 */

/**
 * Register and Enqueue Styles.
 */

require "vendor/autoload.php";

use Fripixel\Libs\CMCQuotation;

function fripixel_crypto_quotation_styles()
{
  $theme_version = wp_get_theme()->get("Version");
  wp_enqueue_style("fripixel-crypto-quotation-plugin", plugin_dir_url(__FILE__) . "assets/css/app.css", [], $theme_version);
}

/**
 * Register and Enqueue Scripts.
 */
function fripixel_crypto_quotation_scripts()
{
  $theme_version = wp_get_theme()->get("Version");

  wp_enqueue_script("fripixel-crypto-quotation-app", plugin_dir_url(__FILE__) . "assets/js/app.js", [], $theme_version, false);
}

add_action("wp_enqueue_scripts", "fripixel_crypto_quotation_scripts");

add_action("wp_enqueue_scripts", "fripixel_crypto_quotation_styles");

function fripixel_crypto_quotation_show($atts)
{
  if(!defined("CMC_API_URL")) {
    _e("Please, set the right Fripixel Crypto Quotation configurations!");
    exit;
  }

  if(!defined("CMC_API_KEY")) {
    _e("Please, set the right Fripixel Crypto Quotation configurations!");
    exit;
  }

  $atts = shortcode_atts([
    "tokens" => "BNB,BTC,ETH,AAVE",
    "convert" => "USD",
    "locale" => "en-US",
  ], $atts);

  $allowed_html = [
    "a"      => [
      "href"  => [],
      "title" => [],
    ],
    "br"     => [],
    "em"     => [],
    "strong" => [],
  ];

  $symbol = $atts["tokens"];

  $convert = $atts["convert"];

  $locale = $atts["locale"];

  $quotations = (new CMCQuotation($symbol, $convert))->generate();

  ob_start();
  require "quotation.php";
  $content = ob_get_clean();
  return $content;
}

add_shortcode("fripixel_crypto_quotation", "fripixel_crypto_quotation_show");
