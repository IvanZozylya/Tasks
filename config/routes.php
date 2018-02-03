<?php

return array(


    'signin'=>'user/signIn',
    'logOut'=>'user/logout',

    'task/edit/([0-9]+)'=>'site/edit/$1',
    'task/details/([0-9]+)'=>'site/details/$1',
    'task/create'=>'site/create',


    "page-([0-9]+)" => 'site/index/$1',

    '' => 'site/index',

);