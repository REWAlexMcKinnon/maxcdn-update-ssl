# Basic MaxCDN PHP Script

This is just a basic script to use the MaxCDN API to update an existing certificate.

## Setup
1. Clone this repo
2. Run `composer init`
3. Copy .env.example to .env
4. Add your MaxCDN API credentials to .env
5. Add your certificate files to certificates/
6. Edit the certificate details in bin/update.php 
7. Update id and common name for certificate
8. Update paths to certificate files as needed
```
// Certificate details
$id = 12345;
$domainName = 'example.com';
$privateKey = file_get_contents(__DIR__ . '../certificates/example.key');
$certificate = file_get_contents(__DIR__ . '../certificates/example.cert');
$caBundle = file_get_contents(__DIR__ . '../certificates/example.fullchain.cert');
```
## Usage
Once you're all set up, run the following to execute the script:
```
php bin/update.php
```



