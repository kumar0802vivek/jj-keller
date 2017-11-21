<?php

class Document_Tag_Area_Pdf extends Document_Tag_Area_Abstract 
{
    /**
     * Returns a custom html wrapper element (return an empty string if you don't want a wrapper element)
     */
    public function getBrickHtmlTagOpen($brick){
        //return '<span class="customWrapperDiv">';
    }
 
    public function getBrickHtmlTagClose($brick){
        //return '</span>';
    }
}

?>