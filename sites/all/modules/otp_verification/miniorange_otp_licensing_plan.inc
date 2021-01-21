<?php
/**
 * @file
 * Contains Licensing information for miniOrange OTP Verification Module.
 */

/**
 * Showing Licensing form info.
 */
function miniorange_otp_licensing_plan()
{

  global $base_url;

  $admin_email = variable_get('miniorange_otp_customer_admin_email', NULL);
  $admin_email = (isset($admin_email) && !empty($admin_email)) ? $admin_email : 'none';

  $support_url = $base_url . '/?q=admin/config/people/miniorange_otp/support';
  $var = variable_get('mo_customer_check_ln');
  $pcode = MiniorangeOtpCustomer::$pcode;
  $bcode = MiniorangeOtpCustomer::$bcode;
  $dyi_plan = "https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=drupal_otp_verification_basic_plan";
  $premium_plan_1 = "https://login.xecurify.com/moas/login?username=" . $admin_email . "&redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=drupal_otp_verification_premium_plan";
  $quick_recharge = "https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=otp_recharge_plan";

  $register_url = $base_url . '/admin/config/people/miniorange_otp/';
  if (!MiniorangeOtpUtilities::isCustomerRegistered()) {
    $premium_plan = $register_url;
    $target = 'target=""';

  } else {
    $premium_plan = $premium_plan_1;
    $target = 'target="_blank"';
  }
  $First_Name = "Click to Upgrade";
  $Second_Name = "Click to Upgrade";
  $message = "";
  if ($var == $pcode) {
    $First_Plan = $dyi_plan;
    $Second_Plan = $quick_recharge;
    $Second_Name = "Recharge";
  } elseif ($var == $bcode) {
    $First_Plan = $quick_recharge;
    $Second_Plan = $premium_plan;
    $First_Name = "Recharge";
  } else {
    $First_Plan = $dyi_plan;
    $Second_Plan = $premium_plan;
    $message = "(You are on this plan)";
  }

  $custom_plan = "https://login.xecurify.com/moas/admin/customer/confirmpayment";

  $form['header_top_style_2'] = array(
    '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout">'
  );

  $form['markup_1'] = array(
    '#markup' => '<br><h2 style="margin-left: 37px;">UPGRADE PLANS</h2><hr>'
  );

  $form['markup_free'] = array(
    '#markup' => '<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Main Style -->
        </head>
        <body>
        <!-- Pricing Table Section -->
        <section id="mo_otp_pricing-table">
            <div class="mo_otp_container_1">
                <div class="row">
                    <div class="mo_otp_pricing">
                        <div>
                            <div class="mo_otp_pricing-table mo_otp_class_inline_1">
                                <div class="mo_otp_pricing-header">
                                    <h1 class="mo_otp_pricing-title" style="margin-bottom:31px;">Features / Plans</h1>
                                </div>
                                <div class="mo_otp_pricing-list">
                                    <ul>
                                        <li>Email Address Verification</li>
                                        <li>Phone Number Verification</li>
                                        <li>Basic Support by Email</li>
                                        <li>Custom Email Template</li>
                                        <li>Custom SMS Template</li>
                                        <li>Custom OTP Length</li>
                                        <li>Custom OTP Validity Time</li>
                                        <li>Custom SMS/SMTP Gateway</li>
                                        <li>Custom Integration/Work</li>
                                        <li>Support Plans</li>
                                    </ul>
                                </div>
                        </div>
                                                     
                        <div class="mo_otp_pricing-table mo_otp_class_inline">
                            <div class="mo_otp_pricing-header" style="height: 400px;">
                                <p class="mo_otp_pricing-title" style="margin-bottom:5px;">Free</p>
                                <p class="mo_otp_pricing-rate">                                                                   <sup>$</sup> 0   
                                </p>
                                <div class="mo_otp_filler-class"></div>
                                <p><span style="font-size:13px;color:#fff;font-weight:500;"><b>10 SMS and 10 Email Verification through miniOrange Gateway</b></span></p><br><br><br><br><br><br><br>
                                <p class="mo_otp_pricing-title"><span style="font-size:12px;"><b>' . $message . '</b></span></p><br>                                
                            </div>
                            
                            <div class="mo_otp_pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li></li>
                                    <li></li>
                                    <li>Basic Email Support</li>
                                  </ul>
                            </div>
                        </div>
                        
                        <div class="mo_otp_pricing-table mo_otp_class_inline">
                            <div class="mo_otp_pricing-header" style="height: 400px;">
                                <p class="mo_otp_pricing-title">CUSTOM GATEWAY</p>
                                <p class="mo_otp_pricing-rate" style="margin-bottom:5px;"><sup>$</sup> 49   
                                </p>
                                <p><span style="font-size:13px;color:#fff;font-weight:500;">(One Time Payment)</span></p>  
                                <p><span style="font-size:12px;color:#fff;font-weight:500;"><b>Unlimited OTP Generation and Verification SMS and Email delivery will be through your gateway</b></span></p>
                                      <h4 class="mo_otp_local_pricing_sub_header" style="padding-bottom:5px !important; text-align:center;">
                                 <a class="mo_otp_btn mo_otp_btn-primary btn-large" style="padding:5px; text-align:center; margin-top:50%" target="_blank" href="https://www.miniorange.com/contact">' . $First_Name . '*</a></h4></br></br>
                                    
                                      </div>

                            <div class="mo_otp_pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>Premium Support Plans</li> 
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mo_otp_pricing-table mo_otp_class_inline">
                            <div class="mo_otp_pricing-header" style="height: 400px;">
                                <p class="mo_otp_pricing-title">MINIORANGE GATEWAY</p>
                                <p class="mo_otp_pricing-rate" style="margin-bottom:5px;">                                                        <sup>$</sup> 0   
                                </p>
                                
                                <p><span style="font-size:18px;color:#fff;font-weight:500;"><b></b><br>&nbsp;&nbsp;&nbsp;&nbsp;For Email:</span></p>
                        <select required style="background:#34495e;border: 1px solid white;color:white; margin-left: 7px;height:25px;width:80%;">       
                            <option>$2 per 100 Email                                
                            <option>$5 per 500 Email                
                            <option>$7 per 1k Email                
                            <option>$20 per 5k Email                
                            <option>$30 per 10k Email
                            <option>$45 per 50k Email                            
                      </select>
                            <p><span style="font-size:18px;color:#fff;font-weight:500;">&nbsp;&nbsp;&nbsp;&nbsp;For SMS:</span></p>
                        <select required style="background:#34495e;border: 1px solid white;color:white; margin-left: 7px;height:25px;width:80%;">       
                            <option>$2 per 100 OTP* + SMS Charges                               
                            <option>$5 per 500 OTP* + SMS Charges            
                            <option>$7 per 1k OTP* + SMS Charges               
                            <option>$20 per 5k OTP* + SMS Charges          
                            <option>$30 per 10k OTP* + SMS Charges
                            <option>$45 per 50k OTP* + SMS Charges  
                        </select>

                        <p><span style="font-size:12px;color:#fff;font-weight:500;"><b>SMS charges vary from country to country</b></span></p> 
                        <h4 class="mo_otp_local_pricing_sub_header" style="padding-bottom:6px !important; text-align:center;">
            <a class="mo_otp_btn mo_otp_btn-primary btn-large" style="padding:5px; text-align:center; margin-top:14%" target="_blank" href="https://www.miniorange.com/contact">' . $Second_Name . '</a></h4>
                               
                            </div>
                            <div class="mo_otp_pricing-list">
                                <ul>                                  
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li></li>
                                    <li>&#x2714;</li>
                                    <li>Premium Support Plans</li>
                                </ul>
                            </div>
                        </div>                                                                     
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Table Section End -->
    </body>
    </html>',
  );


  $form['markup_5'] = array(
    '#markup' => '<div style="margin-left:10px;">If you want to use your <b>Custom SMS/SMTP gateway</b> for unlimited OTP generation and verification, mail us at ' . l(t('drupalsupport@xecurify.com'), 'mailto:drupalsupport@xecurify.com', array('absolute' => TRUE))
      . '.</div><br>',
  );

  $form['markup_6'] = array(
    '#markup' => '<div style="margin-left:10px;">If you want to use <b>miniOrange SMS/SMTP gateway</b> or want more than 10k transactions, '
      . 'mail us at ' . l(t('drupalsupport@xecurify.com'), 'mailto:drupalsupport@xecurify.com', array('absolute' => TRUE)) . '.</div><br>',
  );

  return $form;
}

