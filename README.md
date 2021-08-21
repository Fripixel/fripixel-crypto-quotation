# Fripixel Cookies Permission Plugin

This plugin creates a shortcode to insert a table with tokens quotation.

Firstly you will need to set CMC_API_URL and CMC_API_KEY in the wp-config.php file.

- CMC_API_URL = coin market API URL;
- CMC_API_KEY = coin market API Key;

### after this, just insert the shortcode in the desired area.

```php
    <?php
      echo do_shortcode("[fripixel_crypto_quotation]");
    ?>
```

```php
// Options
[
  "tokens" => "BNB,BTC,ETH,AAVE",
  "convert" => "USD",
  "locale" => "en-US",
]
```