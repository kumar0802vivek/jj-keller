<?php
$activeMarket = strtolower($this->data['activeMarket']);
$marketName_url = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->getParam('marketName')));
$curentMarket = ($marketName_url != "") ? $marketName_url : "";
?>
<section class="wrapper">
    <div class="container flex left">
        <?php 
                    if(!$this->editmode) {
                      if($this->snippet('compliance-library-sidebar')->getId() !== 0 || count($this->areablock('wysiwyg_content')->getData()) > 0) { ?>
                
                        <div class="col-3 edit-border">
                            <?=$this->snippet('compliance-library-sidebar'); ?>
                            <?=$this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
                        </div>      
                <?php      } else { ?>
                    
                        <?=$this->snippet('compliance-library-sidebar'); ?>
                        <?=$this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
                    
                    <?php }
                    
                } else { ?>
        <div class="col-3 edit-border">
                    <?=$this->snippet('compliance-library-sidebar'); ?>
                    <?=$this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
        </div>
              <?php  }
                ?>
        <aside>
            <h1 class="heading1">
                <?= $this->input('compliance_title');
                ?>
            </h1>
            <ul class="tabs market-tabs">
                <li><a href="<?php echo $this->document->getFullPath() ?>">

                        <span rel="#All">ALL</span></a>
                </li> 
                <?php
                if (count($this->markets) > 0) {
                    foreach ($this->markets as $marketKey => $marketName) {
                        ?>                
                        <li>
                            <a href="<?php echo $this->document->getFullPath() . '?marketName=' . $marketName['key'] ?>">
                                <?php
                                echo '<span rel=""';

                                if (null !== $marketName_url) {
                                    if ($marketName_url == $marketName['key']) {
                                        echo ' class="active"';
                                    }
                                }
                                echo '>' . $marketName['name'] . '</span>';
                                ?>                             
                            </a>
                        </li>
                    <?php }
                }
                ?>
            </ul>
            <article id="all" class="tab-container tab-active">
                <?php
                $this->products = json_decode($this->products); //p_r($this->products); die;
                if (count($this->products) > 0) {
                    foreach ($this->products as $key => $value) {
                        ?>
                        <section class="library" product-id="<?= $value->product_id ?>">
                            <aside class="figure col-3">
                                <span class="img-wrapper">
        <?= $value->product_img; ?>
                                </span>
                                <span class="text"><?= $value->market; ?></span>
                            </aside>
                            <aside class="col-9">
                                <h4 class="heading"><?= $value->product_name ?></h4>
                        <?= $value->short_desc ?>
                            </aside>
                        </section>
    <?php }
    ?>
                </article>
                <div class="ajax-loader1" style="display: none;">
                    <img src="/website/static/images/common/loading.gif">
                </div>
            <?php } else { 
		echo "No Products Found.";
            } ?>
        </aside>
    </div>
    <input type="hidden" id="ajaxstatus" value="free"/>
</section>

<?php $this->inlineScript()->appendScript('$(window).scroll(function () {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 500) {
            if ($("#ajaxstatus").val() != "waiting") {
                $(".ajax-loader1").show();
                $("#ajaxstatus").val("waiting");
                loadData.curentMarket = "'.$curentMarket .'";
                loadData();
            }
        }
    });

    loadData.counter = 0;
    function loadData() {
        loadData.counter++;

        $.ajax({
            type: "POST",
            url: "?controller=compliance-library&action=full-compliance-library-Ajaxload",
            data: {
                scrollcount: loadData.counter,
                currentMarket: loadData.curentMarket
            },
            dataType: "json",
            success: function (data) {

                productStr = "";
                if (data.ajaxData != null) {
                    $.each(data.ajaxData, function (index, element) { //ddata = $.parseJSON(data.ajaxData[index])
                        productStr += "<section class=\"library\" product-id=\"beta\">";
                        productStr += "<aside class=\"figure col-3\">";
                        productStr += "<span class=\"img-wrapper\">";
                        productStr += element.product_img;
                        productStr += "<span>";
                        productStr += "<span class=\"text\">";
                        productStr += element.market;
                        productStr += "</span>";
                        productStr += "</aside><aside class=\"col-9\">";
                        productStr += "<h4 class=\"heading\">" + element.product_name + "</h4>";
                        productStr += element.short_desc;
                        productStr += "</aside></section>";

                    });
                    $("#all").append(productStr);
                    $("#ajaxstatus").val("free");                    
                }
                $(".ajax-loader1").hide();

            },
            error: function (xhr) {
                console.log(xhr);   
            }
        });

    }');?>
