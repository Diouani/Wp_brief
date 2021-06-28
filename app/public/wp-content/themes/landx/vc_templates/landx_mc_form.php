<?php
extract(shortcode_atts(array(
	'style' => 'vertical',
	'language' => 'en',
    'post_url'  => '//themeperch.us9.list-manage.com/subscribe/post?u=d33802e92fdc29def2e7af643&id=0085e5e2b5',
    'title'  => 'Try Premium Account',
    'fields'  => '',
    'button_text' => 'Get started'
), $atts));
$fieldsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($fields) : array();
?>

<?php if( $style == 'vertical' ): ?>
	<form class="mailchimp" role="form" data-posturl="<?php echo esc_url($post_url) ?>" novalidate="true" data-language="<?php echo esc_attr($language); ?>">
		<div class="vertical-registration-form mc-form-wrap">
			<div class="colored-line"></div>
			<?php echo ($title != '')? '<h3>'.esc_attr($title).'</h3>' : ''; ?>
			<?php  
				if( !empty($fieldsArr) ):
					$optionsArr = array();
					foreach ($fieldsArr as $key => $value) {
						switch ($value['type']) {
							case 'select':
								if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
					        	echo '<select name="'.esc_attr($value['name']).'">';
					        	echo ($value['placeholder'] != '')? '<option value="">'.esc_attr($value['placeholder']).'</option>' : '';
					        	if( !empty($optionsArr) ){
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<option value="'.(isset($optionArr[0])? $optionArr[0] : '').'">'.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).'</option>';
					        		}
					        	}
					        	echo '</select>';
					        break;
					        case 'radio':
					        	echo '<p class="form-field text-left">';
					        	if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
								if( !empty($optionsArr) ){
									echo ($value['placeholder'] != '')? '<label>'.esc_attr($value['placeholder']).'</label><br>' : '';
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<input name="'.esc_attr($value['name']).'" type="radio" value="'.(isset($optionArr[0])? $optionArr[0] : '').'"> '.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).' ';
					        		}
					        	}
					        	echo '</p>';
					        break;
					        case 'checkbox':
					        	echo '<p class="form-field text-left">';
					        	if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
								if( !empty($optionsArr) ){
									echo ($value['placeholder'] != '')? '<label>'.esc_attr($value['placeholder']).'</label><br>' : '';
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<input name="'.esc_attr($value['name']).'" type="checkbox" value="'.(isset($optionArr[0])? $optionArr[0] : '').'"> '.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).' ';
					        		}
					        	}
					        	echo '</p>';
					        break;
					        case 'email':
					        	echo '<input name="'.esc_attr($value['name']).'" class="form-control input-box" placeholder="'.esc_attr($value['placeholder']).'" type="email">';
					        break;
					        case 'date':
					        	echo '<input name="'.esc_attr($value['name']).'" class="form-control input-box datefield" placeholder="'.esc_attr($value['placeholder']).'" type="text" data-format="'.esc_attr($value['format']).'">';
					        	wp_enqueue_style('jquery-ui-datepicker-style');
					        break;
					        default:
					        	echo '<input name="'.esc_attr($value['name']).'" class="form-control input-box" placeholder="'.esc_attr($value['placeholder']).'" type="text">';
						}
					}
				endif;
			?>	
			<h6 class="subscription-success"></h6>
			<h6 class="subscription-error"></h6>
		  <input value="<?php echo esc_attr($button_text); ?>" class="btn standard-button" type="submit">
		</div>
	</form>
<?php else: ?>
	<div class="sf-container vc-horizontal-mc">
		<form class="subscription-form mailchimp form-inline" role="form" data-posturl="<?php echo esc_url($post_url) ?>" novalidate="true" data-language="<?php echo esc_attr($language); ?>">
			
			<?php echo ($title != '')? '<h3>'.esc_attr($title).'</h3>' : ''; ?>
			<h6 class="subscription-success"></h6>
			<h6 class="subscription-error"></h6>
			<?php  
				if( !empty($fieldsArr) ):
					$optionsArr = array();
					foreach ($fieldsArr as $key => $value) {
						switch ($value['type']) {
							case 'select':
								if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
					        	echo '<select name="'.esc_attr($value['name']).'">';
					        	echo ($value['placeholder'] != '')? '<option value="">'.esc_attr($value['placeholder']).'</option>' : '';
					        	if( !empty($optionsArr) ){
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<option value="'.(isset($optionArr[0])? $optionArr[0] : '').'">'.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).'</option>';
					        		}
					        	}
					        	echo '</select>';
					        break;
					        case 'radio':
					        	echo '<p class="form-field text-left">';
					        	if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
								if( !empty($optionsArr) ){
									echo ($value['placeholder'] != '')? '<label>'.esc_attr($value['placeholder']).'</label><br>' : '';
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<input name="'.esc_attr($value['name']).'" type="radio" value="'.(isset($optionArr[0])? $optionArr[0] : '').'"> '.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).' ';
					        		}
					        	}
					        	echo '</p>';
					        break;
					        case 'checkbox':
					        	echo '<p class="form-field text-left">';
					        	if( $value['options'] != '' ){
									$optionsArr = explode('|', $value['options']);
								}
								if( !empty($optionsArr) ){
									echo ($value['placeholder'] != '')? '<label>'.esc_attr($value['placeholder']).'</label><br>' : '';
					        		foreach ($optionsArr as $option) {
					        			$optionArr = explode(',', $option);
					        			echo '<input name="'.esc_attr($value['name']).'" type="checkbox" value="'.(isset($optionArr[0])? $optionArr[0] : '').'"> '.(isset($optionArr[1])? $optionArr[1] : $optionArr[0]).' ';
					        		}
					        	}
					        	echo '</p>';
					        break;
					        case 'email':
					        	echo '<input name="'.esc_attr($value['name']).'" class="form-control input-box" placeholder="'.esc_attr($value['placeholder']).'" type="email">';
					        break;
					        default:
					        	echo '<input name="'.esc_attr($value['name']).'" class="form-control input-box" placeholder="'.esc_attr($value['placeholder']).'" type="text">';
						}
					}
				endif;
			?>				
		  <input value="<?php echo esc_attr($button_text); ?>" class="btn standard-button" type="submit">		
	</form>
	</div>
<?php endif; ?>
