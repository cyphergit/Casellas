<?php
list($width, $height) = getimagesize($source);

$vWidth = $width.'px';
$vHeight = $height.'px';

if ($height > $width) {
  $height = $height / 3;
  $h = $height;
}

?>
<style type="text/css">
  .preview-background {
    padding: 10px;
  }
  
  .vBg {
    width: <?php echo $vWidth?>;
    height: <?php echo $vHeight?>;    
    background-image: url('<?php echo $source;?>');
    background-repeat: no-repeat;
    background-position: center;
  }
  
  .vContent {
    padding: 20px;
  }
  
  .vContent div 
  {
    height: <?php echo $section-size;?>;
    border: solid 1px red;
  }
</style>
<div class="preview-background">
  <div class="vBg">
    <div class="vContent">
      <div></div>
      <div>
        <?php 
          echo $vContent;   
          
          echo $h;
        ?>  
      </div>
      <div></div>
      
    </div>
  </div>
</div>
