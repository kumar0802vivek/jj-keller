<!doctype html>
<html  xml:lang="en" lang="en">
    <head>        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="shortcut icon" type="image/x-icon" href="jjkeller-ico.ico">
        <?php   
            // output the collected meta-data
            if(!$this->document) {
                // use "home" document as default if no document is present
                $this->document = Document::getById(1);
            }
            
            if($this->document->getType() === 'page') {
                if($this->document->getTitle()) {
                    // use the manually set title if available
                    $this->headTitle()->set($this->document->getTitle());
                } else {
                    // use the manually set title if available
                    $this->headTitle()->set(Document::getById(1)->getTitle());
                }
                
                if($this->document->getDescription()) {
                    // use the manually set description if available
                    $this->headMeta()->appendName('description', $this->document->getDescription());
                } else {
                    // use the manually set description if available
                    $this->headMeta()->appendName('description', Document::getById(1)->getDescription());
                }
            }

            echo $this->headTitle();
            echo $this->headMeta();
        ?>

        <?php
        if($this->editmode){
            $this->headLink()->appendStylesheet('/website/static/css/jjkeller-edit.css');
        } else {
            $this->headLink()->appendStylesheet('/website/static/css/jjkeller.css');
        }
            
            $this->headLink()->appendStylesheet('/website/static/css/owl.carousel.css');
            $this->headLink()->appendStylesheet('/website/static/css/jquery.fancybox.css');
        ?>
        <?= $this->headLink(); ?>
        <?php
            $this->headScript()->appendFile('/website/static/js/jquery.min.js');
            echo $this->headScript();
        ?>
    </head>

    <body>
        <?php 
        
            // Header
            echo $this->inc('/includes/header');
            echo $this->layout()->content;
            //footer
            echo $this->inc('/includes/footer');
       ?>
 <?php
        $this->headScript()->appendFile('/website/static/js/owl.carousel.js');
        $this->headScript()->appendFile('/website/static/js/jquery.fancybox.js');        
        $this->headScript()->appendFile('/website/static/js/jquery.validate.min.js');
        $this->headScript()->appendFile('/website/static/js/jjkeller.js');
                
        echo $this->headScript();
        echo $this->inlineScript();
    ?>
    <script>
        $(document).ready(function (e) {

            $('.hamburger').click(function () {
                $(this).children('.bar').toggleClass('animate');

                $('[data-role=navigation]').slideToggle('500', function () {
                    $('[data-role=navigation]').toggleClass('on');
                });
            });

            $("#jjkeller-slider").owlCarousel({
                items: 1,
                animateOut: 'fadeOut',
                loop: true,
                nav:false,
                margin: 0,
                autoplay: <?=$this->config->carouselPlayTime?>,

            });
            
        });
    </script>
</html>