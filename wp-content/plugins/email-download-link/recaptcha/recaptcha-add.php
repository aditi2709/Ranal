<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
$ed_email_download_link_ver = get_option('email-download-link');
if ( $ed_email_download_link_ver != "2.4" ) {
?><div class="error fade">
		<p>
		Note: You have recently upgraded the plugin and your tables are not sync.
		Please <a title="Sync plugin tables." href="<?php echo ED_ADMINURL; ?>?page=ed-settings&amp;ac=sync"><?php echo __( 'Click Here', 'email-download-link' ); ?></a> to sync the table.
		This is mandatory and it will not affect your data.
		</p>
	</div><?php
}
?>
<div class="wrap">
<?php
$ed_errors = array();
$ed_success = '';
$ed_error_found = false;

// Form submitted, check the data
if (isset($_POST['ed_form_submit']) && $_POST['ed_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('ed_form_add');
	
	$ed_captcha_widget 		= isset($_POST['ed_captcha_widget']) ? wp_filter_post_kses($_POST['ed_captcha_widget']) : '';
	$ed_captcha_sitekey 	= isset($_POST['ed_captcha_sitekey']) ? wp_filter_post_kses($_POST['ed_captcha_sitekey']) : '';
	$ed_captcha_secret 		= isset($_POST['ed_captcha_secret']) ? wp_filter_post_kses($_POST['ed_captcha_secret']) : '';

	//	No errors found, we can add this Group to the table
	if ($ed_error_found == FALSE)
	{
		update_option('ed_captcha_widget', $ed_captcha_widget );
		update_option('ed_captcha_sitekey', $ed_captcha_sitekey );
		update_option('ed_captcha_secret', $ed_captcha_secret );
		$ed_success = __('Captcha details successfully updated.', 'email-download-link');
	}
}

$ed_captcha_widget = get_option('ed_captcha_widget', '');
if($ed_captcha_widget == "")
{
	add_option('ed_captcha_widget', "NO");
}

$ed_captcha_sitekey = get_option('ed_captcha_sitekey', '');
if($ed_captcha_sitekey == "")
{
	add_option('ed_captcha_sitekey', "NA");
	$ed_captcha_sitekey = get_option('ed_captcha_sitekey');
}

$ed_captcha_secret = get_option('ed_captcha_secret', '');
if($ed_captcha_secret == "")
{
	add_option('ed_captcha_secret', "NA");
	$ed_captcha_secret = get_option('ed_captcha_secret');
}

if ($ed_captcha_sitekey == "NA")
{
	$ed_captcha_sitekey = "";
}

if ($ed_captcha_secret == "NA")
{
	$ed_captcha_secret = "";
}


if ($ed_error_found == TRUE && isset($ed_errors[0]) == TRUE)
{
	?><div class="error fade"><p><strong><?php echo $ed_errors[0]; ?></strong></p></div><?php
}
if ($ed_error_found == FALSE && strlen($ed_success) > 0)
{
	?>
	<div class="updated fade">
		<p><strong><?php echo $ed_success; ?></strong></p>
	</div>
	<?php
}
?>
<div class="form-wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h2><?php _e(ED_PLUGIN_DISPLAY, 'email-download-link'); ?></h2>
	<h3><?php _e('Google reCaptcha Setup', 'email-download-link'); ?></h3>
	<form name="ed_form" method="post" action="#" onsubmit="return _ed_submit()"  >
      
	  <label for="tag-link"><?php _e('reCaptcha option', 'email-download-link'); ?></label>
      <select name="ed_captcha_widget" id="ed_captcha_widget">
		<option value='NO' <?php if($ed_captcha_widget == 'NO') { echo 'selected="selected"' ; } ?>>NO (Do not display captcha)</option>
		<option value='YES' <?php if($ed_captcha_widget == 'YES') { echo 'selected="selected"' ; } ?>>YES (Display captcha)</option>
      </select>
      <p><?php _e('Add reCaptcha in the download link form.', 'email-download-link'); ?></p>

	  <label for="tag-link"><?php _e('reCaptcha Secret key', 'email-download-link'); ?></label>
      <input name="ed_captcha_secret" type="text" id="ed_captcha_secret" value="<?php echo $ed_captcha_secret; ?>" maxlength="225" size="75"  />
      <p><?php _e('Please enter your secret key for reCaptcha.', 'email-download-link'); ?></p>
	  
      <label for="tag-link"><?php _e('reCaptcha Site key', 'email-download-link'); ?></label>
      <input name="ed_captcha_sitekey" type="text" id="ed_captcha_sitekey" value="<?php echo $ed_captcha_sitekey; ?>" maxlength="225" size="75"  />
      <p><?php _e('Please enter your site key for reCaptcha.', 'email-download-link'); ?></p>
	  
      <input type="hidden" name="ed_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Submit', 'email-download-link'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button add-new-h2" onclick="_ed_redirect()" value="<?php _e('Cancel', 'email-download-link'); ?>" type="button" />
        <input name="Help" lang="publish" class="button add-new-h2" onclick="_ed_help()" value="<?php _e('Help', 'email-download-link'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('ed_form_add'); ?>
    </form>
	<p class="description"><?php echo ED_OFFICIAL; ?></p>
</div>
</div>