/**
 * Check license.
 */
function miniorange_otp_handle_mo_check_ln($showmessage)
{
  $challenge_otp = new MiniorangeOtpCustomer(NULL, NULL, NULL, NULL);
  $content = json_decode($challenge_otp->checkCustomerLn(), TRUE);

  if (strcasecmp($content['status'], 'SUCCESS') == 0) {
    $license_plan = isset($content['licensePlan']) ? $content['licensePlan'] : '';
    array_key_exists('licensePlan', $content) && !MiniorangeOtpCustomer::moCheckEmptyOrNull($content['licensePlan']) ? variable_set('mo_customer_check_ln', base64_encode($content['licensePlan'])) : variable_set('mo_customer_check_ln', '');
    if ($showmessage) {
      array_key_exists('licensePlan', $content) && !MiniorangeOtpCustomer::moCheckEmptyOrNull($content['licensePlan']) ? drupal_set_message(t('Thank you, you have been upgraded to @license_name', array('@license_name' => $license_plan))) : drupal_set_message(t('You are on our FREE plan, check Upgrade Plans Tab to learn how to upgrade.'));
      if (array_key_exists('licensePlan', $content) && !MiniorangeOtpCustomer::moCheckEmptyOrNull($content['licensePlan'])) {
        variable_del('mo_customer_email_transactions_remaining');
        variable_del('mo_customer_phone_transactions_remaining');
        variable_del('mo_otp_plugin_version');
        variable_del('mo_customer_validation_transaction_message');
      }
    }
  } elseif (strcasecmp($content['status'], 'FAILED') == 0) {
    array_key_exists('licensePlan', $content) && !MiniorangeOtpCustomer::moCheckEmptyOrNull($content['licensePlan']) ? drupal_set_message(t('Thank you, you have been upgraded to @license_name', array('@license_name' => $license_plan))) : drupal_set_message(t('You are on our FREE plan, check Upgrade Plans Tab to learn how to upgrade.'));
  }
}

/**
 * Ok button.
 */
function miniorange_otp_mo_otp_ok_submit($showmessage)
{
  global $base_url;
  drupal_goto($base_url . '/?q=admin/config/people/miniorange_otp/settings');
}
