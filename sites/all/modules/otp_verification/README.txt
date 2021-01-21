CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Installation
 * Configuration

INTRODUCTION
------------
OTP Verification plugin verifies Email Address/Mobile Number of users 
by sending verification code(OTP) during registration. 
It removes the possibility of a user registering with fake 
Email Address/Mobile Number. 
This plugin checks the existence of the Email Address/Mobile Number 
and the ability of a user to access that Email Address/Mobile Number.
 
= How does this plugin work? =
1. On submitting the registration form an Email/SMS with OTP is sent 
to the email address/mobile number provided by the user.
2. Once the OTP is entered, it is verified and the user gets registered.


INSTALLATION
------------

Install as you would normally install a contributed Drupal module. 

See: https://drupal.org/documentation/install/modules-themes/modules-7 
for further information.

CONFIGURATION
-------------
 * Configure OTP Verification in Administration » 
 » People » miniOrange OTP Verification:
 
 1.Register with miniOrange. If your already have miniOrange, 
 enter your username and password to retrieve your account. 
 2.Once the account is retrieved, go to Settings Tab to configure 
 the verification method you would like to use.
 3.Unselect the "Require e-mail verification when a visitor creates an account" 
 from the Drupal Configuration Menu -> Account Settings -> 
 -> Registration and cancellation. 
 This will allow new users to set their own passwords' during registration.
 4.If you need help, go to Support tab and submit your query. 
 
 You can also email us at info@xecurify.com
