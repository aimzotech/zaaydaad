<?php
/**
 * @file
 * Contains form for customer setup.
 */

/**
 * Customer setup form().
 */
function miniorange_otp_customer_setup($form, &$form_state)
{
  global $base_url;

  $current_status = variable_get('miniorange_otp_status', '');

  if ($current_status == 'VALIDATE_OTP') {

    $form['header_top_style_2'] = array(
      '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_otp_container">'
    );

    $form['miniorange_otp_customer_otp_token'] = array(
      '#type' => 'textfield',
      '#title' => t('OTP'),
    );

    $form['miniorange_otp_customer_validate_otp_button'] = array(
      '#type' => 'submit',
      '#value' => t('Validate OTP'),
      '#submit' => array('miniorange_otp_validate_otp_submit'),
    );

    $form['miniorange_otp_customer_setup_resendotp'] = array(
      '#type' => 'submit',
      '#value' => t('Resend OTP'),
      '#submit' => array('miniorange_otp_resend_otp'),
    );

    $form['miniorange_otp_customer_setup_back'] = array(
      '#type' => 'submit',
      '#value' => t('Back'),
      '#submit' => array('miniorange_otp_back'),
      '#suffix' => '</div>'
    );

    MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);

    return $form;
  } elseif ($current_status == 'PLUGIN_CONFIGURATION') {
    // Show customer configuration here.
    $form['markup_top'] = array(
      '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_otp_container">
                    <div style="display:block;margin-top:10px;text-align: center;font-size: 15px;color:rgba(0, 128, 0, 0.80);background-color:rgba(0, 255, 0, 0.15);padding:5px;">
                         Thank you for registering with miniOrange</div></br>' . '<h4><b>Your Profile:</b></h4>',
    );

    $header = array(
      'email' => array('data' => t('Customer Email')),
      'customerid' => array('data' => t('Customer ID')),
      'token' => array('data' => t('Token Key')),
      'apikey' => array('data' => t('API Key')),
    );

    $options = array();

    $options[0] = array(
      'email' => variable_get('miniorange_otp_customer_admin_email', ''),
      'customerid' => variable_get('miniorange_otp_customer_id', ''),
      'token' => variable_get('miniorange_otp_customer_admin_token', ''),
      'apikey' => variable_get('miniorange_otp_customer_api_key', ''),
    );

    $form['fieldset']['customerinfo'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $options,
    );

    $form['markup_1'] = array(
      '#markup' => '<br><b>Track your Transactions:</b><br><br>'
        . 'Follow the steps to view your transactions: <br><br>'
        . '1. &nbsp Click on the button below.<br>'
        . '2. &nbsp Login using the credentials you used to register for this plugin.<br>'
        . '3. &nbsp You will be presented with <b><i>View Transactions</i></b> page.<br>'
        . '4. &nbsp From this page you can track your remaining transactions<br><br>',
    );
    $admin_email = variable_get('miniorange_otp_customer_admin_email', NULL);
    $form['markup_2'] = array(
      '#markup' => '<br><b>View Transactions:</b><br><br>'
        . '<a class="mo_otp_btn mo_otp_btn-primary btn-large" target="_blank" style="padding:5px; text-align:center;" href="https://login.xecurify.com/moas/login?username=' . $admin_email . '&redirectUrl=' . MiniorangeOtpConstants::$baseUrl . '/moas/viewtransactions">View Transaction</a></h4></div>',
    );

    MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);

    return $form;
  }

  $form['markup_14'] = array(
    '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_otp_container">
        <h3>Register/Login with miniOrange<br/><br/><hr></h3>',
  );

  $form['markup_15'] = array(
    '#markup' => '<div class="mo_saml_highlight_background_note_1">You should register so that in case you need help, we can help you with step by step instructions.
                    <b>You will also need a miniOrange account to upgrade gateway plans of the module.</b> 
                    We do not store any information except the email that you will use to register with us. Please enter a valid email id that you have access to. We will send OTP to this email for verification.</div><br>',
  );

  $form['miniorange_otp_customer_setup_username'] = array(
    '#type' => 'textfield',
    '#title' => t('Email<span class="mo_class_for_color_red">*</span>'),
    '#attributes' => array(
      'placeholder' => 'person@example.com',
    ),
  );

  $form['miniorange_otp_customer_setup_phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone'),
    '#attributes' => array(
      'placeholder' => 'Phone number with country code eg. +1xxxxxxxxxx',
    ),
    '#description' => '<b>Note:</b> We will only call if you need support.'
  );

  $form['miniorange_otp_customer_setup_password'] = array(
    '#type' => 'password_confirm',
  );

  $form['miniorange_otp_customer_setup_button'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
    '#submit' => array('miniorange_otp_customer_setup_submit'),
    '#suffix' => '</div>'
  );

  MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);

  return $form;
}

