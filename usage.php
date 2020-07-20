<?php
  // Include class:
  include_once('./class.ipstack.php');

  // Specify construct options:
  $options = [
    'accessKey' => 'YOUR_KEY_GOES_HERE', // Required
    'flags' => ['debug', 'hostname']
  ];

  // Construct class:
  $Ipstack = new Ipstack($options);

  // Get info:
  var_dump($Ipstack->getInfo('179.70.63.141'));

  // Get batch/bulk info (Paid plan may be required!):
  $multipleAddresses = [
    '179.70.63.141',
    '206.127.206.9',
    '68.201.6.228'
  ];

  var_dump($Ipstack->getInfo($multipleAddresses));

?>
