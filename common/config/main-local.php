<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'ax',
            'password' => '1qaz@WSX',
            'charset' => 'utf8',
        ],
        'mydb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mydb',
            'username' => 'ax',
            'password' => '1qaz@WSX',
            'charset' => 'utf8',
            'tablePrefix' => 'example_',
        ],
        'alienvault_siem' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=alienvault_siem',
            'username' => 'ax',
            'password' => '1qaz@WSX',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
