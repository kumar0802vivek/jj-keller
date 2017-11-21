<?php
$recentArticles = $this->atricles;
$testimonials = $this->testimonials; 
$categories = $this->categories;

$fullLibraryPath = Document::getById(13)->getFullPath();
$newsArticlasPath = Document::getById(12)->getFullPath();
?>
<?= $this->snippet("bannerTransportation"); ?>
<section class="introduction">
    <!--KEEP YOUR DRIVERS SAFE-->
    <h1 class="heading1"><?= $this->input("introduction", ["placeholder" => 'Please set a introduction title']); ?></h1>
    <p class="text"><?= $this->input("txtDriveSafe", ["placeholder" => 'Please set a introduction Text']); ?></p>

    <article class="intro-highlights"> 
        <?php
        if (count($categories) > 0) {
            foreach ($categories as $id => $value):
                ?>
                <section>
                    <span class="icon"><img src="<?= $value['catImg'] ?>" alt=""/></span>
                    <h4 class="heading"><?= $value['catName'] ?></h4>
                    <p class="text"> <?= $value['catDesc'] ?> </p>
                    <div class="btn">
                        <span class="fa-bg"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <a  class="fancybox button view-example-link" href="#inline"  onclick="changePopUpData(<?= $value['catMarketId'] ?>, <?= $value['catId'] ?>, '<?= $value['catMarket'] ?>');"><?=$this->t('view-example');?></a>
                    </div>
                </section>
                <?php
            endforeach;
        }else {
            ?>
            <section>
                <h4 class="heading">No Category found.</h4>
            </section>
        <?php } ?>
    </article>
    <!--KEEP YOUR DRIVERS SAFE-->
</section>

<!--SignUp-->
<section class="sign-up">
    <p><span class="heading"><?= $this->input("signUp", ["placeholder" => 'Enter SignUp heading']); ?></span>
        <?= $this->input("signUpText", ["placeholder" => 'Enter SignUp text']); ?>
        <?= $this->link("signUpNow", ["class" => 'button tangerine']); ?>
    </p>
</p>
</section>
<!--SignUp-->

<section class="article-highlights">
    <div class="container-big">
        <!--Recent Articles-->
        <article class="col-4">
            <h3 class="heading"><?= $this->input("recentArticles", ["placeholder" => 'Enter Recent Articles heading']); ?></h3>
            <span class="date"><?= $recentArticles['creationDate'] ?> </span>
            <a href="#article-<?= $recentArticles['articleId']; ?>" class="fancybox link underline" ><?= $recentArticles['articleName'] ?></a>
            <div class="text"><?= substr($recentArticles['articleDesc'], 0, 70).'...'; ?>
                <a href="#article-<?= $recentArticles['articleId']; ?>" class="fancybox link underline">Read more</a>
            </div>
            <span class="side-link-arrow"><?= $this->link("moreArticles"); ?>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>

            <!-- Detailed info of article -->
            <div id="article-<?= $recentArticles['articleId']; ?>" style="display: none; min-width:500px;" class="fancybox-container news text-color">
                <h4 class="heading">
                    <?= $recentArticles['articleName']; ?>
                </h4>
                <p class="by">By: <span class="inner-text color-disco"><?= $recentArticles['editorName']; ?></span></p>
                <p class="publication">Publication: <span class="inner-text color-disco"><?= $recentArticles['publicationName']; ?></span></p>
                <p class="text date-posted">Date Posted: 
                    <span class="inner-text color-disco">
                        <?= $recentArticles['creationDate']; ?>
                    </span>
                </p>
                <?= $recentArticles['articleDesc']; ?>
            </div>
        </article>
        <!--Recent Articles-->
        <!--Free White Papers-->
        <article class="col-4">
            <h3 class="heading">
                <?= $this->input("freeWhitePapers", ["placeholder" => 'Enter Free White Papers heading']); ?>
            </h3>
            <?= $this->wysiwyg("freeWhitePapersText", ["placeholder" => 'Enter Free White Papers text']); ?>
            <span class="side-link-arrow"><?= $this->link("moreWhitePapers"); ?>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
        </article>
        <!--Free White Papers-->
        <!--New Publication-->
        <article class="col-4">
            <h3 class="heading">
                <?= $this->input("newPublication", ["placeholder" => 'Enter New Publication heading']); ?>
            </h3>
            <?= $this->wysiwyg("newPublicationText", ["placeholder" => 'Enter New Publication text']); ?>
            <span class="side-link-arrow"><?= $this->link("morePublication"); ?>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
        </article>
        <!--New Publication-->


    </div>
</section>


