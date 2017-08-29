<?php

error_reporting(E_ALL & ~(E_NOTICE | E_STRICT));

require './vendor/autoload.php';

// replace with your access token here (optional)
$rollbarToken =  'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

$config = [
    'access_token' => $rollbarToken,
    'environment' => 'local-test',
    'root' => realpath('./'),
    'scrub_fields' => [
        'passwd',
        'password',
        'secret',
        'user_password',
        'confirm_password',
        'password_current',
        'password_new',
        'password_confirm',
        'password_confirmation',
        'security_answer',
        'auth_token',
    ],
    'person_fn' => function() {
        if(isset($_SESSION['user_id'])) {
            return [
                'id' => (string)$_SESSION['user_id']
            ];
        }
        return null;
    },
];

$emptyArr = [];

// rollbar 0.18.2
\Rollbar::init($config);

$startTimeOld = microtime(true);
for($i = 5000; $i > 0; --$i) {
    $emptyArr['jim'];
}
$timeTakenOld = microtime(true) - $startTimeOld;

usleep(500);

// rollbar 1.3.1
\Rollbar\Rollbar::init($config);

$startTimeNew = microtime(true);
for($i = 5000; $i > 0; --$i) {
    $emptyArr['jim'];
}
$timeTakenNew = microtime(true) - $startTimeNew;

echo "\n rollbar v0.18.2: $timeTakenOld \n rollbar  v1.3.1: $timeTakenNew \n\n";
