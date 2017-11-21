<!--Carousel Snippet-->
<?= $this->snippet("caraouselSnippet"); ?>


<section class="introduction home">
    <h1 class="heading1"><?= $this->input("introduction-headline", ["placeholder" => 'Please set a introduction title']); ?></h1>
    <p class="text">
        <?= $this->wysiwyg("introduction-description", ["placeholder" => 'Please enter some description']); ?>
    </p>
</section>

<section class="resources relative">
    <section class="highlighted resource" id="highlighetd-section">
        <div class="container-big">
            <aside class="col-4">
                <span class="title"><?= $this->input("midfirst-title"); ?></span>
                <h2 class="heading2"><?= $this->input("midfirst-heading"); ?></h2>
                <?= $this->wysiwyg("midfirst-description"); ?>
                <?= $this->link("view-demo-link", ["class" => "fancybox various iframe button text-upper"]); ?>                               
                <span class="side-link-arrow color-disco" id="more-benefit">
                    <span class="more"><?=$this->t('more-benefit');?> <i class="fa fa-plus" aria-hidden="true"></i></span>
                    <span class="less"><?=$this->t('close');?> <i class="fa fa-close" aria-hidden="true"></i></span>
                </span>            
            </aside>
            <aside class="col-8 benefit less">               
                <div class="inner">
                    <?= $this->wysiwyg("midsecond-description"); ?>
                    <span class="heading3 color-disco inline-block"><?=$this->input("midsecond-trial-link"); ?></span>
                    <?= $this->link("midsecond-signup-link", ["class" => "button tangerine text-upper"]); ?>
                </div>
               
            </aside>
            <aside class="col-8 benefit more">
                <?php if($this->editmode) { ?>
                <?php
                    echo $this->image("midthird-laptop-img",[
                           "thumbnail" => [
                               "height" => 460,
                               "width" => 380,
                               "aspectratio" => true,
                               "interlace" => true ]                 
                           ]); 
                ?>
               
                <?php } else {?>
                <span class="side-image" style="background-image: url(<?=$this->image('midthird-laptop-img')->getSrc()?>)">
                    
                </span>
                <?php } ?>
                <div class="col-6 disco-inner">
                    <span class="title"><?= $this->input("midthird-title"); ?></span>
                    <h2 class="heading2"><?= $this->input("midthird-heading"); ?></h2>
                    <?= $this->wysiwyg("midthird-description"); ?>                    
                    <?= $this->link("midthird-signup-link", ["class" => "button tangerine text-upper"]); ?>
                </div>
            </aside>
        </div>
        <div id="youtube-video" style="display: none;" class="fancybox-container news">
             <?=$this->video("campaignVideo"); ?>
        </div>
    </section>


    <span class="watermark"></span>

    <section class="resource">
        <div class="container-big">
            <aside class="col-6 figure">
                <div class="max-width450">
                <span class="title"><?= $this->input("whitepaper-title"); ?></span>
                <h2 class="heading2"><?= $this->input("whitepaper-headline"); ?></h2>
                <figure>           
                    <figcaption class="col-6"><?= $this->wysiwyg("whitepaper-description"); ?> <?= $this->link("whitepaper-download-link", ["class" => "button empty"]); ?></figcaption>             
                    <span class="figure-image right col-6"><?= $this->image("whitepaper-image", ["class" => 'responsive floatR']); ?></span>
                </figure>
                
                </div>
            </aside>
            <aside class="col-6 figure">
                <div class="max-width400">
                <span class="title"><?= $this->input("tailored-title"); ?></span>
                <h2 class="heading2"><?= $this->input("tailored-headline"); ?></h2>
                <div><?= $this->wysiwyg("tailored-description"); ?></div>
                 </div>
                <?= $this->link("view-case-studies-button", ["class" => "button empty"]); ?>
                <span class='side-link-arrow'> <?= $this->link("contact-sales-rep-button", ["class" => 'fancybox']); ?>&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
               
            </aside>
        </div>
    </section>

</section>
<style type="text/css">
    @media screen and (min-width:1000px){
    .resource.highlighted.on{
        background-image: url(<?=$this->image('midthird-laptop-img')->getSrc()?>);
    }
    }
</style>