<div id="logo">
    <?php if($this->editmode){
        echo $this->image('mail_logo');
    }else{
       $logoImageSrc = $this->image('mail_logo')->getSrc();
       echo "<img src='".$logoImageSrc."' width='300' />";
    }
    ?>
    
</div>

<h1><?= $this->input("headline"); ?></h1>
<p>
    <?= $this->wysiwyg("content"); ?>
</p>
  