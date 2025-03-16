<?php

return [  

    'ROLE_ADMIN' => 1,
    'ROLE_USER' => 2,
    'ROLE_ADMIN_TEXT' => 'Admin',
    'ROLE_USER_TEXT' => 'User',

    'SUPER_ADMIN_PASSWORD' => 'Admin@123',
    'USER_PASSWORD' => 'User@123',

    'STATUS_INACTIVE'=>0,
    'STATUS_ACTIVE'=>1,
    'STATUS_INACTIVE_TEXT'=>'Inactive',
    'STATUS_ACTIVE_TEXT'=>'Active',

    'FIREBASE_URL'=> env('FIREBASE_URL'),
    'FIREBASE_FCM_KEY'=> env('FIREBASE_FCM_KEY'),

];