<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
class ed_cls_sendemail
{
	public static function ed_sendemail_prepare($ed_email_id = 0, $ed_email_name_use, $ed_email_mail_use)
	{
		$subscribers = array();
		$subscribers = ed_cls_subscribers::ed_subscribers_view_page(0, 1, $ed_email_id, "", "");
		$replacefrom = array("<ul><br />", "</ul><br />", "<li><br />", "</li><br />", "<ol><br />", "</ol><br />", "</h2><br />", "</h1><br />");
		$replaceto = array("<ul>", "</ul>", "<li>" ,"</li>", "<ol>", "</ol>", "</h2>", "</h1>");
		
		if(count($subscribers) > 0)
		{
			$ed_email_guid 			= $subscribers[0]['ed_email_guid'];
			$ed_email_downloadid 	= $subscribers[0]['ed_email_downloadid'];
			$ed_email_name 			= $subscribers[0]['ed_email_name'];
			$ed_email_mail 			= $subscribers[0]['ed_email_mail'];
			$ed_form_title			= "";
			
			if($ed_email_name == "")
			{
				$ed_email_name 		= $ed_email_mail;
			}
			
			$home_url 	= home_url('/');
			$downloadurl_direct = $home_url . "?ed=download&guid=".$ed_email_downloadid."--".$ed_email_guid;
			
			if($ed_email_downloadid <> "")
			{
				$downloads = array();
				$downloads = ed_cls_downloads::ed_downloads_downloadid($ed_email_downloadid);			
				$ed_form_title = $downloads['ed_form_title'];
			}
		}
		else
		{
			return false;
		}
		
		$settings = array();
		$settings = ed_cls_settings::ed_setting_select(1);
		//echo "<br>". $settings['ed_c_savenameemail'];
		$savenameemail = isset($settings['ed_c_savenameemail']) ? $settings['ed_c_savenameemail'] : 'YES';
		//echo "<br>". $savenameemail;
		if($savenameemail == "NO")
		{
			if($ed_email_name_use == "")
			{
				$ed_email_name 	= $ed_email_mail_use;
			}
			else
			{
				$ed_email_name 	= $ed_email_name_use;
			}
			$ed_email_mail = $ed_email_mail_use;
		}
		
		//echo "<br>". $ed_email_name;
		//echo "<br>". $ed_email_mail;

					
		$htmlmail = false;
		$wpmail = false;
		
		if( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "PHP HTML MAIL" )  
		{
			$htmlmail = true;
		}
		
		if( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "WP PLAINTEXT MAIL" )  
		{
			$wpmail = true;
		}
		
		if( trim($settings['ed_c_fromname']) == "" || trim($settings['ed_c_fromemail']) == '' )
		{
			get_currentuserinfo();
			$sender_name = $user_login;
			$sender_email = $user_email;
		}
		else
		{
			$sender_name = $settings['ed_c_fromname'];
			$sender_email = $settings['ed_c_fromemail'];
		}
		
		$headers  = "From: \"$sender_name\" <$sender_email>\n";
		$headers .= "Return-Path: <" . $sender_email . ">\n";
		$headers .= "Reply-To: \"" . $sender_name . "\" <" . $sender_email . ">\n";
		$headers .= "X-Mailer: PHP" . phpversion() . "\n";
		
		if($htmlmail)
		{
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
			$headers .= "Content-type: text/html\r\n"; 
		}
		else
		{
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";
		}
		
		$subject = stripslashes($settings['ed_c_usermailsubject']);
		$content = stripslashes($settings['ed_c_usermailcontant']);
		
		if ( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "PHP HTML MAIL" )
		{
			$content = nl2br($content);
			$content = str_replace($replacefrom, $replaceto, $content);
		}
		else
		{
			$content = str_replace("<br />", "\r\n", $content);
			$content = str_replace("<br>", "\r\n", $content);
		}
		
		$subject = str_replace("###NAME###", $ed_email_name, $subject);
		$subject = str_replace("###EMAIL###", $ed_email_mail, $subject);
		$subject = str_replace("###TITLE###", $ed_form_title, $subject);
		
		$content = str_replace("###NAME###", $ed_email_name, $content);
		$content = str_replace("###EMAIL###", $ed_email_mail, $content);
		$content = str_replace("###DOWNLOADLINK###", $downloadurl_direct, $content);
		$content = str_replace("###DOWNLOADLINKDIRECT###", $downloadurl_direct, $content);
		$content = str_replace("###TITLE###", $ed_form_title, $content);
		
		if($wpmail) 
		{
			wp_mail($ed_email_mail, $subject, $content, $headers);
		}
		else
		{
			mail($ed_email_mail ,$subject, $content, $headers);
		}
		
		// Mail to admin
		if($settings['ed_c_adminmailoption'] == "YES")
		{
			$ed_c_adminemail = $settings['ed_c_adminemail'];
			$ed_c_adminmailsubject = $settings['ed_c_adminmailsubject'];
			$ed_c_adminmailcontant = $settings['ed_c_adminmailcontant'];
			
			$ed_c_adminmailsubject = str_replace("###NAME###", $ed_email_name, $ed_c_adminmailsubject);
			$ed_c_adminmailsubject = str_replace("###EMAIL###", $ed_email_mail, $ed_c_adminmailsubject);
			$ed_c_adminmailsubject = str_replace("###TITLE###", $ed_form_title, $ed_c_adminmailsubject);
			
			$ed_c_adminmailcontant = str_replace("###NAME###", $ed_email_name, $ed_c_adminmailcontant);
			$ed_c_adminmailcontant = str_replace("###EMAIL###", $ed_email_mail, $ed_c_adminmailcontant);
			$ed_c_adminmailcontant = str_replace("###DOWNLOADLINK###", $downloadurl_direct, $ed_c_adminmailcontant);
			$ed_c_adminmailcontant = str_replace("###DOWNLOADLINKDIRECT###", $downloadurl_direct, $ed_c_adminmailcontant);
			$ed_c_adminmailcontant = str_replace("###TITLE###", $ed_form_title, $ed_c_adminmailcontant);
			
			if ( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "PHP HTML MAIL" )
			{
				$ed_c_adminmailcontant = nl2br($ed_c_adminmailcontant);
				$ed_c_adminmailcontant = str_replace($replacefrom, $replaceto, $ed_c_adminmailcontant);
			}
			else
			{
				$ed_c_adminmailcontant = str_replace("<br />", "\r\n", $ed_c_adminmailcontant);
				$ed_c_adminmailcontant = str_replace("<br>", "\r\n", $ed_c_adminmailcontant);
			}
			
			if($wpmail) 
			{
				wp_mail($ed_c_adminemail, $ed_c_adminmailsubject, $ed_c_adminmailcontant, $headers);
			}
			else
			{
				mail($ed_c_adminemail ,$ed_c_adminmailsubject, $ed_c_adminmailcontant, $headers);
			}
		}
	}
	
