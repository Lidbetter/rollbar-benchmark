<?php

error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_STRICT));

require './vendor/autoload.php';

$config = [
    'access_token' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
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

// rollbar 0.18.2
\Rollbar::init($config);
\Rollbar::$instance = new RollbarOldNoNetworkNotifier($config);

Util::printNl('Rollbar Version: '.RollbarNotifier::VERSION);
Util::printNl('undefinedIndex: ' . Util::timedRun(Tests::undefinedIndex()));
Util::printNl('errorTriggered: ' . Util::timedRun(Tests::errorTriggered()));
Util::printNl('reportException: ' . Util::timedRun(Tests::reportExceptionOld()));
Util::printNl();

// rollbar 1.3.1
\Rollbar\Rollbar::init(array_merge($config, ['sender' => new RollbarNewNullSender()]));

Util::printNl('Rollbar Version: latest (>= 1.3.1)');
Util::printNl('undefinedIndex: ' . Util::timedRun(Tests::undefinedIndex()));
Util::printNl('errorTriggered: ' . Util::timedRun(Tests::errorTriggered()));
Util::printNl('reportException: ' . Util::timedRun(Tests::reportExceptionNew()));
Util::printNl();
