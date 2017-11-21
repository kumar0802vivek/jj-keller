
<?php if ($this->editmode): ?>      
         <div class="side-text">      
            <?= $this->multihref("product_object", [
                "types" => ["object"],
                "subtypes" => [
                    "object" => ["object"]
                ],
                "classes" => ["Product"]
            ]); ?>       
            </div>     
        <?php else: 
            $productCode =  array();
            $count = 0;
            foreach ($this->multihref("product_object") as $product):
                if ($count >= 5) {
                    break;
                }
                
                if($product->getPublished() == '') {
                    continue;
                }
                
                $productImage = '';
                if ($product->getExternal_img()->url != "") {
                    $productImage = $product->getExternal_img()->url;
                } elseif ($product->getProduct_img()) {
                    $productImage = $product->getProduct_img()->getThumbnail(["width" => 200]);
                }
                if($product->getProduct_code()){
                    $productCode[] = $product->getProduct_code();
                }
                
                
            ?>
                <aside class="side-text">
                <span class="img-wrapper"><img src="<?= $productImage; ?>" class="responsive"/></span>
                <h3 class="heading"><?= $product->getProduct_name(); ?></h3>
                <p class="text"><?= strip_tags($product->getShort_desc()); ?></p>
                    
                </aside>

            <?php $count++;
                endforeach; 
            ?>
                <input type="hidden" name="landing_product_code" class="landing-product-code" value="<?= $productCode ? implode(',', $productCode) : ''; ?>" />

                <input type="hidden" name="landing_promo_code" class="landing-promo-code" value="<?= $this->promoCode ?>" />            
<?php endif; ?>
