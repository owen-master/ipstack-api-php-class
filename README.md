# Ipstack API Class

Ipstack offers one of the leading IP to geolocation APIs and global IP database services worldwide. This unofficial PHP class can be used to easily interact with the Ipstack endpoints.

You can view the official documentation for Ipstack.com at <https://ipstack.com/documentation> and pricing at <https://ipstack.com/product>.

## Installation

Add **class.ipstack.php** to your project folder.

```bash
include_once('./class.ipstack.php');
```

## Usage
Refer to the below example for class usage:
```php
// Include class:
include_once('./class.ipstack.php');

// Specify construct options:
$options = [
    'accessKey' => 'YOUR_ACCESS_KEY_GOES_HERE', // Required
    'flags' => ['debug', 'hostname']
];

// Construct class:
$Ipstack = new Ipstack($options);

// Get info:
var_dump($Ipstack->getInfo('179.70.63.141'));

// Get batch/bulk info (Professional plan required):
$multipleAddresses = [
    '179.70.63.141',
    '206.127.206.9',
    '68.201.6.228'
];

var_dump($Ipstack->getInfo($multipleAddresses));
```

## Flags
| Flag | Description | Note |
| --- | --- | --- |
| `hostname` | Enable Ipstack hostname lookup. | - |
| `security` | Enable Ipstack security module. | Paid plan required, refer to [pricing](https://ipstack.com/product). |
| `https` | Make request to endpoint over HTTPS. | Paid plan required, refer to [pricing](https://ipstack.com/product). |
| `debug` | Return API JSON response on failure instead of `false`. | - |

## License
[MIT](https://choosealicense.com/licenses/mit/)