/**
 * Validate OTP.
 */
function miniorange_otp_validate_otp_submit(&$form, $form_state)
{
  global $user;
  $user = user_load($user->uid);
  $otp_token = trim($form['miniorange_otp_customer_otp_token']['#value']);

  if (empty($otp_token)) {
    drupal_set_message(t('The <b><u>OTP</u></b> field is mandatory.'), 'error');
    return;
  }

  $username = variable_get('miniorange_otp_customer_admin_email', NULL);
  $phone = variable_get('miniorange_otp_customer_admin_phone', NULL);
  $tx_id = variable_get('miniorange_otp_tx_id', NULL);
  $customer_config = new MiniorangeOtpCustomer($username, $phone, NULL, $otp_token);

  // Validate OTP.
  $validate_otp_response = $customer_config->validateOtp($tx_id);
  if ($validate_otp_response->status == 'SUCCESS') {
    // OTP Validated. Show Configuration page.

    variable_del('miniorange_otp_tx_id');

    // OTP Validated. Create customer.
    $password = variable_get('miniorange_otp_customer_admin_password', '');
    $customer_config = new MiniorangeOtpCustomer($username, $phone, $password, NULL);
    $create_customer_response = $customer_config->createCustomer();
    if ($create_customer_response->status == 'SUCCESS') {
      // Customer created.
      variable_set('miniorange_otp_customer_admin_email', $username);
      variable_set('miniorange_otp_customer_admin_phone', $phone);
      variable_set('miniorange_otp_customer_admin_token', $create_customer_response->token);
      variable_set('miniorange_otp_customer_id', $create_customer_response->id);
      variable_set('miniorange_otp_customer_api_key', $create_customer_response->apiKey);
      variable_set('miniorange_otp_status', 'PLUGIN_CONFIGURATION');
      user_save($user);
      drupal_set_message(t('Your account has been created successfully. You can proceed to setup plugin in <b>Settings</b> section.'));
    } else if (trim($create_customer_response->message) == 'Email is not enterprise email.') {
      variable_del('miniorange_otp_status');
      drupal_set_message(t('There was an error creating an account for you.<br> You may have entered an invalid Email-Id
        <strong>(We discourage the use of disposable emails) </strong>
        <br>Please try again with a valid email.'), 'error');
    } else {
      variable_del('miniorange_otp_status');
      drupal_set_message(t('An error occured while creating your account. Please try again or contact us at <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a>.'), 'error');
    }
  } else {
    drupal_set_message(t('The OTP you have entered is incorrect. Please try again.'), 'error');
  }
}

/**
 * Resend OTP.
 */
function miniorange_otp_resend_otp(&$form, $form_state)
{

  variable_del('miniorange_otp_tx_id');
  $username = variable_get('miniorange_otp_customer_admin_email', NULL);
  $phone = variable_get('miniorange_otp_customer_admin_phone', NULL);
  $customer_config = new MiniorangeOtpcustomer($username, $phone, NULL, NULL);
  $send_otp_response = $customer_config->sendOtp();
  if ($send_otp_response->status == 'SUCCESS') {
    // Store txID.
    variable_set('miniorange_otp_tx_id', $send_otp_response->txId);
    variable_set('miniorange_otp_status', 'VALIDATE_OTP');
    drupal_set_message(t('We have resend an OTP to @username. Please enter the OTP to verify your email.', array(
      '@username' => $username
    )));
  } else {
    variable_del('miniorange_otp_status');
    drupal_set_message(t('There was an error sending OTP to @username. Please try after some time or contact us at <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a>.', array(
      '@username' => $username
    )));
  }
}

/**
 * Handle submit for customer setup.
 */
function miniorange_otp_customer_setup_submit(&$form, $form_state)
{

  global $user;
  $user = user_load($user->uid);
  $username = trim($form['miniorange_otp_customer_setup_username']['#value']);
  $phone = $form['miniorange_otp_customer_setup_phone']['#value'];
  $password = $form['miniorange_otp_customer_setup_password']['#value']['pass1'];

  if (!valid_email_address($username)) {
    drupal_set_message(t('The email address <strong>' . $username . '</strong> is not valid.'), 'error');
    return;
  }
  if (empty($username) || empty($password)) {
    drupal_set_message(t('The <b>Email Address</b> and <b>Password</b> fields are mandatory.'), 'error');
    return;
  }

  $customer_config = new MiniorangeOtpCustomer($username, $phone, $password, NULL);
  $check_customer_response = $customer_config->checkCustomer();

  if ($check_customer_response->status == 'CUSTOMER_NOT_FOUND') {
    // Create customer.
    // Store email and phone.
    variable_set('miniorange_otp_customer_admin_email', $username);
    variable_set('miniorange_otp_customer_admin_phone', $phone);
    variable_set('miniorange_otp_customer_admin_password', $password);
    variable_set('mo_customer_email_transactions_remaining', 10);
    variable_set('mo_customer_phone_transactions_remaining', 10);

    $send_otp_response = $customer_config->sendOtp();
    if ($send_otp_response->status == 'SUCCESS') {
      // Store txID.
      variable_set('miniorange_otp_tx_id', $send_otp_response->txId);
      variable_set('miniorange_otp_status', 'VALIDATE_OTP');
      drupal_set_message(t('We have sent an OTP to @username. Please enter the OTP to verify your email.', array(
        '@username' => $username
      )));
    } else {
      variable_del('mo_auth_status');
      drupal_set_message(t('There was an error sending OTP to @username. Please try after some time or contact us at <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a>.', array(
        '@username' => $username
      )));
    }
  } elseif ($check_customer_response->status == 'CURL_ERROR') {
    drupal_set_message(t('cURL is not enabled. Please enable cURL'), 'error');
    return;
  } elseif ($check_customer_response->status == 'SUCCESS') {
    // Customer exists. Retrieve keys.
    $customer_keys_response = $customer_config->getCustomerKeys();
    if (json_last_error() == JSON_ERROR_NONE) {
      variable_set('miniorange_otp_customer_id', $customer_keys_response->id);
      variable_set('miniorange_otp_customer_admin_token', $customer_keys_response->token);
      variable_set('miniorange_otp_customer_admin_email', $username);
      variable_set('miniorange_otp_customer_admin_phone', $phone);
      variable_set('miniorange_otp_customer_api_key', $customer_keys_response->apiKey);
      variable_set('miniorange_otp_status', 'PLUGIN_CONFIGURATION');
      user_save($user);
      drupal_set_message(t('Successfully retrieved your account.'));
      return;
    } else {
      drupal_set_message(t('Invalid credentials'), 'error');
      return;
    }
  } else {
    drupal_set_message(t('An error occured while processing your request. Please try after some time or contact us at <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a>.'), 'error');
  }
}

/**
 * Handle back button submit for customer setup.
 */
function miniorange_otp_back(&$form, $form_state)
{
  variable_set('miniorange_otp_status', 'CUSTOMER_SETUP');
  variable_del('miniorange_otp_customer_admin_email');
  variable_del('miniorange_otp_customer_admin_phone');
  variable_del('miniorange_otp_tx_id');
  drupal_set_message(t('Register/Login with your miniOrange account.'));
}
