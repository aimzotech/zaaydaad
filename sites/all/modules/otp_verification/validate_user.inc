<?php
/**
 * @file
 * Contains Validation form for miniOrange OTP Verification Module.
 */

/**
 * Validate user function.
 */
function miniorange_otp_validate_user($form, &$form_state)
{

  global $user;
  $form_state['uid'] = $user->uid;
  $form = miniorange_otp_build_form($form, $form_state);
  return $form;
}

/**
 * Custom form build.
 */
function miniorange_otp_build_form($form, &$form_state, $success_form = TRUE)
{
  $submit_attributes = array();
  $form = miniorange_otp_build_form_content($form, $form_state, $success_form);
  $form['loader']['#markup'] = '</div><div class="mo_otp-modal-container mo_otp-modal-footer">';
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Validate'),
    '#attributes' => $submit_attributes,
    '#validate' => array('miniorange_otp_validation_user_validate'),
  );
  $form['actions']['resend'] = array(
    '#type' => 'submit',
    '#value' => t('Resend OTP'),
    '#attributes' => $submit_attributes,
    '#submit' => array('miniorange_otp_resend_otp'),
  );
  $form['actions']['cancel'] = array(
    '#markup' => l(t('Cancel'), 'user/register'),
    '#suffix' => '</div></div></div>',
  );
  return $form;
}

/**
 * Custom form content.
 */
function miniorange_otp_build_form_content($form, $form_state, $success_form = TRUE)
{
  return miniorange_otp_build_otp_validation_form($form, $form_state, $success_form);
}

/**
 * Custom form build with error message.
 */
function miniorange_otp_build_form_with_error_message(&$form_state)
{
  $form = array();
  $form = miniorange_otp_build_form($form, $form_state, FALSE);
  $form_state['complete form']['header']['#markup'] = $form['header']['#markup'];
  return $form;
}

/**
 * Custom validation form build.
 */
function miniorange_otp_build_otp_validation_form($form, &$form_state, $success_message = TRUE)
{
  $otp_options = variable_get('miniorange_otp_options');
  if ($otp_options === 'email') {
    $form['otp'] = array(
      '#name' => 'otp',
      '#type' => 'textfield',
      '#attributes' => array(
        'autofocus' => 'autofocus',
      ),
      '#title' => t('OTP<span class="mo_class_for_color_red">*</span>'),
      '#default_value' => '',
      '#size' => 60,
      '#description' => t('Please enter the OTP that has been sent to the registered Email ID.'),
      '#maxlength' => 15,
    );
    return $form;
  } else {
    $form['otp'] = array(
      '#name' => 'otp',
      '#type' => 'textfield',
      '#attributes' => array(
        'autofocus' => 'autofocus',
      ),
      '#title' => t('OTP'),
      '#default_value' => '',
      '#size' => 60,
      '#description' => t('Please enter the OTP that has been sent to the registered Phone.'),
      '#maxlength' => 15,
    );
    return $form;
  }
}

/**
 * Custom user validation.
 */
function miniorange_otp_validation_user_validate($form, &$form_state)
{
  $uname = $_SESSION['miniorange_otp']['register_values']['name'];
  $otp_options = variable_get('miniorange_otp_options');
  $mail = $_SESSION['miniorange_otp']['register_values']['mail'];
  $pwd = isset($_SESSION['miniorange_otp']['register_values']['pass']) ? $_SESSION['miniorange_otp']['register_values']['pass'] : '';
  $otp_token = trim($form_state['values']['otp']);

  if (empty($otp_token)) {
    drupal_set_message(t('The OTP field is required. Please try again.'), 'error');
    return;
  }

  $trans_id = $_SESSION['trans_id'];

  if (!MiniorangeOtpUtilities::isCurlInstalled()) {
    return json_encode(array(
      "status" => 'CURL_ERROR',
      "statusMessage" => '<a href="http://php.net/manual/en/curl.installation.php">PHP cURL extension</a> is not installed or disabled.',
    ));
  }

  $url = MiniorangeOtpConstants::$baseUrl . '/moas/api/auth/validate';
  $ch = curl_init($url);
  $customer_key = variable_get('miniorange_otp_customer_id', NULL);
  $api_key = variable_get('miniorange_otp_customer_api_key', NULL);
//  $current_time_in_millis = round(microtime(TRUE) * 1000);
  $current_time_in_millis = MiniorangeOtpCustomer::get_oauth_timestamp();
  $string_to_hash = $customer_key . $current_time_in_millis . $api_key;
  $hash_value = hash("sha512", $string_to_hash);
  $customer_key_header = "Customer-Key: " . $customer_key;
  $timestamp_header = "Timestamp: " . $current_time_in_millis;
  $authorization_header = "Authorization: " . $hash_value;
  if ($otp_options === 'phone') {
    $fields = array(
      'txId' => $trans_id,
      'token' => $otp_token,
      'customerKey' => $customer_key,
      'username' => $mail,
      'authType' => 'PHONE',
    );
  } else {
    $fields = array(
      'txId' => $trans_id,
      'token' => $otp_token,
      'customerKey' => $customer_key,
      'username' => $mail,
      'authType' => 'EMAIL',
    );
  }

  $field_string = json_encode($fields);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_ENCODING, "");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customer_key_header,
    $timestamp_header, $authorization_header,
  ));
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
  $content = curl_exec($ch);
  curl_close($ch);
  variable_set('miniorange_otp_token', '$otp_token');
  $otp_status = json_decode($content)->status;

  if ($otp_status == "SUCCESS") {

    $arr1 = $_SESSION['arr1'];
    $arr2 = $_SESSION['arr2'];
    unset($_SESSION['miniorange_otp']);
    user_register_submit($arr1, $arr2);
    !empty(variable_get('otp_login_url')) ? $login_url = variable_get('otp_login_url') : $login_url = '<front>';
    drupal_goto($login_url);

  } elseif ($otp_status == "FAILED") {
    drupal_set_message(t('OTP entered is incorrect'), 'error');
  }

}

