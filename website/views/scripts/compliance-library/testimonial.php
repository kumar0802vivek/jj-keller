<?php
$marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->getParam('marketName')));
$curentMarket = ($marketName != "") ? $marketName : "transportation";
?>
<section class="wrapper">
    <div class="container flex left">

        <?php
        if (!$this->editmode) {
            if ($this->snippet('compliance-library-sidebar')->getId() !== 0 || count($this->areablock('wysiwyg_content')->getData()) > 0) {
                ?>

                <div class="col-3 edit-border">
                    <?= $this->snippet('compliance-library-sidebar'); ?>
                    <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
                </div>      
            <?php } else { ?>

                <?= $this->snippet('compliance-library-sidebar'); ?>
                <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>

            <?php
            }
        } else {
            ?>
            <div class="col-3 edit-border">
                <?= $this->snippet('compliance-library-sidebar'); ?>
            <?= $this->areablock('wysiwyg_content', ["allowed" => ["wysiwyg-editor"]]); ?>
            </div>
        <?php }
        ?>
        <aside>
            <h1 class="heading1">
<?= $this->input('testimonial_title'); ?>
            </h1>
            <ul class="tabs market-tabs">
                <?php
                if (count($this->markets) > 0) {
                    foreach ($this->markets as $marketKey => $marketName) {
                        ?>                
                        <li>
                            <a href="<?= '/testimonial?marketName=' . $marketName['key'] ?>">
                                <?php
                                echo '<span rel=""';

                                if (null !== $curentMarket) {
                                    if ($curentMarket == $marketName['key']) {
                                        echo ' class="active"';
                                    }
                                }
                                echo '>' . $marketName['name'] . '</span>';
                                ?>                             
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
                <?php if (count($this->testimonials) > 0) { ?>
                <article id="transportation" class="tab-container tab-active">
    <?php foreach ($this->testimonials as $testimonialKey => $testimonialName) { ?>    
                        <section>                            
                            <div class="text"><?= $testimonialName['testimonialDesc']; ?></div>                            
                            <span class="signature"><?= $testimonialName['customerName'] ?><span class="title"><?= $testimonialName['customerLocation'] ?></span></span>
                        </section>
                <?php } ?>
                </article>
<?php } else {
    echo $this->t('no-testimonial');
} ?>
            <div class="ajax-loader1" style="display: none;">
                <img src="/website/static/images/common/loading.gif">
            </div>
        </aside>
    </div>
    <input type="hidden" id="ajaxstatus" value="free"/>
</section>

<?php $this->inlineScript()->appendScript('$(window).scroll(function () {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 500) {
            if ($("#ajaxstatus").val() != "waiting") {
                $(".ajax-loader1").show();
                $("#ajaxstatus").val("waiting");
                loadData.curentMarket = "' . $curentMarket . '";
                loadData();
            }
        }
    });

    loadData.counter = 0;
    function loadData() {
        loadData.counter++;
        $.ajax({
            type: "POST",
            url: "?controller=compliance-library&action=testimonial-Ajaxload",
            data: {
                scrollcount: loadData.counter,
                currentMarket: loadData.curentMarket
            },
            dataType: "json",
            success: function (data) {

                productStr = "";
                if (data.ajaxData != null) {
                    $.each(data.ajaxData, function (index, element) {
                        productStr += "<section>";
                        productStr += "<span class=\"title\"></span>";
                        productStr += "<p class=\"text\">"+element.testimonialDesc+"</p>";
                        productStr += "<span class=\"signature\">"+element.customerName+"<span class=\"title\">"+element.customerLocation+"</span></span>";
                        productStr += "</section>";

                    });
                    $("#transportation").append(productStr);
                    $("#ajaxstatus").val("free");
                }
                
                $(".ajax-loader1").hide();

            },
            error: function (xhr) {
                console.log(xhr);
                $("#transportation").append(xhr.statusText);

            }
        });

    }'); ?>
</aside>
</div>
</section>
<?php if ($this->editmode) { ?>
    <style>
        .edit-border{ border:1px dashed #8b1e42; margin:5px ; padding:0;}
    </style>
<?php } ?>

