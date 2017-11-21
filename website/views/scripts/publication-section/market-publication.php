<script>
    var productRequired = '<?= $this->translate("publicationsection.product.required") ?>';
</script>

<section class="introduction">
    <h1 class="heading1">
        <?= $this->input('market_publication_heading', ["placeholder" => "Please Enter Publication Headline"]); ?>
    </h1>
    <?= $this->wysiwyg('market_publication_content', ["placeholder" => "Please Enter Some Description"]); ?>
    <article class="intro-highlights publications block">
    <section>
        <?php
        if (count($this->productListings) > 0) {
            $radioCount = 0;
            foreach ($this->productListings as $key => $products) {
                    if(count(products) > 0) {
                ?>                
                    <?php
                    foreach ($products as $productCodeKey => $product) {
                        ?>
                        <p class="radio control-container" title="<?= $product['productName'] ?> &#10; <?= strip_tags($product['shortDesc']) ?>">
                            <input type="radio" class="product-radio" id="radio<?= $radioCount ?>" name="product_name" value="<?= $productCodeKey; ?>"/>
                            <label for="radio<?= $radioCount ?>" class="control-wrapper">
                                <span class="img-wrapper">
                                    <?= $product['productImg'] ?>
                                </span>

                                <span class="text">
                                    <strong class="bold"><?= $product['productName'] ?></strong>
                                    <?php
                                    if (strlen($product['shortDesc']) > 100) {
                                        $prod_detail = substr($product['shortDesc'], 0, 92) . '...';
                                    } else {
                                        $prod_detail = $product['shortDesc'];
                                    }

                                    echo strip_tags($prod_detail);
                                    ?>
                                </span>
                            </label>
                        </p>

                        <?php
                        $radioCount++;
                    }
                    ?>
                
                <?php
            }
            }
        } else {
            ?>
            <?= $this->t('publicationsection.noproduct.available'); ?>
        <?php }
        ?>
        </section>
    </article>

    <?= $this->link("publication_next_step", ["class" => "button text-upper publication-next fancybox"]); ?>
</section>
<?php 
 if(!$this->editmode) {
    echo $this->inc('/intermediate-page');  
 }
 ?>