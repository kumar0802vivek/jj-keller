<?php
$display = 'none';
if ($this->editmode) {
    $display = 'block';
}
?>
<section class="lightbox login" id="intermediate-page" style="display:<?= $display; ?>">
    <article class="flex">
        <div class="col-6">
            <h4 class="heading text-upper">
                <?= $this->input('intermediate_left_content'); ?>
            </h4> 
            <?= $this->link('intermediate_singup', ['class' => 'button text-upper next-step-signup']); ?>
        </div>
        <div class="col-6">
            <h4 class="heading text-upper">
                <?= $this->input('intermediate_right_content'); ?>
            </h4>
            <?= $this->link('intermediate_login', ['class' => 'button text-upper tangerine next-step-login']); ?>
            <input type="hidden" name="publication_product_code" promo-code="<?= $this->config->promoCode ?>" material-code="" />
            <input type="hidden" name="app-link" signup-link="" login-link="" />
        </div>
    </article>
</section>
