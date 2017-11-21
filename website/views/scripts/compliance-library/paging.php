<?php echo p_r($this->data['paginator']); ?>
<section class="pagination" >
    <!-- Previous page link -->
    <?php if (isset($this->previous)): ?>
        <a href="<?= $this->url(['page' => $this->previous]); ?>"><!-- &lt; --> &nbsp;Previous&nbsp;</a> <!-- | -->      
    <?php endif; ?>
    <!-- Numbered page links -->
    <?php foreach ($this->pagesInRange as $page): ?>
        <?php if ($page != $this->current): ?>
            <a href="<?= $this->url(['page' => $page]); ?>">&nbsp;<?= $page; ?>&nbsp;</a>
        <?php else: ?>
            <a class= 'active' href="javascript:void(0)">&nbsp;<?= $page; ?>&nbsp;</a> 
        <?php endif; ?>
    <?php endforeach; ?>
    <!-- Next page link -->
    <?php if (isset($this->next)): ?>
        <!-- | --> <a href="<?= $this->url(['page' => $this->next]); ?>">&nbsp;Next&nbsp;<!-- &gt; --></a> <!-- | -->        
    <?php endif; ?>
    <!-- Last page link -->
</section>