/**
 * Resend otp.
 */
function miniorange_otp_resend_otp(&$form, $form_state)
{
  global $_miniorange_otp_x;
  $umail = $_SESSION['miniorange_otp']['register_values']['mail'];
  $otp_options = variable_get('miniorange_otp_options');
  variable_del('miniorange_otp_tx_id');

  if ($otp_options === 'email') {
    $emailcount = drupal_strlen($umail);
    $emailc1 = drupal_substr($umail, 0, 3);
    $emailc2 = drupal_substr($umail, $emailcount - 4, $emailcount);
    for ($i = 4; $i <= $emailcount - 4; $i++) {
      $_miniorange_otp_x = "X" . $_miniorange_otp_x;
    }
    $email_code = $emailc1 . $_miniorange_otp_x . $emailc2;
    if (!MiniorangeOtpUtilities::isCurlInstalled()) {
      return json_encode(array(
        "status" => 'CURL_ERROR',
        "statusMessage" => '<a href="http://php.net/manual/en/curl.installation.php">PHP cURL extension</a> is not installed or disabled.',
      ));
    }
    $url = MiniorangeOtpConstants::$baseUrl . '/moas/api/auth/challenge';
    $ch = curl_init($url);
    $api_key = variable_get('miniorange_otp_customer_api_key', NULL);
    $customer_key = variable_get('miniorange_otp_customer_id', NULL);

    // Current time in milliseconds since midnight, January 1, 1970 UTC.
//    $current_time_in_millis = round(microtime(TRUE) * 1000);
    $current_time_in_millis = MiniorangeOtpCustomer::get_oauth_timestamp();

    // Creating the Hash using SHA-512 algorithm.
    $string_to_hash = $customer_key . $current_time_in_millis . $api_key;
    $hash_value = hash("sha512", $string_to_hash);
    $customer_key_header = "Customer-Key: " . $customer_key;
    $timestamp_header = "Timestamp: " . $current_time_in_millis;
    $authorization_header = "Authorization: " . $hash_value;
    $fields = array(
      'customerKey' => $customer_key,
      'email' => $umail,
      'authType' => 'EMAIL',
      'transactionName' => 'Drupal OTP Verification',
    );

    $field_string = json_encode($fields);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      $customer_key_header,
      $timestamp_header,
      $authorization_header,
    ));

    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
    $content = curl_exec($ch);
    $trans_status = json_decode($content)->status;
    curl_close($ch);

    if ($trans_status == "SUCCESS") {
      $tx_id = json_decode($content)->txId;
      $_SESSION['trans_id'] = $tx_id;
      variable_set('miniorange_otp_current_status', 'OTP_SENT');
      drupal_set_message(t('OTP has been resent to @otp_resend', array('@otp_resend' => $email_code)));
    } else {
      drupal_set_message(t('OTP could not be sent'), 'error');
    }
  } else {
    $ph = $_SESSION['miniorange_otp']['register_values']['phone'];
    $ph = str_replace(' ', '', $ph);
    $phno = drupal_strlen($ph);
    $phbr1 = drupal_substr($ph, 0, 4);
    $phbr2 = drupal_substr($ph, $phno - 2, $phno);
    for ($i = 5; $i <= $phno - 2; $i++) {
      $_miniorange_otp_x = "X" . $_miniorange_otp_x;
    }
    $ph_code = $phbr1 . $_miniorange_otp_x . $phbr2;
    if (!MiniorangeOtpUtilities::isCurlInstalled()) {
      return json_encode(array(
        "status" => 'CURL_ERROR',
        "statusMessage" => '<a href="http://php.net/manual/en/curl.installation.php">PHP cURL extension</a> is not installed or disabled.',
      ));
    }
    $url = MiniorangeOtpConstants::$baseUrl . '/moas/api/auth/challenge';
    $ch = curl_init($url);
    $api_key = variable_get('miniorange_otp_customer_api_key', NULL);
    $customer_key = variable_get('miniorange_otp_customer_id', NULL);
    // Current time in milliseconds since midnight, January 1, 1970 UTC.
//    $current_time_in_millis = round(microtime(TRUE) * 1000);
    $current_time_in_millis = MiniorangeOtpCustomer::get_oauth_timestamp();
    // Creating the Hash using SHA-512 algorithm.
    $string_to_hash = $customer_key . $current_time_in_millis . $api_key;
    $hash_value = hash("sha512", $string_to_hash);
    $customer_key_header = "Customer-Key: " . $customer_key;
    $timestamp_header = "Timestamp: " . $current_time_in_millis;
    $authorization_header = "Authorization: " . $hash_value;

    $fields = array(
      'customerKey' => $customer_key,
      'phone' => $ph,
      'authType' => 'SMS',
      'transactionName' => 'Drupal OTP Verification',
    );

    $field_string = json_encode($fields);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customer_key_header,
      $timestamp_header, $authorization_header,
    ));
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);

    $content = curl_exec($ch);
    $trans_status = json_decode($content)->status;
    curl_close($ch);
    if ($trans_status == "SUCCESS") {
      $tx_id = json_decode($content)->txId;
      $_SESSION['trans_id'] = $tx_id;
      variable_set('miniorange_otp_current_status', 'OTP_SENT');
      drupal_set_message(t('OTP has been resent to @otp_resend_phone', array('@otp_resend_phone' => $ph_code)));
    } else {
      drupal_set_message(t('OTP could not be sent'), 'error');
    }
  }
}
