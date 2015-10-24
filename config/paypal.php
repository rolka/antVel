<?php
return array(
    //willemfranco@hotmail.com / 12345678 for tests
    // set your paypal credential
    'client_id' => 'Af9e5YCH9luReI9j_-pRLa1XDs6uyBeGzrhifacq3DuHIM4AEYsz0kjYs06aRgY3PLpzE6u-8RJy2T3Q',
    'secret' => 'EDtqzb3MpvBluaqHFa6tpLXZhh_lhqxAa4X_UGJRPWw05ajp7IDqcHSNRcsnnmFwxdBo6HfpK_2lFQ7M',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
