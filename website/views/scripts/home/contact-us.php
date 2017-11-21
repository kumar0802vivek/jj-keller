<?php
$display = 'none';
if ($this->editmode) {
    $display = 'block';
}
?>
<script>
    var nameError = '<?= $this->translate("contactus.name.error.msg") ?>';
    var emailError = '<?= $this->t("contactus.email.error.msg") ?>';
    var emailPatternError = '<?= $this->t("contactus.emailpattern.error.msg") ?>';
    var numberError = '<?= $this->t("contactus.number.error.msg") ?>';
    var commentError = '<?= $this->t("contactus.comment.error.msg") ?>';
</script>

<section id="contact_us" style="display:<?= $display; ?>" class="lightbox container-small">
    <div class="ajax-loader">
        <img src="/website/static/images/common/loading.gif">
    </div>
    <article class="contact-us">
        <h1 class="heading2">
            <?php
            if ($this->editmode) {
                echo $this->input('contact_us_title');
            } else {
                echo $this->input('contact_us_title')->text;
            }
            ?>
        </h1>

        <div class="text">
            <?php
            if ($this->editmode) {
                echo $this->wysiwyg('contact_us_content');
            } else {
                echo $this->wysiwyg("contact_us_content")->getData();
            }
            ?>
        </div>

        <span class="error-message"></span>
        <form method="post" class="flex wrap" id="contact-us-form" novalidate="novalidate">
            <div class="form col-5">
                <p class="control-container">
                    <label><?= $this->input("name"); ?>*</label>
                    <input type="text"  name="name" class="textbox"/>
                </p>
                <p class="control-container">
                    <label><?= $this->input("company_name"); ?></label>
                    <input type="text" name="companyname" class="textbox"/>
                </p>
                <p class="control-container">
                    <label><?= $this->input("phone"); ?></label>
                    <input type="text" name="phone" maxlength="13" class="textbox" />
                </p>
                <p class="control-container">
                    <label><?= $this->input("email_address"); ?>*</label>
                    <input type="text" name="email"  class="textbox" />
                </p>
            </div>
            <div class="form col-5">
                <p class="control-container">
                    <label><?= $this->input("comment_or_question"); ?>*</label>
                    <textarea name="comment" class="textarea"></textarea>
                </p>

            </div>
            <div class="form col-12 ">
                <button type="button" id="cancel-button" class="button empty">Cancel</button>
                <button type="submit" class="button text-upper">Submit</button>
            </div>
        </form>
    </article>

    <article class="warning flex">
        <address class="col-6">
            <h3 class="heading color-disco"><?= $this->input('contact_us_mail'); ?></h3>
            <?php
            if ($this->editmode) {
                echo $this->wysiwyg("mail_detail");
            } else {
                echo $this->wysiwyg("mail_detail")->getData();
            }
            ?>
        </address>
        <address class="col-6">
            <h3 class="heading color-disco"><?= $this->input('contact_us_tech_support'); ?></h3>   
            <?php
            if ($this->editmode) {
                echo $this->wysiwyg("tech_support_detail");
            } else {
                echo $this->wysiwyg("tech_support_detail")->getData();
            }
            ?>
        </address>    
    </article>
</section>


