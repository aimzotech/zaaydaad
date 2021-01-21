<?php
/**
 * @file
 * Contains Settings for miniOrange OTP Verification Module.
 */

/**
 * Showing Settings form.
 */
function miniorange_otp_settings_information($form, &$form_state)
{


  global $base_url;
  $conf_url = $base_url . '/?q=admin/config/people/miniorange_otp/configuration';
  $config_url = $base_url . '/?q=admin/config/people/accounts';
  $register_url = $base_url . '/admin/config/people/miniorange_otp/';

  $disabled = FALSE;

  if (!MiniorangeOtpUtilities::isCustomerRegistered()) {
    $disabled = TRUE;
    $form['header'] = array(
      '#markup' => '<div class="mo_otp_configure_message">You need to <a href="' . $register_url . '" >Register/Login</a> using miniOrange account before using this module.</div>'
    );
  }

  $form['header_top_style_2'] = array(
    '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_otp_container">'
  );

  $form['miniorange_otp_customer_validation'] = array(
    '#method' => 'post',
    '#type' => 'hidden',
    '#id' => 'mo_otp_verification_settings',
    '#value' => 'mo_customer_validation_settings',
  );

  $form['markup_2'] = array(
    '#markup' => '<h3>OTP VERIFICATION SETTINGS</h3><hr><br>By following these easy steps you can verify your users email or phone number instantly:<br><br>1. &nbsp Select the Verification method.<br>'
      . '2. &nbsp Save your settings.<br>'
      . '3. &nbsp Disable the option: <b> "Require e-mail verification when a visitor creates an account" </b> under <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>"Registration and cancellation"</b> section from'
      . '<a target="_blank" href = "' . $config_url . '"> here</a>. This will allow new user to set their own <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;passwords while registration.<br>'
      . '4. &nbsp Log out and go to your registration or landing page for testing.<br><br>',
  );


  $form['enable_otp_options'] = array(
    '#type' => 'checkbox',
    '#title' => t('<b>Drupal Default Registration Form</b>'),
    '#default_value' => variable_get('miniorange_enable_otp_options', FALSE),
    '#disabled' => $disabled,
  );

  $form['set_of_radiobuttons'] = array(
    '#type' => 'fieldset',
    '#attributes' => array('style' => array('width:40%;padding:9px 0 0 0;color:#34495e;border: 1.1px groove black;border-radius: 8px;')),
    '#states' => array(
      // Only show this field when the 'enable_otp_options' checkbox is enabled.
      'enabled' => array(
        ':input[name="enable_otp_options"]' => array(
          'checked' => TRUE,
        ),
      ),
    ),

  );

  $form['set_of_radiobuttons']['miniorange_otp_options'] = array(
    '#type' => 'radios',
    '#tree' => TRUE,
    '#default_value' => is_null(variable_get('miniorange_otp_options')) ? 'email' : variable_get('miniorange_otp_options'),
    '#options' => array('email' => t('<b>Enable Email Verification</b>'), 'phone' => t('<b>Enable Phone Verification</b>')),
    '#disabled' => $disabled,
  );


  $form['markup_otp_space'] = array('#markup' => '</br>',
  );

  $form['markup_9'] = array(
    '#markup' => '<hr><br><h3>DOMAIN RESTRICTION</h3><hr><hr><br>',
  );

  $form['domain_restriction_checkbox'] = array(
    '#type' => 'checkbox',
    '#title' => t('Check this option if you want  <b>Domain Restriction</b>'),
    '#default_value' => variable_get('miniorange_enable_domain_restriction'),
    '#disabled' => $disabled,
  );

  $form['miniorange_set_of_radiobuttons'] = array(
    '#type' => 'fieldset',
    '#states' => array(
      // Only show this field when the checkbox is enabled.
      'visible' => array(
        ':input[name="domain_restriction_checkbox"]' => array('checked' => TRUE),
      ),
    ),
  );

  $form['miniorange_set_of_radiobuttons']['miniorange_allow_or_block_domains'] = array(
    '#type' => 'radios',
    '#maxlength' => 5,
    '#options' => array('white' => 'I want to allow only some of the domains', 'black' => 'I want to block some of the domains'),
    '#default_value' => variable_get('miniorange_domains_are_white_or_black', 'white'),
    '#disabled' => $disabled,
  );

  $form['miniorange_set_of_radiobuttons']['miniorange_domains'] = array(
    '#type' => 'textarea',
    '#title' => t('Enter list of domains'),
    '#tree' => TRUE,
    '#attributes' => array(
      'style' => 'width:700px;height:70px;',
      'placeholder' => t('Eg. xxxx.com;xxxx.com;'),
    ),
    '#resizable' => FALSE,
    '#description' => t('Enter semicolon(;) separated domains (Eg. xxxx.com; xxxx.com)'),
    '#default_value' => variable_get('miniorange_domains', ''),
    '#suffix' => '<br>',
  );

  $form['miniorange_otp_settings_save_button'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#submit' => array('miniorange_otp_settings_save'),
    '#disabled' => $disabled,
  );

  $form['markup_idp_attr_header_top_div_close'] = array('#markup' => '</div>',
  );

  MiniorangeOtpUtilities::add_support_form_otp($form, $form_state);
  MiniorangeOtpUtilities::Two_FA_Advertisement($form, $form_state);

  return $form;
}


/**
 * Handling Save Settings tab.
 */
function miniorange_otp_settings_save($form, &$form_state)
{

  global $base_url;

  $enable_otp_options = $form['enable_otp_options']['#value'];
  $user_enabled = $form_state['values']['miniorange_otp_options'];
  $logout_url = $base_url . '/?q=user/logout';
  $domains = null;
  $domain_restriction = $form['domain_restriction_checkbox']['#value'];
  $white_or_black = $form['miniorange_set_of_radiobuttons']['miniorange_allow_or_block_domains']['#value'];
  $domains = trim($form['miniorange_set_of_radiobuttons']['miniorange_domains']['#value']);

  $domain_restriction_value = FALSE;
  if ($domain_restriction == 1) {

    if (empty($domains)) {
      drupal_set_message(t('Please enter at least one domain.'), 'error');
      return;
    }

    $domain_restriction_value = TRUE;
  }


  if ($enable_otp_options == 0)
    variable_del('miniorange_otp_options');
  else
    variable_set('miniorange_otp_options', $user_enabled);

  variable_set('miniorange_enable_otp_options', $enable_otp_options);
  variable_set('miniorange_enable_domain_restriction', $domain_restriction_value);
  variable_set('miniorange_domains_are_white_or_black', $white_or_black);
  variable_set('miniorange_domains', $domains);
  $message = 'Settings saved successfully. You can go to your registration form page to test the plugin. <a href="' . $logout_url . '">Click here</a> to logout.';
  drupal_set_message(t($message));
}
