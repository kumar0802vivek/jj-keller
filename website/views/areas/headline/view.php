    <h1 class="heading1">
        <?php
        if ($this->editmode) {
            echo $this->input('compliance_title', ['placeholder' => "Please enter a Heading"]);
        } else {
            echo $this->input('compliance_title')->text;
        }
        ?>
    </h1>      