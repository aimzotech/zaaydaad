<?php
/**
 * @file
 * Contains miniOrange Customer class.
 */

/**
 * @file
 * This class represents configuration for customer.
 */
class MiniorangeOtpCustomer
{

  public $email;

  public $phone;

  public $customerKey;

  public $transactionId;

  public $password;

  public $otpToken;

  public $defaultCustomerId;

  public $defaultCustomerApiKey;

  public static $pcode = "ZHJ1cGFsX290cF92ZXJpZmljYXRpb25fYmFzaWNfcGxhbg==";              //drupal_otp_verification_basic_plan
  public static $bcode = "ZHJ1cGFsX290cF92ZXJpZmljYXRpb25fcHJlbWl1bV9wbGFu";              //drupal_otp_verification_premium_plan

  /**
   * Constructor.
   */
  public function __construct($email, $phone, $password, $otp_token)
  {
    $this->email = $email;
    $this->phone = $phone;
    $this->password = $password;
    $this->otpToken = $otp_token;
    $this->defaultCustomerId = MiniorangeOtpConstants::$defaultCustomerId;
    $this->defaultCustomerApiKey = MiniorangeOtpConstants::$defaultCustomerApiKey;
  }

  /**
   * Hidden Phone Number.
   */
  public static function getHiddenPhone($phone)
  {
    $hidden_phone = 'xxxxxxx' . substr($phone, strlen($phone) - 3);
    return $hidden_phone;
  }

