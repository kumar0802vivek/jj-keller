<section class="slider">
    <div class="attached">

        <!--        <a href="/publication-section" class="button tangerine"></a>-->
        <?= $this->link('free_trial_link', ['class' => 'button tangerine free_trial_link']); ?>
    </div>
    <div id="jjkeller-slider" class="owl-carousel">   
        <?php
        while ($this->block("contentblock")->loop()) {
            if ($this->editmode) {
                echo $this->image("caraouselImage", [
                    "thumbnail" => ["height" => 500]
                ]);

                echo '<div class="item">';
            } else {
                $bkgrndImg = "background-image:url('" . $this->image("caraouselImage")->getSrc() . "')";
                echo '<div class="item" style="' . $bkgrndImg . '">';
            }
            ?>       

            <div class="container-big">
                <div class="caption">
                    <span class="title"><?= $this->input("carouselHeadline", ["placeholder" => 'Please set a Title']); ?></span>
                    <h2 class="heading"><?= $this->input("carouselHeadline2", ["placeholder" => 'Please set a Headline']); ?></h2>
                    <p class="text"><?= $this->wysiwyg("carouselDescription", ["placeholder" => 'Please set a Description']); ?></p>
    <?= $this->link("learnMoreLink", ["class" => 'button learnMoreLink text-upper']); ?>
                </div>
            </div>
            <?php echo '</div>'; ?>

<?php } ?>
    </div>
</section>
<?php if ($this->editmode) { ?>
    <style>
        .pimcore_block_entry {
            border: 1px dashed #8b1e42;
            display: table;
            margin: 5px;
            padding: 5px;
        }
        a{ color:#8b1e42; font-size:18px;  font-family: "museo_sans500";}
        .pimcore_tag_link{ display:inline-block !important;}
        .attached{  text-align:right;}
    </style>
<?php } ?>