	public static function ed_sendemail_admincron()
	{
		$settings = array();
		$settings = ed_cls_settings::ed_setting_select(1);
		$replacefrom = array("<ul><br />", "</ul><br />", "<li><br />", "</li><br />", "<ol><br />", "</ol><br />", "</h2><br />", "</h1><br />");
		$replaceto = array("<ul>", "</ul>", "<li>" ,"</li>", "<ol>", "</ol>", "</h2>", "</h1>");
		
		$htmlmail = false;
		$wpmail = false;
		
		if( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "PHP HTML MAIL" )  
		{
			$htmlmail = true;
		}
		
		if( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "WP PLAINTEXT MAIL" )  
		{
			$wpmail = true;
		}
		
		if( trim($settings['ed_c_fromname']) == "" || trim($settings['ed_c_fromemail']) == '' )
		{
			get_currentuserinfo();
			$sender_name = $user_login;
			$sender_email = $user_email;
		}
		else
		{
			$sender_name = $settings['ed_c_fromname'];
			$sender_email = $settings['ed_c_fromemail'];
		}
		
		$headers  = "From: \"$sender_name\" <$sender_email>\n";
		$headers .= "Return-Path: <" . $sender_email . ">\n";
		$headers .= "Reply-To: \"" . $sender_name . "\" <" . $sender_email . ">\n";
		$headers .= "X-Mailer: PHP" . phpversion() . "\n";
		
		if($htmlmail)
		{
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
			$headers .= "Content-type: text/html\r\n"; 
		}
		else
		{
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";
		}
		
		$blogname = get_option('blogname');
		$subject = $blogname . " : Download link refreshed";
		$content = stripslashes($settings['ed_c_cronmailcontent']);
		$ed_c_adminemail = $settings['ed_c_adminemail'];
		
		$currentdate = date('Y-m-d G:i:s'); 
		$content = str_replace("###DATE###", $currentdate, $content);
		
		
		if ( $settings['ed_c_mailtype'] == "WP HTML MAIL" || $settings['ed_c_mailtype'] == "PHP HTML MAIL" )
		{
			$content = nl2br($content);
			$content = str_replace($replacefrom, $replaceto, $content);
		}
		else
		{
			$content = str_replace("<br />", "\r\n", $content);
			$content = str_replace("<br>", "\r\n", $content);
		}
			
			
		if($wpmail) 
		{
			wp_mail($ed_c_adminemail, $subject, $content, $headers);
		}
		else
		{
			mail($ed_c_adminemail ,$subject, $content, $headers);
		}
	}
}

