<?php

  class Ipstack {

    /**
    * User's Ipstack access key.
    *
    * @var string
    */
    private $accessKey;

    /**
    * Ipstack API base URL.
    *
    * @var string
    */
    private $endpoint = 'api.ipstack.com/';

    /**
    * Enable Ipstack hostname module/addon.
    *
    * @var boolean
    */
    private $addonHostname;

    /**
    * Enable Ipstack security module/addon.
    *
    * @var boolean
    */
    private $addonSecurity;

    /**
    * Enable debugging. Instead of false being returned on an error, Ipstack
    * JSON response will be returned.
    *
    * @var boolean
    */
    private $debug;

    /**
    * Class constructor.
    * @param array $args Class arguments.
    */
    public function __construct($args = []) {

      if (isset($args['accessKey'])) {
        $this->accessKey = $args['accessKey'];
      }

      if (isset($args['flags']) && is_array($args['flags'])) {
        if (in_array('https', $args['flags'])) {
          $this->endpoint = 'https://'.$this->endpoint;
        }

        if (in_array('hostname', $args['flags'])) {
          $this->addonHostname = true;
        }

        if (in_array('security', $args['flags'])) {
          $this->addonSecurity = true;
        }

        if (in_array('debug', $args['flags'])) {
          $this->debug = true;
        }
      }
    }

    /**
    * Gets info on a single IP or an array of IP addresses.
    * @param string $ip Returns info on a single IP address.
    * @param array $ip Returns info on an array of IP addresses.
    */
    public function getInfo($ip = false) {

      if (!$ip) {
        return false;
      }

      $requestUrl = '';
      $ipString = (is_array($ip)) ? implode(",", array_slice($ip, 0, 50)) : $ip;

      $requestUrl = $this->endpoint.$ipString.'?access_key='.$this->accessKey;

      if ($this->addonSecurity) {
        $requestUrl .= '&security=1';
      }

      if ($this->addonHostname) {
        $requestUrl .= '&hostname=1';
      }

      try {
        $curl = curl_init($requestUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if (isset($result['success']) && !$result['success']) {
          return ($this->debug) ? $result : false;
        }

        return $result;
      } catch (Exception $e) {
        return false;
      }
    }
  }

?>
