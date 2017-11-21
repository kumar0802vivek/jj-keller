           
<aside class="side-nav">
<div>
<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$urlParam = $uri_parts[0];

while ($this->block("sidebar_linkblock")->loop()) {

    if ($this->editmode) {
        echo $this->link("sidebar_link");
    } else {
        $linkPath = $this->link("sidebar_link")->getHref();
        if ($linkPath == $urlParam) {
            $status = 'active';
        } else {
            $status = '';
        }

        echo $this->link("sidebar_link", ['class' => $status]);
    }
}
?>
</div>
</aside>

<?php 
if($this->editmode) {
?>
<style>
 .pimcore_block_entry {
    border: 1px dashed #8b1e42;
    display: table;
    margin: 5px;
    padding: 5px;
}
a{ color:#8b1e42; font-size:18px;  font-family: "museo_sans500";}
.pimcore_tag_link{ display:inline-block !important;}
</style>
<?php } ?>
