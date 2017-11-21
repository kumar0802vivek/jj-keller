<script>
    var landingProductRequired = '<?= $this->translate("publicationlanding.product.required") ?>';
    var promocodeRequired = '<?= $this->translate("publicationlanding.promocode.required") ?>';
</script>


<section class="wrapper">

    <?php if ($this->editmode) { ?>
        <h1 class="heading1 text-center introduction">
            <?= $this->input('publication_landing_heading', ["placeholder" => "Please Enter Headline"]); ?>
        </h1>
        <?php
    } else {
        if ($this->input('publication_landing_heading')->text != "") {
            ?>
            <h1 class="heading1 text-center introduction">
                <?= $this->input('publication_landing_heading')->text; ?>
            </h1>

            <?php
        }
    }
    ?> 
    <div class="container flex reverse">
        <?php
        if (!$this->editmode) {
            if ($this->snippet('product-listing-sidebar')->getId() !== 0 || count($this->areablock('wysiwyg_content')->getData()) > 0) {
                ?>

                <div class="col-3 edit-border">
                    <?= $this->snippet('product-listing-sidebar'); ?>
                    <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
                </div>      
            <?php } else { ?>

                <?= $this->snippet('product-listing-sidebar'); ?>
                <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>

                <?php
            }
        } else {
            ?>
            <div class="col-3 edit-border">
                <?= $this->snippet('product-listing-sidebar'); ?>
                <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
            </div>
        <?php } ?>


        <aside class="publications edit-border">

            <?= $this->areablock('campaign_area'); ?>
            <p>
                <input type="hidden" name="landing_product_code" class="landing-product-code" value="<?= $productCode ? implode(',', $productCode) : ''; ?>" />
                <input type="hidden" name="landing_promo_code" class="landing-promo-code" value="<?= $this->promoCode ?>" />

                <?= $this->link('landing_next_step', ['class' => 'button text-upper landing-next-step fancybox ']); ?>
            </p>

        </aside>
    </div>


    <br class="clear"/>

</section>

<?php if ($this->editmode) { ?>
    <style>  
        .publications{width:100% !important;}
        .publications  >div > div{ display:block !important; width:98% !important;}
        .edit-border{ border:1px dashed #8b1e42; margin:5px ; padding:0;}
    </style>
<?php } ?>
<?php
if (!$this->editmode) {
    echo $this->inc('/intermediate-page');
}
?>