  /**
   * Value empty or null.
   */
  public static function moCheckEmptyOrNull($value)
  {
    if (!isset($value) || empty($value)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Curl install check.
   */
  public static function moIsCurlInstalled()
  {
    if (in_array('curl', get_loaded_extensions())) {
      return 1;
    } else {
      return 0;
    }
  }

  /**
   * Curl page Url.
   */
  public static function moCurpageurl()
  {
    $page_url = 'http';

    if ((isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on")) {
      $page_url .= "s";

      $page_url .= "://";

      if ($_SERVER["SERVER_PORT"] != "80") {
        $page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
      } else {
        $page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
      }
      if (function_exists('apply_filters')) {
        apply_filters('wppb_curpageurl', $page_url);

        return $page_url;
      }
    }
  }

  /**
   * Phone number length.
   */
  public static function moCheckNumberLength($token)
  {
    if (is_numeric($token)) {
      if (strlen($token) >= 4 && strlen($token) <= 8) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  /**
   * Hidden email.
   */
  public static function moGetHidenEmail($email)
  {
    if (!isset($email) || trim($email) === '') {
      return "";
    }
    $emailsize = strlen($email);
    $partialemail = substr($email, 0, 1);
    $temp = strrpos($email, "@");
    $endemail = substr($email, $temp - 1, $emailsize);
    for ($i = 1; $i < $temp; $i++) {
      $partialemail = $partialemail . 'x';
    }
    $hiddenemail = $partialemail . $endemail;
    return $hiddenemail;
  }

  /**
   * Check for request from mobile device.
   */
  public static function checkIfRequestIsFromMobileDevice($useragent)
  {
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Check if customer is registered.
   */
  public static function moCustomerValidationIsCustomerRegistered()
  {
    $email = variable_get('miniorange_otp_customer_admin_email');
    $customer_key = variable_get('miniorange_otp_customer_id');
    if (!$email || !$customer_key || !is_numeric(trim($customer_key))) {
      return 0;
    } else {
      return 1;
    }
  }

  /**
   * Check if customer is validated.
   */
  public static function moIsCustomerValidated()
  {
    $email = variable_get('miniorange_otp_customer_admin_email');
    $customer_key = variable_get('miniorange_otp_customer_id');
    if (!$email || !$customer_key || !is_numeric(trim($customer_key))) {
      return 0;
    } else {
      return variable_get('mo_customer_check_ln') ? variable_get('mo_customer_check_ln') : 0;
    }
  }

  /**
   * Check if customer exists.
   */
  public function checkCustomer()
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/rest/customer/check-if-exists';

    $email = $this->email;

    $fields = array(
      'email' => $email,
    );
    $field_string = json_encode($fields);
    $response = MiniorangeOtpUtilities::callService($this->defaultCustomerId, $this->defaultCustomerApiKey, $url, $field_string);

    if (json_last_error() == JSON_ERROR_NONE && strcasecmp($response->status, 'CURL_ERROR') == 0) {
      $error = array(
        '%method' => 'checkCustomer',
        '%file' => 'otp_customer_setup.php',
        '%error' => $response->message,
      );
      watchdog('miniorange_otp', 'Error at %method of %file: %error', $error);
    }
    return $response;
  }

  /**
   * Create Customer.
   */
  public function createCustomer()
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/rest/customer/add';
    $fields = array(
      'companyName' => $_SERVER['SERVER_NAME'],
      'areaOfInterest' => 'Drupal OTP Verification Plugin',
      'email' => $this->email,
      'phone' => $this->phone,
      'password' => $this->password,
    );
    $field_string = json_encode($fields);
    $response = MiniorangeOtpUtilities::callService($this->defaultCustomerId, $this->defaultCustomerApiKey, $url, $field_string);

    if (json_last_error() == JSON_ERROR_NONE && strcasecmp($response->status, 'CURL_ERROR') == 0) {
      $error = array(
        '%method' => 'createCustomer',
        '%file' => 'otp_customer_setup.php',
        '%error' => $response->message,
      );
      watchdog('miniorange_otp', 'Error at %method of %file: %error', $error);
    }
    return $response;
  }

  /**
   * Get Customer Keys.
   */
  public function getCustomerKeys()
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/rest/customer/key';
    $email = $this->email;
    $password = $this->password;

    $fields = array(
      'email' => $email,
      'password' => $password,
    );
    $field_string = json_encode($fields);
    $response = MiniorangeOtpUtilities::callService($this->defaultCustomerId, $this->defaultCustomerApiKey, $url, $field_string);

    if (json_last_error() == JSON_ERROR_NONE && empty($response->apiKey)) {
      $error = array(
        '%method' => 'getCustomerKeys',
        '%file' => 'otp_customer_setup.php',
        '%error' => $response->message,
      );
      watchdog('miniorange_otp', 'Error at %method of %file: %error', $error);
    }
    return $response;
  }

  /**
   * Send OTP.
   */
  public function sendOtp()
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/api/auth/challenge';
    $customer_key = $this->defaultCustomerId;

    $username = variable_get('miniorange_otp_customer_admin_email', NULL);

    $fields = array(
      'customerKey' => $customer_key,
      'email' => $username,
      'authType' => 'EMAIL',
    );
    $field_string = json_encode($fields);
    $response = MiniorangeOtpUtilities::callService($this->defaultCustomerId, $this->defaultCustomerApiKey, $url, $field_string);

    if (json_last_error() == JSON_ERROR_NONE && strcasecmp($response->status, 'CURL_ERROR') == 0) {
      $error = array(
        '%method' => 'sendOtp',
        '%file' => 'otp_customer_setup.php',
        '%error' => $response->message,
      );
      watchdog('miniorange_otp', 'Error at %method of %file: %error', $error);
    }
    return $response;
  }

  /**
   * Validate OTP.
   */
  public function validateOtp($transaction_id)
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/api/auth/validate';
    $fields = array(
      'txId' => $transaction_id,
      'token' => $this->otpToken,
    );

    $field_string = json_encode($fields);
    $response = MiniorangeOtpUtilities::callService($this->defaultCustomerId, $this->defaultCustomerApiKey, $url, $field_string);

    if (json_last_error() == JSON_ERROR_NONE && strcasecmp($response->status, 'CURL_ERROR') == 0) {
      $error = array(
        '%method' => 'validateOtp',
        '%file' => 'otp_customer_setup.php',
        '%error' => $response->message,
      );
      watchdog('miniorange_otp', 'Error at %method of %file: %error', $error);
    }
    return $response;
  }

  /**
   * Check customer license.
   */
  public function checkCustomerLn()
  {

    $url = MiniorangeOtpConstants::$baseUrl . '/moas/rest/customer/license';
    $ch = curl_init($url);

    /* The customer Key provided to you */
    $customer_key = variable_get('miniorange_otp_customer_id', NULL);

    /* The customer API Key provided to you */
    $api_key = variable_get('miniorange_otp_customer_api_key', NULL);
    /* Current time in milliseconds since midnight, January 1, 1970 UTC. */
//    $current_time_in_millis = round(microtime(TRUE) * 1000);
    $current_time_in_millis = MiniorangeOtpCustomer::get_oauth_timestamp();

    /* Creating the Hash using SHA-512 algorithm */
    $string_to_hash = $customer_key . number_format($current_time_in_millis, 0, '', '') . $api_key;
    $hash_value = hash("sha512", $string_to_hash);

    $customer_key_header = "Customer-Key: " . $customer_key;
    $timestamp_header = "Timestamp: " . $current_time_in_millis;
    $authorization_header = "Authorization: " . $hash_value;
    $fields = '';

    // Check for otp over sms/email.
    $fields = array(
      'customerId' => $customer_key,
      'applicationName' => 'drupal_otp',
    );
    $field_string = json_encode($fields);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    // Required for https urls.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
      $customer_key_header, $timestamp_header, $authorization_header,
    ));
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $content = curl_exec($ch);

    if (curl_errno($ch)) {
      return NULL;
    }
    curl_close($ch);
    return $content;
  }

  /**
   * This function is used to get the timestamp value
   */
  public static function get_oauth_timestamp()
  {
    $url = 'https://login.xecurify.com/moas/rest/mobile/get-timestamp';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // required for https urls
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    $content = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error in sending curl Request';
      exit ();
    }
    curl_close($ch);
    if (empty($content)) {
      $currentTimeInMillis = round(microtime(true) * 1000);
      $currentTimeInMillis = number_format($currentTimeInMillis, 0, '', '');
    }
    return empty($content) ? $currentTimeInMillis : $content;
  }


}
