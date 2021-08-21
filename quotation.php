<div class="fripixel-crypto-quotation">
  <table class="tokens">
    <thead>
      <tr>
        <th>Token</th>
        <th>Quotation</th>
        <th>24h (%)</th>
      </tr>
    </thead>
    <?php
    foreach ($quotations as $token => $quote) {
    ?>
      <tr>
        <td>
          <strong>
            <a href="https://coinmarketcap.com/currencies/<?php esc_attr_e($quote->slug); ?>" target="blank">
              <?php esc_attr_e($token); ?>
            </a>
          </strong>
        </td>
        <td>
          <?php
            esc_attr_e(toCurrency($quote->price, $locale));
          ?>
        </td>
        <td>
          <span class="<?php esc_attr_e( isNegative($quote->percent_change_24h) === 1 ? 'down' : 'up'); ?>">
            <?php esc_attr_e(toPercent($quote->percent_change_24h, 4)); ?>
          </span>
        </td>
      </tr>
    <?php } ?>
  </table>
  <div class="text-center">
    <a class="see_more" href="https://coinmarketcap.com/" target="blank">see more</a>
  </div>
</div>