<?php
echo $this->element('top');
if($item) echo $html->div(null,$item[$_m[0]]['descripcion'],array('id'=>'aboutText'));
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>