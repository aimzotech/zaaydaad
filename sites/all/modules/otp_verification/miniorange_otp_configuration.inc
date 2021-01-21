<?php
/**
 * @file
 * Contains Configuration for miniOrange OTP Verification Module.
 */

require_once 'miniorange_otp_licensing_plan.inc';
/**
 * Showing Configuration form.
 */
function miniorange_otp_configuration($form, &$form_state)
{
  global $base_url, $_miniorange_otp_msg;
  $register_url = $base_url . '/admin/config/people/miniorange_otp/';

  drupal_add_js(drupal_get_path('module', 'miniorange_otp') . '/js/trans.js', 'file');

  $disabled = FALSE;

  if (!MiniorangeOtpUtilities::isCustomerRegistered()) {
    $disabled = TRUE;
    $form['header'] = array(
      '#markup' => '<div class="mo_otp_configure_message">You need to <a href="' . $register_url . '" >Register/Login</a> using miniOrange account before using this module.</div>'
    );
  }

  //miniorange_otp_handle_mo_check_ln($_miniorange_otp_msg);
  $admin_email = variable_get('miniorange_otp_customer_admin_email', NULL);
  $smstemp = 'https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/admin/customer/showsmstemplate';
  $smsconfig = 'https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/admin/customer/smsconfig';
  $emailtemp = 'https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/admin/customer/emailtemplateconfiguration';
  $emailconfig = 'https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/admin/customer/configureSMTP';
  $otp_length_config = 'https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/admin/customer/customerpreferences';

  $var = variable_get('mo_customer_check_ln');

  $url = $base_url . '/admin/config/people/miniorange_otp/licensing_plan';


  $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">',
  );

  $form['header_top_style_2'] = array('#markup' => '<div class="mo_saml_table_layout mo_otp_container">');

  $form['markup_1'] = array(
    '#markup' => '<h3>SMS & EMAIL CONFIGURATION</h3><hr><hr><br/>',
  );

  $form['markup_headLine'] = array(
    '#markup' => '<div class="mo_saml_highlight_background_note"><b>Look at the sections below to customize the Email and SMS that you receive:</b></div><br>'
  );

  $form['markup_2_0'] = array(
    '#markup' => '1. &nbsp <a id="image1_link">Custom SMS Template</a> : Change the text of the message that you receive on your phones.<br>',
  );

  $image1_options = array(
    'path' => $base_url . '/' . drupal_get_path('module', 'miniorange_otp') . '/includes/images/smsTemplate.jpg',
    'alt' => 'Custom SMS Template',
  );
  $image1 = theme('image', $image1_options);
  $form['image1']['image'] = array(

    '#markup' => '<div id="image1_toggle" style="display:none;"></br>' . $image1 . '</br>'
      . '<a class="mo_otp_btn mo_otp_btn-primary btn-large" target="_blank" style="padding:5px;" href="' . $smstemp . '">Change SMS Template</a></h4></br></br><hr></br></div>',
  );


  $form['markup_2_2'] = array(
    '#markup' => '2. &nbsp <a id="image3_link">Custom Email Template</a> : Change the text of the email that you receive.<br>',
  );

  $image3_options = array(
    'path' => $base_url . '/' . drupal_get_path('module', 'miniorange_otp') . '/includes/images/emailTemplate.jpg',
    'alt' => 'Custom Email Template',
  );
  $image3 = theme('image', $image3_options);
  $form['image3']['image'] = array(
    '#markup' => '<div id="image3_toggle" style="display:none;"></br>' . $image3 . '</br>'
      . '<a class="mo_otp_btn mo_otp_btn-primary btn-large" target="_blank" style="padding:5px;" href="' . $emailtemp . '">Change Email Template</a></h4></br></br><hr></br></div>',
  );

  $form['markup_3'] = array(
    '#markup' => '</br><div class="mo_saml_highlight_background_note"><b> How can I change the SenderID/Number of the SMS I receive?</b></div>'
      . '<div id="q1" class="" >SenderID/Number is gateway specific. You will need to use your own SMS gateway for this.</div><br>',
  );

  $form['markup_4'] = array(
    '#markup' => '<div class="mo_saml_highlight_background_note"><b>How can I change the Sender Email of the Email I receive?</b><br></div>'
      . '<div id="q2" class="" >Sender Email is gateway specific. You will need to use your own Email gateway for this.</div><br>',
  );

  $form['otp_length'] = array(
    '#markup' => '<br><h3>OTP PREFERENCES</h3><hr><hr><br/>',
  );

  $form['markup_headLine1'] = array(
    '#markup' => '<div class="mo_saml_highlight_background_note"><b>Look at the sections below to customize the OTP that you receive:</b></div><br>'
  );

  $form['otp_length_custom1'] = array(
    '#markup' => '1. &nbsp <a href="' . $otp_length_config . '" target="_blank">Custom OTP length</a> : You can configure settings to use custom OTP length.<br>',
  );

  $form['otp_length_custom2'] = array(
    '#markup' => '2. &nbsp <a href="' . $otp_length_config . '" target="_blank">Custom OTP Validity</a> (in mins) : You can configure settings to use custom OTP Validity (in mins).<br><br>',
  );

  $form['redirect_url'] = array(
    '#markup' => '<br><h3>REDIRECT URL</h3><hr><hr><br/>',
  );

  $form['otp_logout_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Default Logout URL'),
    '#default_value' => variable_get('otp_logout_url', ''),
    '#attributes' => array('placeholder' => 'Enter Default Logout URL'),
    '#disabled' => $disabled,
  );


  $form['otp_login_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Default Login URL'),
    '#default_value' => variable_get('otp_login_url', ''),
    '#attributes' => array('placeholder' => 'Enter Default Login URL'),
    '#disabled' => $disabled,
  );

  $form['miniorange_otp_config_save_button'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#submit' => array('miniorange_otp_config_save'),
    '#disabled' => $disabled,
  );


  $form['markup_idp_attr_header_top_div_close'] = array('#markup' => '</div>',
  );

  MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);
  MiniorangeOtpUtilities::Two_FA_Advertisement($form, $form_state);

  return $form;
}

function miniorange_otp_config_save($form, &$form_state)
{
  $logout_url = $form['otp_logout_url']['#value'];
  $login_url = $form['otp_login_url']['#value'];
  
  variable_set('otp_logout_url', $logout_url);
  variable_set('otp_login_url', $login_url);

  $message = 'Settings saved successfully.';
  drupal_set_message(t($message));
}