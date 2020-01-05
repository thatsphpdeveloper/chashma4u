<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Payment Mode
     **/
    $config['testmode']   = 'off';
    /**
     * Private Live Kay
     **/
    $config['LIVE_MERCHANT_KEY']    = 'XjRJsC64';
    $config['LIVE_SALT']    = '5YZiRBMi1c';

    $config['TEST_MERCHANT_KEY']    = 'gtKFFx';
    $config['TEST_SALT']    = 'eCwWELxi';

    $config['LIVE_URL']    = 'https://secure.payu.in/_payment';
    $config['TEST_URL']    = 'https://sandboxsecure.payu.in/_payment';


    /**
      * current merchant key
    **/
    $config['current_merchant_key'] = ($config['testmode'] == 'on') ? $config['TEST_MERCHANT_KEY'] : $config['LIVE_MERCHANT_KEY'];

    /**
      * current salt
    **/
    $config['current_salt'] = ($config['testmode'] == 'on') ? $config['TEST_SALT'] : $config['LIVE_SALT'];

    /**
      * current salt
    **/
    $config['current_url'] = ($config['testmode'] == 'on') ? $config['TEST_URL'] : $config['LIVE_URL'];
