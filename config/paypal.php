<?php
return [
  // set your paypal credential
  'client_id' => 'ASDArmkRO_7hr-K-uTTFm2_5GCyJE8hBGx9sXZoojslIsPAr9TiHEvpu7mjtZ2XjThXdIAVg9JqxO6Og',
  'secret'    => 'EDnZVcxG9rFQhkqv36vqTbhsTwQBlYFVLXIjw-Lb_7_h9zW6ssMDvlPz7a9zXTFXgAtOEinxTFFzm7pM',
  /**
   * SDK configuration
   */
  'settings'  => [
    /**
     * Available option 'sandbox' or 'live'
     */
    'mode'                   => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 30,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled'         => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName'           => storage_path() . '/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel'           => 'FINE',
  ],
];