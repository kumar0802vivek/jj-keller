<section class="banner">
    <p class="attached">
        <?= $this->link("free_trial", ["class" => 'button tangerine free_trial_link']); ?>
    </p>
    <?php
    if ($this->editmode) {
        echo $this->image("caraouselImage");
        $bkgrndImg = "";
    } else {
        $bkgrndImg = "background-image:url('" . $this->image("caraouselImage")->getSrc() . "')";
    }
    ?>       
    <article class="img-wrapper" style="<?= $bkgrndImg ?>">
        <div class="container no-padding relative">
            <div class="caption">
                <h2 class="heading"><?= $this->input("bannerHeadline", ["placeholder" => 'Please set a Headline']); ?></h2>
                <p class="text"><?= $this->wysiwyg("bannerDescription", ["placeholder" => 'Please set a Description']); ?></p>
                <?= $this->link("market-learnMoreLink", ["class" => 'button learnMoreLink']); ?>
            </div>
        </div>       
    </article>
</section>

<?php 
if($this->editmode) {
?>
<style>
 .banner {
    border: 1px dashed #8b1e42;
 
    margin: 5px;
    padding: 5px;
}
a{ color:#8b1e42; font-size:18px;  font-family: "museo_sans500";}
.pimcore_tag_link{ display:inline-block !important;}
</style>
<?php } ?>



