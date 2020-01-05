<?php
/** set your paypal credential **/

$config['client_id'] = 'AS4TjG_vRryCdJ0bq7jPelZyHDCNWiB7rtI5dcsDcILzxIDEEZ-UM8HiiTAjEdZhG0MMNnXdN5jXhmjC';
$config['secret'] = 'ED0-yoL1SRtJ00BB6RiDdRWJwyqWWITW6M34hBt9P32X-NCwYhRfZpy9wkcVzk6QH5MgDuxHuSzBYIOQ';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);