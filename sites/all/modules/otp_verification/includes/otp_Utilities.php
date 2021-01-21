<?php
/**
 * @file
 * This file is part of miniOrange OTP Verification plugin.
 */

/**
 * OTP Utilities Class.
 */
class MiniorangeOtpUtilities
{


  Public static function add_support_form_otp(&$form, $form_state)
  {

    $form['markup_support_1'] = array(
      '#markup' => '<div class="mo_saml_table_layout_support_1"><h3><b>Support:</b></h3></span></h3>
                <div>Need any help? Just send us a query so we can help you.<br /></div>',
    );

    $form['miniorange_otp_email_address'] = array(
      '#type' => 'textfield',
      '#attributes' => array('style' => 'width:100%', 'placeholder' => 'Enter your Email'),
      '#default_value' => variable_get('miniorange_otp_customer_admin_email', FALSE),
    );

    $form['miniorange_otp_phone_number'] = array(
      '#type' => 'textfield',
      '#attributes' => array('style' => 'width:100%', 'placeholder' => 'Enter your phone number with country code (+1)'),
      '#default_value' => variable_get('miniorange_otp_customer_admin_phone', FALSE),
    );

    $form['miniorange_otp_support_query'] = array(
      '#type' => 'textarea',
      '#cols' => '10',
      '#rows' => '5',
      '#attributes' => array('style' => 'width:100%', 'placeholder' => 'Write your query here.'),
      '#resizable' => FALSE,
    );

    $form['miniorange_otp_support_submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit Query'),
      '#limit_validation_errors' => array(),
      '#prefix' => '<div style = "text-align:center;">',
      '#submit' => array('MiniorangeOtpUtilities::miniorange_otp_send_query'),
      '#suffix' => '</div>',
    );

