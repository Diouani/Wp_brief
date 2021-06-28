<?php
extract(shortcode_atts(array(
	'image' => LANDX_URI.'/images/loading.gif',
), $atts));
?>
<div class="preloader">
  <div class="status" style="background-image: url(<?php echo esc_url($image) ?>);">&nbsp;</div>
</div>