class ed_senddownload {

	public function __construct() {
	}
	
	public static function ed_process_download()
	{
		$response = array( 'status' => 'ERROR', 'message' => '' );
		
		//////////////////////////////Robot verification//////////////////////////////////////////////////
		$ed_captcha_widget = get_option('ed_captcha_widget', '');
		if($ed_captcha_widget == 'YES') {
			$ed_captcha_secret = get_option('ed_captcha_secret');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$ed_captcha_secret.'&response='.$_POST['ed_g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if(!$responseData->success) {
				$response['message'] = 'ed_invalid_captcha';
				ed_do_response( $response );
				exit;
			}
		}
		//////////////////////////////Robot verification//////////////////////////////////////////////////
					
		$ed_submit    	= ed_get_posted_data( 'ed_submit' ,'' , true);
		$ed_form_nonce 	= ed_get_posted_data( 'ed_form_nonce' ,'' , true );
		
		if ( $ed_submit === 'submitted' && ! empty( $ed_form_nonce ) ) {
			
			$form_data = ed_get_posted_data();
			$validate_response 	= ed_data_validation( $form_data );
			
			if ( $validate_response['status'] === 'ERROR' ) {
				ed_do_response( $validate_response );
				exit;
			}
	
			$ed_name  = ! empty( $form_data['ed_name'] ) ? sanitize_text_field( $form_data['ed_name'] ) : '';
			$ed_email = ! empty( $form_data['ed_email'] ) ? sanitize_email( $form_data['ed_email'] ) : '';
			$ed_group = ! empty( $form_data['ed_group'] ) ? sanitize_text_field( $form_data['ed_group'] ) : '';
			$ed_guid = ! empty( $form_data['ed_guid'] ) ? sanitize_text_field( $form_data['ed_guid'] ) : '';
			
			if($ed_guid == "group-option") {
				$ed_guid = ! empty( $form_data['ed_group'] ) ? sanitize_text_field( $form_data['ed_group'] ) : '';
			}
			
			$savenameemail = "YES";
			$plugin_settings = array();
			$plugin_settings = ed_cls_settings::ed_setting_select(1);
			if(count($plugin_settings) > 0) {
				$savenameemail = $plugin_settings['ed_c_savenameemail'];
			}
			
			if($savenameemail == "NO") {
				$sts = ed_cls_subscribers::ed_subscriber_create("NA", "NA", $ed_guid);
			}
			else {
				$sts = ed_cls_subscribers::ed_subscriber_create($ed_name, $ed_email, $ed_guid);
			}
			
			if($sts == "suss") {
				if($savenameemail == "NO") {
					$ed_email_id = ed_cls_subscribers::ed_subscriber_foremail("NA", $ed_guid);
				}
				else {
					$ed_email_id = ed_cls_subscribers::ed_subscriber_foremail($ed_email, $ed_guid);
				}
				
				if($ed_email_id > 0) {
					$ed_email_id = ed_cls_sendemail::ed_sendemail_prepare($ed_email_id, $ed_name, $ed_email);
				}
				
				$response['status'] = 'SUCCESS';
				$response['message'] = 'ed_sent_successfull';
			}
			else {
				$response['status'] = 'ERROR';
				$response['message'] = 'ed_unexpected_error';
			}
					
			
		}
		else {
			$response['message'] = 'ed_unexpected_error';
		}
		
		//$response['message_text'] = $ed_name . '-' . $ed_email . '-' . $ed_group . '-' . $ed_guid;
		ed_do_response( $response );
		exit;
	}
}

