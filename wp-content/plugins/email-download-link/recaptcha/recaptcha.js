function _ed_submit() {
	
	if( document.ed_form.ed_captcha_widget.value=="YES" && document.ed_form.ed_captcha_sitekey.value=="" )
	{
		alert(ed_recaptcha_script.ed_recaptcha_sitekey_add);
		document.ed_form.ed_captcha_sitekey.focus();
		return false;
	}
	else if( document.ed_form.ed_captcha_widget.value=="YES" && document.ed_form.ed_captcha_sitekey.value.length<20 )
	{
		alert(ed_recaptcha_script.ed_recaptcha_sitekey_add);
		document.ed_form.ed_captcha_sitekey.focus();
		return false;
	}
	else if( document.ed_form.ed_captcha_widget.value=="YES" && document.ed_form.ed_captcha_secret.value=="" )
	{
		alert(ed_recaptcha_script.ed_recaptcha_secretkey_add);
		document.ed_form.ed_captcha_secret.focus();
		return false;
	}
	else if( document.ed_form.ed_captcha_widget.value=="YES" && document.ed_form.ed_captcha_secret.value.length<20 )
	{
		alert(ed_recaptcha_script.ed_recaptcha_secretkey_add);
		document.ed_form.ed_captcha_secret.focus();
		return false;
	}
}

function _ed_redirect() {
	window.location = "admin.php?page=ed-recaptcha";
}

function _ed_help() {
	window.open("http://www.gopiplus.com/work/2016/03/01/email-download-link-wordpress-plugin/");
}