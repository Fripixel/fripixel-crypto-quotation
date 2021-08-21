<?php

namespace Fripixel\Libs;

use \WP_Widget;

class CryptoQuotationWidget extends WP_Widget
{
  public $args = [
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
    'before_widget' => '<div class="widget-wrap">',
    'after_widget'  => '</div></div>',
  ];

  public $allowed_html = [
    'a'      => [
      'href'  => [],
      'title' => [],
    ],
    'br'     => [],
    'em'     => [],
    'strong' => [],
  ];

  public function __construct()
  {
    parent::__construct(
      // Base ID
      'fripixel-crypt-quotation',
      // Name
      'Crypto Quotation'
    );
  }

  public function widget($args, $instance)
  {

    echo $args['before_widget'];

    if (!empty($instance['title'])) {
      echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
    }

    echo '<div class="textwidget">';

    $cryptos = explode(",", $instance['tokens']);

    $html = "<select>";

    foreach($cryptos as $crypto) {
      $rand = rand(1000,100000);
      $value = "R$ ".number_format($rand, 2, ',', '.');
      $html .= "<strong>{$crypto}</strong> {$value}<br>";
    }

    echo wp_kses($html, $this->allowed_html);

    echo '</div>';

    echo $args['after_widget'];

  }

  public function form($instance)
  {
    $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'text_domain');
    $tokens  = $instance['tokens'];
    // var_dump($instance); exit;
    ?>
    <p>
      <label for="title">
          <?php
            echo esc_html__('Title:', 'text_domain');
          ?>
      </label>
      <input class="widefat" id="title" name="title" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="tokens">
          <?php
            echo esc_html__('Tokens (comma separated):', 'text_domain');
          ?>
        </label>
        <select multiple class="widefat" id="tokens" name="tokens[]">
          <?php
            $tokens = [
              "BNB" => "bnb",
              "Bitcoin" => "btc",
              "Ethereum" => "eth",
              "AAVE" => "aave",
            ];
          ?>
          <?php foreach($tokens as $key => $value) { ?>
          <option value="<?php echo $value; ?>">
            <?php echo $key; ?>
          </option>
          <?php } ?>
        </select>
    </p>
    <?php
}

  public function update($new_instance, $old_instance)
  {
    $instance = [];

    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    var_dump($new_instance, $old_instance); exit;
    $instance['tokens'] = $new_instance['tokens'];

    return $instance;
  }
}
