<?php

$productsObject = $this->products;
$str = "";
foreach ($productsObject as $key => $product) { //p_r($product); die;
    $prod_img = Website_Library::getProductImage($product->getId(), 'market-popup-image');
    $str .= '<figure class="plain item">
            <span class="img-wrapper col-5">
            ' . $prod_img . '
            </span>
            <figcaption class="col-6">
            <h2 class="heading">' . $product->getProduct_name() . '</h2>';
    if ($product->getShow_subhead()) {
        $str .= '<h3 class="text-color">' . $product->getSubhead() . '</h3>';
    }
    $str .= '<p class="text short-description">' . $product->getShort_desc() . '</p>
            <div id="full-description' . substr($product->getId(), 0, 100) . '" class="full-description">
            <p class="text">' . $product->getProduct_desc() . '</p>
            </div>';


    $str .= '<a class="button tangerine popup-try-product fancybox" product-code ="' . $product->getProduct_code() . '"  href="#intermediate-page">';
    $str .= $this->t('marketpopup.try-this-product') . '</a>';
    $str .= '<span class="side-link-arrow more-info"  rel="#full-description' . $product->getId() . '">&nbsp;';
    if (trim($product->getProduct_desc()) !== '') {
        $str .= '<span class="more">' . $this->t("marketPopup.more-info") . ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
            <span class="less">' . $this->t("close") . ' <i class="fa fa-close" aria-hidden="true"></i></span>';
    }
    $str .= '</span>
            </figcaption>
            </figure>END';
}
$str = rtrim($str, 'END');
echo $str;
?>