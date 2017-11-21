<?php
    if($this->editmode){
        $this->headLink()->appendStylesheet('/website/static/css/jjkeller-edit.css');
    }
   echo $this->headLink();
?>
<header>
    <div class="container-big">
        <a href="/" class="logo">
            <?=
            $this->image("logo", [
                "title" => "Drag logo image here",
                "attributes" => [
                    "alt" => "JJKeller",
                    "class" => "responsive"
                ],
                "thumbnail" => [
                    "height" => 97,
                    "width" => 544,
                    "aspectratio" => true,
                    "interlace" => true                    
                ]
            ]);
            ?>                    
        </a>
        <div class="login">            
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            <?=$this->link('corner-link');?>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <?=$this->link('extra-corner-link');?>
        <?php } ?>

    </div>
</header>

<nav>
    <div class="hamburger">
        <div class="bar"></div><span class="text"><?=$this->t("menu-mobile-link");?></span>
    </div>
    <div class="container-big" data-role="navigation">
        <?php while ($this->block("headermenus")->loop()) { ?>
            <?= $this->link("headermenulinks"); ?>                   
<?php } ?>               

    </div>
</nav>