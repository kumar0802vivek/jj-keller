<script>
    var productRequired = '<?= $this->translate("publicationsection.product.required") ?>';
</script>

<section class="introduction">
    <h1 class="heading1">
        <?php
        if ($this->editmode) {
            echo $this->input('publication_heading');
        } else {
            echo $this->input('publication_heading')->text;
        }
        ?>
    </h1>
    <?= $this->wysiwyg('publication_section_content', ["placeholder" => "Please Enter Some Description"]); ?>
    <article class="intro-highlights publications">
        <?php if (count($this->productListings) > 0) { ?>

            <?php foreach ($this->productListings as $key => $products) { ?>
                <section>
                    <h4 class="heading">
                        <?php
                        if ($key == "Human Resources") {
                            $key = "HR";
                        }
                        if ($key == "Transportation") {
                            $key = "Transport";
                        }
                        ?>
                        <?= $key . ' Publications'; ?></h4> 
                    <?php
                    $count = 0;

                    foreach ($products as $productCodeKey => $product) {
                        if ($count >= 3) {
                            break;
                        }
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
                        $count++;
                        $radioCount++;
                    }
                    ?>
                </section>
                <?php
            }
        } else {
            ?>
            <?= $this->t('publicationsection.noproduct.available'); ?>
        <?php }
        ?>
    </article>

    <?= $this->link("publication_next_step", ["class" => "button text-upper fancybox publication-next"]); ?>
</section>
<?php
if (!$this->editmode) {
    echo $this->inc('/intermediate-page');
}
?>
