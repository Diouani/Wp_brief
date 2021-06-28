<script type="text/javascript">
jQuery.ajaxChimp.translations.custom_<?php echo get_the_ID(); ?> = {
    'submit': 'Grabación en curso...',
    0: '<?php echo get_post_meta( get_the_ID(), 'resp_0', true );?>',
    1: '<?php echo get_post_meta( get_the_ID(), 'resp_1', true );?>',
    2: '<?php echo get_post_meta( get_the_ID(), 'resp_2', true );?>',
    3: '<?php echo get_post_meta( get_the_ID(), 'resp_3', true );?>',
    4: '<?php echo get_post_meta( get_the_ID(), 'resp_4', true );?>',
    5: '<?php echo get_post_meta( get_the_ID(), 'resp_5', true );?>',
}
</script>
<?php
$form_display = get_post_meta( get_the_ID(), 'form_display', true );
$form_select_option = get_post_meta( get_the_ID(), 'form_select_option', true );
$contact_form_shortcode = get_post_meta( get_the_ID(), 'contact_form_shortcode', true );
$mailchimp_post_url = get_post_meta( get_the_ID(), 'mailchimp_post_url', true );
$language = get_post_meta( get_the_ID(), 'language', true );

$data_post_url = ($mailchimp_post_url != '')? esc_url($mailchimp_post_url) : esc_url(ot_get_option('mailchimp_post_url'));
$language = ($language != '')? $language : 'en';
$language = ($language == 'custom')? 'custom_'.get_the_ID() : $language;

if($form_display == 'on' && $form_select_option == 'contactform' && $contact_form_shortcode != ''):
echo do_shortcode($contact_form_shortcode);
else:
	if($form_display == 'on'):
	$form_title = get_post_meta( get_the_ID(), 'form_title', true );
	$form_title = ( $form_title != '' )? '<h3>'.esc_attr($form_title).'</h3>' : '';
	$form_type = get_post_meta( get_the_ID(), 'form_type', true );	
	$name_placeholder = get_post_meta( get_the_ID(), 'name_placeholder', true );
	$input_1 = get_post_meta( get_the_ID(), 'input_1', true );
	$email_placeholder = get_post_meta( get_the_ID(), 'email_placeholder', true );
	$input_2 = get_post_meta( get_the_ID(), 'input_2', true );
	$phone_placeholder = get_post_meta( get_the_ID(), 'phone_placeholder', true );
	$input_3 = get_post_meta( get_the_ID(), 'input_3', true );
	$form_submit_button_text = get_post_meta( get_the_ID(), 'form_submit_button_text', true );
	if( $form_type == 'vertical' ):
	?>
	<div class="vertical-registration-form">
		<div class="colored-line">
		</div>
		<?php echo $form_title; ?>
		<form class="registration-form mailchimp" id="register" role="form" data-posturl="<?php echo $data_post_url; ?>" data-language="<?php echo $language; ?>" >
			<!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
			<h6 class="subscription-success"></h6>
			<h6 class="subscription-error"></h6>
			
			<input class="form-control input-box" id="mce-<?php echo ($input_1 != '')? esc_attr($input_1) : 'name' ?>" type="text" name="<?php echo ($input_1 != '')? esc_attr($input_1) : 'name' ?>" placeholder="<?php echo esc_attr($name_placeholder); ?>">
			<input class="form-control input-box" id="mce-<?php echo ($input_2 != '')? esc_attr($input_2) : 'email' ?>" type="email" name="<?php echo ($input_2 != '')? esc_attr($input_2) : 'email' ?>" placeholder="<?php echo esc_attr($email_placeholder); ?>">
			<input class="form-control input-box" id="mce-<?php echo ($input_3 != '')? esc_attr($input_3) : 'phone-number' ?>" type="text" name="<?php echo ($input_3 != '')? esc_attr($input_3) : 'phone-number' ?>" placeholder="<?php echo esc_attr($phone_placeholder); ?>">
			<button class="btn standard-button" type="submit" id="submit" name="submit"><?php echo esc_attr($form_submit_button_text); ?></button>
		</form>
	</div>
<?php else: ?>
	<div class="sf-container">
		<form class="subscription-form mailchimp form-inline" role="form" data-posturl="<?php echo $data_post_url; ?>" data-language="<?php echo $language; ?>">
			<?php echo $form_title; ?>
			<!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
			<h6 class="subscription-success"></h6>
			<h6 class="subscription-error"></h6>
			
			<!-- EMAIL INPUT BOX -->
			<input type="email" name="<?php echo ($input_2 != '')? esc_attr($input_2) : 'email' ?>" id="subscriber-email1" placeholder="<?php echo esc_attr($email_placeholder); ?>" class="form-control input-box">
			
			<!-- SUBSCRIBE BUTTON -->
			<button type="submit" id="subscribe-button1" class="btn standard-button"><?php echo esc_attr($form_submit_button_text); ?></button>
			
		</form>
	</div>
    <?php endif; ?>
<?php endif; ?>
<?php endif; ?>