function ed_get_posted_data( $var = '', $default = '', $clean = true ) {
	return ed_posted_data( $_POST, $var, $default, $clean );
}

function ed_posted_data( $array = array(), $var = '', $default = '', $clean = false ) {
	if ( ! empty( $var ) ) {
		$value = isset( $array[ $var ] ) ? wp_unslash( $array[ $var ] ) : $default;
	} else {
		$value = wp_unslash( $array );
	}

	if ( $clean ) {
		$value = ed_posted_clean_data( $value );
	}
	return $value;
}

function ed_posted_clean_data( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'ed_posted_clean_data', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}

function ed_data_validation( $data ) {
	$ed_response = array( 'status' => 'ERROR', 'message' => '' );

	$ed_name = isset( $data['ed_name'] ) ? $data['ed_name'] : '';
	$ed_name_mand = isset( $data['ed_name_mand'] ) ? $data['ed_name_mand'] : '';
	if ( $ed_name_mand == 'YES' &&  strlen( $ed_name ) == 0) {
		$ed_response['message'] = 'ed_required_field';
		return $ed_response;
	}
	
	if ( strlen( $ed_name ) > 50 ) {
		$ed_response['message'] = 'ed_invalid_name';
		return $ed_response;
	}

	$ed_email = isset( $data['ed_email'] ) ? $data['ed_email'] : '';
	if ( ! filter_var( $ed_email, FILTER_VALIDATE_EMAIL ) ) {
		$ed_response['message'] = 'ed_invalid_email';
		return $ed_response;
	}
	
	$ed_guid = isset( $data['ed_guid'] ) ? $data['ed_guid'] : '';
	if ( strlen( $ed_guid ) > 0 ) {
		if($ed_guid == "group-option") {
			$ed_group = isset( $data['ed_group'] ) ? $data['ed_group'] : '';
			if ( $ed_group == '') {
				$ed_response['message'] = 'ed_select_downloads';
				return $ed_response;
			}
		}
		else {
			ed_cls_security::ed_check_guid($ed_guid);
		}
	}
	
	$ed_response['status'] = 'SUCCESS';

	return $ed_response;
}

function ed_do_response( $response ) {

	$message = isset( $response['message'] ) ? $response['message'] : '';
	$response['message_text'] = '';
	if ( ! empty( $message ) ) {
		if($message == 'ed_sent_successfull') {
			$data = array();
			$data = ed_cls_settings::ed_setting_select(1);
			$ed_c_successmessage = isset($data['ed_c_successmessage']) ? $data['ed_c_successmessage'] : '';
			if($ed_c_successmessage == '') {
				$response['message_text'] = ED_MSG_04;
			}
			else {
				$response['message_text'] = esc_html(stripslashes($ed_c_successmessage));
			}
		}
		else {
			$response['message_text'] = ed_get_messages( $message );
		}
	}

	echo json_encode( $response );
	exit;

}

function ed_get_messages($message) {
	$messages = array(
		'ed_required_field'    => __( ED_MSG_01, 'email-download-link' ),
		'ed_invalid_name'      => __( 'Name seems invalid.', 'email-download-link' ),
		'ed_invalid_email'     => __( ED_MSG_02, 'email-download-link' ),
		'ed_unexpected_error'  => __( 'Oops.. Unexpected error occurred.', 'email-download-link' ),
		'ed_sent_successfull'  => __( ED_MSG_04, 'email-download-link' ),
		'ed_select_downloads'  => __( ED_MSG_07, 'email-download-link' ),
		'ed_invalid_captcha'   => __( 'Robot verification failed, please try again.', 'email-download-link' )
	);

	$messages = apply_filters('ed_download_form_messages', $messages);
	if ( ! empty( $messages ) ) {
		return isset($messages[ $message ]) ? $messages[ $message ] : '';
	}
	
	return $messages;
}
?>