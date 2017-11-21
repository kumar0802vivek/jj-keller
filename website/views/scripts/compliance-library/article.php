<?php
$marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->getParam('marketName')));
$curentMarket = ($marketName != "") ? $marketName : "transportation";
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
       
       
        <?php if($this->articleDetails){ ?>
            <aside class=" edit-border">
            <h1 class="heading1"><?= $this->input('article_title'); ?></h1>
            <?php $articleDetails = $this->articleDetails;
                if (count($articleDetails) > 0) { ?>
                <article class="tab-container tab-active">
                    <section class="news">
                        <h4 class="heading"><?= $articleDetails['article_name']; ?></h4>
                        <p class="by"><?=$this->t(' publication-section.by')?>: <span class="inner-text color-disco"><?= $articleDetails['editor_name']; ?></span></p>
                        <p class="publication"><?=$this->t('publication-section.publication')?>: <span class="inner-text color-disco"><?= $articleDetails['publication_name']; ?></span></p>
                        <p class="text date-posted"><?=$this->t('publication-section.date-posted');?>: <span class="inner-text color-disco"><?= $articleDetails['posted_date']; ?></span></p>
                        <p class="text"><?php echo $articleDetails['article_desc']; ?>
                           
                    </section>
                </article>
            <?php
            } else {
                echo $this->t('no-article');
            }
            ?>
        </aside>
        <?php }
        elseif($this->articles) { ?>
            <aside>
            <h1 class="heading1"><?= $this->input('article_title'); ?></h1>
            <ul class="tabs market-tabs">
                <?php
                    if(count($this->markets) > 0) {
                    foreach ($this->markets as $marketKey => $marketName) {
                    ?>               
                    <li>
                        <a href="<?= '/news-article?marketName=' . $marketName['key'] ?>">
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
                } ?>
            </ul>
            <?php if(count($this->articles) > 0) {  ?>
            <article id="transportation" class="tab-container tab-active">
                <?php
                    if(count($this->articles) > 0) {
                    foreach ($this->articles as $articleKey => $articleName) { ?>   
                    <section class="news">
                        <h4 class="heading"><?= $articleName['article_name']; ?></h4>
                        <p class="by">By: <span class="inner-text color-disco"><?= $articleName['editor_name']; ?></span></p>
                        <p class="publication">Publication: </strong> <span class="inner-text color-disco"><?= $articleName['publication_name']; ?></span></p>
                        <p class="text date-posted">Date Posted: <span class="inner-text color-disco"><?= $articleName['posted_date']; ?></span></p>
                        <div class="text"><?php echo substr($articleName['article_desc'], 0, 400); ?><?php if(strlen($articleName['article_desc']) > 400){echo '...';?></div>
                            <p class="text"><a href="news-article?acticleId=<?= $articleName['article_id']; ?>" class="fancybox link underline"><?php if(strlen($articleName['article_desc']) > 120) {?>Read more <?php } ?></a></p>

                         <?php }                
                        ?>
                    </section>
                <?php }  
                    }
                ?>
            </article>
                    <div class="ajax-loader1" style="display: none;">
                        <img src="/website/static/images/common/loading.gif">
                    </div>
            <?php } else { ?>
                <?=$this->t('no-article');?>
            <?php } ?>
        </aside>
        <?php }
        else{ ?>
            <aside>
                <h1 class="heading1"><?= $this->input('article_title'); ?></h1>
                <?=$this->t('no-article');?>
            </aside>
        <?php }
        ?>
       
       
    </div>
    <input type="hidden" id="ajaxstatus" value="free"/>
</section>
<?php if ($this->editmode) { ?>
<style>
    .edit-border{ border:1px dashed #8b1e42; margin:5px ; padding:0;}
</style>
<?php } ?> 

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
            url: "?controller=compliance-library&action=article-Ajaxload",
            data: {
                scrollcount: loadData.counter,
                currentMarket: loadData.curentMarket
            },
            dataType: "json",
            success: function (data) {
                productStr = "";
                if (data.ajaxData != null) {
                    $.each(data.ajaxData, function (index, element) {
                    var subDescPostFix = "";
                    var readMoreLink ="";
                    if(element.article_desc.length>400){
                     subDescPostFix = "..."
                        readMoreLink ="<p class=\"text\"><a href=\"news-article?acticleId="+element.article_id+"\" class=\"fancybox link underline\">Read more</a></p>"                   
                       }
                        productStr +="<section class=\"news\">";
                        productStr +="<h4 class=\"heading\">"+element.article_name+"</h4>";
                        productStr +="<p class=\"by\">By: <span class=\"inner-text color-disco\">"+element.editor_name+"</span></p>";
                        productStr +="<p class=\"publication\">Publication: </strong> <span class=\"inner-text color-disco\">"+element.publication_name+"</span></p>";
                        productStr +="<p class=\"text date-posted\">Date Posted: <span class=\"inner-text color-disco\">"+element.posted_date+"</span></p>";
                        productStr +="<div class=\"text\">"+element.article_desc.substring(0, 400)+subDescPostFix+"</div>" ;
                        productStr +=readMoreLink;
                        productStr +="</section>";
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
