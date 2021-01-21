<?php
/**
 * @file
 * Contains Help & Troubleshooting for miniOrange OTP Verification Module.
 */

/**
 * Showing Help & Troubleshooting.
 */
function miniorange_otp_help_troubleshoot($form, &$form_state) {

  global $base_url;
  $config_url = $base_url . '/admin/config/people/accounts';

  drupal_add_js(drupal_get_path('module', 'miniorange_otp') . '/js/trans.js', 'file');

  $form['header_top_style_2'] = array(
      '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_otp_container">'
  );

  $form['markup_2'] = array(
    '#markup' => '<h3><a id = "link_question1" >How does this module work?</a></h3>'
    . '<div id="question1" style="display:none;" ><ol><li>On submitting the registration form an Email/SMS with OTP is sent to the email address/mobile number provided by the user.</li>'
    . '<li>Once the OTP is entered, it is verified by our servers.</li></ol></div><hr><br>',
  );

  $form['markup_3'] = array(
    '#markup' => '<h3><a id = "link_question2" >How is this module better than other modules available?</a></h3>'
    . '<div id="question2" style="display:none;" ><ol><li>Verification of users Email Address/Mobile Number during registration is a must these days. But what if you do not have your own SMTP/SMS gateway? With our module it is not necessary to have your own SMTP/SMS gateway. You can use our own gateways to send OTP over Email/SMS and you can even use your own SMS/SMTP Gateway if you choose to do so.</li>'
    . '<li>Easy and hassle free setup. No SMTP/SMS gateway configuration required. You just need to choose your registration form and you are good to go.</li>'
    . '<li>Customizable Email/SMS Templates.</li></ol></div><hr><br>',
  );

  $form['markup_5'] = array(
    '#markup' => '<h3><a id = "link_question3" >How do I integrate the module with my own custom Registration Form?</a></h3>'
    . '<div id="question3" style="display:none;" ><ol>Please contact us using the support form on your right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.<br>'
    . 'While contacting us please include enough information about your registration form and how you intend to use this module. We will respond promptly.</ol></div>'
    . '<hr><br>',
  );

  $form['markup_6'] = array(
    '#markup' => '<h3><a id = "link_question4" >How to enable PHP cURL extension? (Pre-requisite)</a></h3>'
    . '<div id="question4" style="display:none;" ><ol>cURL is enabled by default but in case you have disabled it, follow the steps to enable it<br><br>'
    . '<li>Open php.ini(it is usually in /etc/ or in php folder on the server).</li>'
    . '<li>Search for extension=php_curl.dll. Uncomment it by removing the semi-colon( ; ) in front of it.</li>'
    . '<li>Restart the Apache Server.</li><br>'
    . 'For any further queries, please submit a query using the support form on your right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.</ol></div><hr><br>',
  );


  $form['markup_9'] = array(
    '#markup' => '<h3><a id = "link_question5" >I am not able to set a password on creating a new account. What should I do?<br></a></h3>'
    . ' <div id="question5" style="display:none;" ><ol>Unselect the <b>"Require e-mail verification when a visitor creates an account"</b> from the Drupal Configuration Menu -> Account Settings -> Registration and cancellation or <a target="_blank" href="' . $config_url . '">here</a>. '
    . '</ol></div><hr><br>',
  );

  $form['markup_10'] = array(
    '#markup' => '<h3><a id = "link_question6" >I did not receive OTP. What should I do?</a></h3>'
    . '<div id="question6" style="display:none;" ><ol>The OTP is sent as an email to your email address with which you have registered. If you cannot see the email from miniOrange in your mails, please make sure to check your SPAM folder.<br> <br>'
    . 'Use the Resend OTP option to get an additional OTP or try to verify your account using your mobile number. If none of the above works, please contact us using the Support form on the right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.</ol></div>'
    . '<hr><br>',
  );

  $form['markup_11'] = array(
    '#markup' => '<h3><a id = "link_question7" >After entering OTP, I get Invalid OTP. What should I do?</a></h3>'
    . '<div id="question7" style="display:none;" ><ol>Use the Resend OTP option to get an additional OTP and try again.<br> <br>'
    . 'If this problem occurs even after entering correct OTP, please contact us using the Support form on the right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.</ol></div>'
    . '<hr><br>',
  );

  $form['markup_12'] = array(
    '#markup' => '<h3><a id = "link_question8" >I forgot the password of my miniOrange account. How can I reset it?</a></h3>'
    . '<div id="question8" style="display:none;" ><ol>You can go <a target="_blank" href="https://login.xecurify.com/moas/login">here</a> and then click on <b>Forgot Password</b> to reset your password. If any problem occurs while reseting your password, please contact us using the Support form on the right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.</ol></div><hr><br>',
  );

  $form['last_markup'] = array(
    '#markup' => '<div style="color:#34495e;"><h4><i>Note: If your query is not listed above then you can contact us using the Support form on the right or email us at <b><a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></b>.</i></h4></div></div>'
  );

  MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);
  MiniorangeOtpUtilities::Two_FA_Advertisement($form, $form_state);

  return $form;
}