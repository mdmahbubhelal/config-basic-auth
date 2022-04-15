# Adds basic auth globally, uses credentials from config
Useful mostly in staging scenarios where you don't want website publicly accessible by everyone.

Default credentials are:
```
username: user0
password: password0
```
```
username: user1
password: password1
```
# Installation
`composer require zero/config-basic-auth --dev`

# Configuration
you can publish config by running:

`php artisan vendor:publish --provider="Zero\ConfigBasicAuth\ConfigBasicAuthServiceProvider" --tag="config"`

that will publish `basicauth.php` file in `config` directory

Basic auth can be disabled by adding `BASICAUTH_ENABLED=false` in .env

You can change the username and password in the users array:
```
'users' => [
    [
        'username' => 'user0',
        'password' => 'password0',
    ],
    [
        'username' => 'user1',
        'password' => 'password1',
    ]
],
```