<section class="transportation relative">
    <!--ASK INDUSTRY EXPERTS-->
    <article class="highlighted">

        <div class="container-big">
            <aside class="col-5 ">
                <div class ="add-image">
                    <?php
                    if ($this->editmode) {
                        echo $this->image('transportationContentImage',['width'=> '150px']);
                     }
                   ?>
                </div>
                <blockquote class="max-width400">
                    <span class="title"><?= $this->input("askIndustryExpertTitle", ["placeholder" => 'Enter ASK INDUSTRY EXPERTS Title']); ?></span>
                    <h4 class="heading"><?= $this->input("askIndustryExpertHeading", ["placeholder" => 'Enter ASK INDUSTRY EXPERTS Heading']); ?></h4>
                </blockquote>
            </aside>
            <aside class="col-6">
                
                <div class="max-width400">
                    <p class="text">
                        <?= $this->wysiwyg("askIndustryExpertText", ["placeholder" => 'Enter ASK INDUSTRY EXPERTS text']); ?>
                    </p>
                </div>
                <?= $this->link("linkLearnMore", ["class" => 'button empty white']); ?>
                <span class="side-link-arrow white"><?= $this->link("linkContactSalesRep", ["class" => 'fancybox']); ?>&nbsp;
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
            </aside>
        </div>
    </article>
    <span class="watermark"></span>
    <!--ASK INDUSTRY EXPERTS-->

    <!--TESTIMONIALS-->
    <article class="container-small transportation-slider">
        <div id="transportation-slider" class="owl-carousel">   
            <?php
            $doc = Document::getById(9);
            $urlTestimonial = $doc->getFullPath();
            if (count($testimonials) > 0) {
                foreach ($testimonials as $key => $val) {
                    ?>
                    <div class="item">
                        <div class="market-testimonial"><?=$val['testimonialDesc']?></div>
                        <span class="signature">
                            <?= $val['customerName'] ?>
                            <span class="title">
                                <?= $val['customerLocation'] ?>
                            </span>
                        </span>
                        <span class="side-link-arrow"><a href="<?=$urlTestimonial?>?marketName=<?=$this->market?>"><?=$this->t('more-testimonial');?></a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                    </div>
                <?php }
            } else {
                ?>
            <div class="item">
                <p class="text">No Testimonials found</p>
            </div>
<?php } ?>

        </div>
    </article>
</section>
<!--TESTIMONIALS-->

<!--ENTERPRISE LEVEL-->
<figure class="plain">
    <figcaption class="col-6">
        <span class="title small color-disco"><?= $this->input("enterpriseLevelTitle", ["placeholder" => 'Enter TAILORED SOLUTIONS title']); ?></span>
        <h2 class="heading2"><?= $this->input("enterpriseLevel", ["placeholder" => 'Enter ENTERPRISE LEVEL']); ?></h2>
        <p class="text">
        <?= $this->wysiwyg("enterpriseLevelText", ["placeholder" => 'Enter ENTERPRISE LEVEL text']); ?>
        </p>
<?= $this->link("caseStudyLink", ["class" => 'button empty fancybox']); ?>
    </figcaption>
    <span class="img-wrapper col-6">
<?= $this->image("transportationImage", ["class" => 'responsive']); ?>
    </span>
</figure>
<!--ENTERPRISE LEVEL-->
<!--CATEGORY POPUP--> 
<section class="lightbox container-small" id="inline" style="display: none;">
    <article class="manual-slider">
        <div id="manual-slider" class="owl-carousel "> 
            <figure class="plain item">#</figure>
        </div>
    </article> 

    <article class="warning">
        <span class="img-wrapper"></span>
        <h3 class="heading" id="product-category"></h3>
        <a href="<?= $fullLibraryPath ?>?marketName=" class="button full-library-path"><?=$this->t('marketPopup.view-full-library');?></a>
    </article>
</section>
<!--CATEGORY POPUP-->

<script type="text/javascript">

    function changePopUpData(marketId, catId, market) {
        var owl = $("#manual-slider");
        $('.owl-item').each(function (index) {
        $('#manual-slider').trigger('remove.owl.carousel', index).trigger('refresh.owl.carousel');

        });
        
        owl.owlCarousel();
        owl.trigger('owl.destroy');
        $.ajax({
            cache: false,
            url: "/?controller=market&action=category-products",
            type: "post",
            async: true,
            data: {
                marketId: marketId,
                catId: catId
            },
            success: function (data) {
                var arr = data.split('END');
                $.each(arr, function(index) {
                    $('#manual-slider').trigger('add.owl.carousel', [arr[index], index]).trigger('refresh.owl.carousel');
                });              

                $('article.warning a').attr('href', '<?=$fullLibraryPath;?>?marketName='+market);
            }
        });
        
        $.ajax({
            cache: false,
            url: "/?controller=market&action=get-category-details",
            type: "post",
            async: true,
            data: {                
                catId: catId
            },
            success: function (data) {
               var cat_data = jQuery.parseJSON(data);               
               $('.warning').find('.img-wrapper').html(cat_data.cat_image);
               $('article.warning h3#product-category').text(cat_data.cat_name);              
            }
        });
    }
</script>

<style>
    .transportation .highlighted::before {
        background-image: url(<?= $this->image('transportationContentImage')->getSrc() ?> );
    }
    
    @media screen and (max-width:580px){
      .transportation .highlighted{  background-image: url(<?= $this->image('transportationContentImage')->getSrc() ?> );
    }
    }
    
</style>    
<?php

if (!$this->editmode) {
    echo $this->inc('/intermediate-page');
}
?>