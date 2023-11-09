<?php

use Mithra62\MemberList\Services\InputService;
use Mithra62\MemberList\Services\MemberService;

const MEMBER_LIST_VERSION = '1.0.0';

return [
    'name'              => 'Member List',
    'description'       => 'Allows for public listing of Members',
    'version'           => MEMBER_LIST_VERSION,
    'author'            => 'mithra62',
    'author_url'        => 'https://github.com/mithra62',
    'namespace'         => 'Mithra62\MemberList',
    'settings_exist'    => false,
    'services' => [
        'InputService' => function ($addon) {
            return new InputService();
        },
        'MemberService' => function ($addon) {
            return new MemberService();
        },
    ]
];
