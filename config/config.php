<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /* Secret manager */
    'secret_manager' => 'aws',

    /* AWS credentials */
    'aws_key' => env('AWS_ACCESS_KEY_ID'),
    'aws_secret' => env('AWS_SECRET_ACCESS_KEY'),
    'aws_secret_region' => env('AWS_SECRET_REGION'),

    /* Environments that you would be saving the envs to */
    'environments' => [
        'local',
        'qa',
        'production'
    ],

    /* suffix appended to .env when generating the new file eg. .env.sync */
    'env-suffix' => 'sync',
];