    $form['miniorange_saml_support_note'] = array(
      '#markup' => '<div>If you want custom features in the module, just drop an email to <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></div></div>'
    );
  }


  /**
   * Send support query.
   */
  public static function miniorange_otp_send_query($form, &$form_state)
  {

    $email = $form['miniorange_otp_email_address']['#value'];
    $phone = $form['miniorange_otp_phone_number']['#value'];
    $query = $form['miniorange_otp_support_query']['#value'];
    if (!valid_email_address($email)) {
      drupal_set_message(t('The email address <strong>' . $email . '</strong> is not valid.'), 'error');
      return;
    }
    if (empty($email) || empty($query)) {
      drupal_set_message(t('The <strong>email</strong> and <strong>query</strong> fields are mandatory.'), 'error');
      return;
    }
    $support = new MiniOrangeOtpSupport($email, $phone, $query);
    $support_response = $support->sendSupportQuery();
    if ($support_response) {
      drupal_set_message(t('Thanks for getting in touch! We will get back to you shortly.'));
    } else {
      drupal_set_message(t('Error sending support query'), 'error');
      return;
    }
  }

  /**
   * Advertise 2FA
   */

  public static function Two_FA_Advertisement(&$form, $form_state)
  {
    global $base_url;

    $form['markup_idp_attr_hea555der_top_support'] = array(
      '#markup' => '<div class="mo_saml_table_layout_support_1">',
    );

    $form['miniorangerr_otp_email_address'] = array(
      '#markup' => '<div><h3 class="mo_otp_h_3"  >Looking for an OTP during login module, checkout our Drupal <br>Two-Factor Authentication(2FA) module<br></h3></div>
                        <div class="mo_otp_adv_tfa"><img src="' . $base_url . '/' . drupal_get_path("module", "miniorange_otp") . '/includes/images/miniorange_i.png" alt="Simply Easy Learning" height="80px" width="80px" class="mo_otp_img_adv"><h3 class="mo_otp_txt_h3">Two-Factor Authentication (2FA)</h3></div>',

    );

    $form['minioranqege_otp_phone_number'] = array(
      '#markup' => '<div class="mo_otp_paragraph"><p>Two Factor Authentication (TFA) for your Drupal site is highly secure and easy to setup. Adds a second layer of security to your Drupal accounts. It protects your site from hacks and unauthorized login attempts.</p></div>',
    );

    $form['miniorange_otp_2fa_button'] = array(
      '#markup' => '<div style="align:center;margin-left:15px;"> <a href="https://www.drupal.org/project/miniorange_2fa" class="mo_otp_btn1 mo_otp_btn mo_otp_btn-success" target="_blank" id="tfa_btn_download">Download Module</a>
      <a href="https://plugins.miniorange.com/drupal-two-factor-authentication-2fa" class="mo_otp_btn2 mo_otp_btn mo_otp_btn-primary" target="_blank" id="tfa_btn_know">Know More</a><br><br></div></div></div>'

    );
  }

  /**
   * Check if curl is installed.
   */
  public static function isCurlInstalled()
  {
    if (in_array('curl', get_loaded_extensions())) {
      return 1;
    } else {
      return 0;
    }
  }

  function otp_user_logout(){
    $logout_redirect_url = variable_get('otp_logout_url','');
    if($logout_redirect_url !='')
    {
        session_destroy();
        drupal_goto($logout_redirect_url);
    }
  }

  /**
   * Check if customer is registered.
   */
  public static function isCustomerRegistered()
  {
    if (variable_get('miniorange_otp_customer_admin_email', NULL) == NULL ||
      variable_get('miniorange_otp_customer_id', NULL) == NULL ||
      variable_get('miniorange_otp_customer_admin_token', NULL) == NULL ||
      variable_get('miniorange_otp_customer_api_key', NULL) == NULL) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Call Service function for customer check.
   */
  public static function callService($customer_id, $api_key, $url, $field_string)
  {
    if (!self::isCurlInstalled()) {
      return json_encode(array(
        "status" => 'CURL_ERROR',
        "message" => 'PHP cURL extension is not installed or disabled.',
      ));
    }

    $ch = curl_init($url);
//    $current_time_in_millis = round(microtime(TRUE) * 1000);
    $current_time_in_millis = MiniorangeOtpCustomer::get_oauth_timestamp();

    $string_to_hash = $customer_id . number_format($current_time_in_millis, 0, '', '') . $api_key;
    $hash_value = hash("sha512", $string_to_hash);
    $customer_key_header = "Customer-Key: " . $customer_id;
    $timestamp_header = "Timestamp: " . number_format($current_time_in_millis, 0, '', '');
    $authorization_header = "Authorization: " . $hash_value;
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    // Required for https urls.
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
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $content = curl_exec($ch);
    if (curl_errno($ch)) {
      return json_encode(array(
        "status" => 'CURL_ERROR',
        "message" => curl_errno($ch),
      ));
    }
    curl_close($ch);
    return json_decode($content);
  }

  public static function sendToken($otp_options, $email, $phone)
  {
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

    if ($otp_options === 'email') {
      $fields = array(
        'customerKey' => $customer_key,
        'email' => $email,
        'authType' => 'EMAIL',
        'transactionName' => 'Drupal OTP Verification',
      );
    }
    if ($otp_options === 'phone') {
      $fields = array(
        'customerKey' => $customer_key,
        'phone' => $phone,
        'authType' => 'SMS',
        'transactionName' => 'Drupal OTP Verification',
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
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customer_key_header, $timestamp_header, $authorization_header,
    ));
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);

    $content = curl_exec($ch);
    $trans_status = json_decode($content)->status;
    $tx_id = json_decode($content)->txId;
    curl_close($ch);
    return array($trans_status, $tx_id);
  }

  public static function Is_Restricted_Domain($email_domain)
  {
    $enable_domain_restriction = variable_get('miniorange_enable_domain_restriction');
    if ($enable_domain_restriction === FALSE) {
      return FALSE;
    }
    $domain = isset(explode('@', $email_domain)[1]) ? explode('@', $email_domain)[1] : '';
    if (is_null($domain) || empty($domain)) {
      return FALSE;
    }

    $alldomains = variable_get('miniorange_domains');
    $white_or_black = variable_get('miniorange_domains_are_white_or_black');
    $alldomains = explode(';', $alldomains);

    if ($white_or_black === 'white') {
      if (array_search($domain, $alldomains) === FALSE && !empty($alldomains[0])) {
        return TRUE;
      } else return FALSE;
    } elseif ($white_or_black == 'black') {
      if (array_search($domain, $alldomains) === FALSE) {
        return FALSE;
      } else return TRUE;
    }

  }

  public static function showDomainRestrictionError($email)
  {
    global $base_url;
    echo '<div style="font-family:Calibri;padding:0 3%;">';
    echo '<div style="color: #a94442;background-color: #f2dede;padding: 15px;margin-bottom: 20px;text-align:center;border:1px solid #E6B3B2;font-size:18pt;"> ERROR</div>
                                <div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>You are not allowed to register.</p>
                                    <p>Please contact your administrator.</p>
                                    <p><strong>Possible Cause: </strong>Your domain is not allowed to register.</p>
                                </div>
                                <div style="margin:3%;display:block;text-align:center;"></div>
                                <div style="margin:3%;display:block;text-align:center;">
                                    <form method="POST" action ="' . $base_url . '">
                                    <input style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="submit" value="Done" ">
                                    </form>
                                </div>';
    exit;
  }
}
