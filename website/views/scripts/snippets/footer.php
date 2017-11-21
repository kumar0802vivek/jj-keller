<footer>
    <section class="utility">
        <div class="container-big">
            <?php while ($this->block("footerMenulink")->loop()) { ?>
                <?= $this->link("footerlinks"); ?>                   
            <?php } ?>                    
        </div>
    </section>

    <section class="copyright">
        <div class="container-big">
            <section class="col-6">
                <p><?= $this->wysiwyg("footer_desc"); ?> </p>
                <?= $this->link("footer-link", ["class" => "button"]); ?>
            </section>

            <section class="col-6">
                <a href="<?=$this->link('footer-link')->getHref();?>" target="<?=$this->link('footer-link')->getTarget();?>" class="footer-logo">
                    <?=
                        $this->image("footer-logo", [
                            "title" => "Drag logo image here",
                            "attributes" => [
                                "alt" => "JJKeller",
                                "class" => "responsive"
                            ],
                            "thumbnail" => [
                                "height" => 100,
                                "width" => 210,
                                "aspectratio" => true,
                                "interlace" => true                    
                            ]
                        ]);
                        ?>
                    </a>
                <p class="clear"><?= $this->wysiwyg("copyright_desc"); ?></p>
            </section>
        </div>
    </section>
</footer>
 <?php 
 if(!$this->editmode) {
    echo $this->inc('/contact-us'); 
 }
 ?>
</body>
