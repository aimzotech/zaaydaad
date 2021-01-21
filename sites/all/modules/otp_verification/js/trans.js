/**
 * @file
 * View Transactions.
 */

/**
 * Checks transaction limits.
 * @param plan The plan of the customer.
 * @param username The username of the customer.
 */

/* jshint unused:false */
function trans(plan, username) {
  'use strict';
  var f = document.createElement('form');
  f.setAttribute('method', 'post');
  f.setAttribute('action', 'https://login.xecurify.com/moas/login');
  f.setAttribute('target', '_blank');

  var i = document.createElement('input');
  i.setAttribute('type', 'text');
  i.setAttribute('name', 'username');
  i.setAttribute('value', username);

  var i2 = document.createElement('input');
  i2.setAttribute('type', 'text');
  i2.setAttribute('name', 'redirectUrl');
  i2.setAttribute('value', 'https://login.xecurify.com/moas/viewtransactions');

  var i3 = document.createElement('input');
  i3.setAttribute('type', 'text');
  i3.setAttribute('name', 'requestOrigin');
  i3.setAttribute('value', plan);
  f.appendChild(i);
  f.appendChild(i2);
  f.appendChild(i3);

  f.submit();
}

window.onload = function () {
  jQuery(function () {
    jQuery("#image1_link").click(function () {
      jQuery("#image1_toggle").toggle("slow");
    });
    jQuery("#image2_link").click(function () {
      jQuery("#image2_toggle").toggle("slow");
    });
    jQuery("#image3_link").click(function () {
      jQuery("#image3_toggle").toggle("slow");
    });
    jQuery("#image4_link").click(function () {
      jQuery("#image4_toggle").toggle("slow");
    });
    jQuery("#link_question1").click(function () {
      jQuery("#question1").toggle("fast");
    });
    jQuery("#link_question2").click(function () {
      jQuery("#question2").toggle("fast");
    });
    jQuery("#link_question3").click(function () {
      jQuery("#question3").toggle("fast");
    });
    jQuery("#link_question4").click(function () {
      jQuery("#question4").toggle("fast");
    });
    jQuery("#link_question5").click(function () {
      jQuery("#question5").toggle("fast");
    });
    jQuery("#link_question6").click(function () {
      jQuery("#question6").toggle("fast");
    });
    jQuery("#link_question7").click(function () {
      jQuery("#question7").toggle("fast");
    });
    jQuery("#link_question8").click(function () {
      jQuery("#question8").toggle("fast");
    });
  });
}
