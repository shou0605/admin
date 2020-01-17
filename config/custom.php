<?php
return [
    // +----------------------------------------------------------------------
    // | 自定义配置
    // +----------------------------------------------------------------------
    /* 当前应用环境 */
    'app_env'                => Env::get('app_env', 'local'),

    //数据加密KEY
    'data_secret_key'        => 'k+_b}yC2Hx~:uZ/O=a9g-0{6^B|LhfwFlG@I?1MY',

    //密钥
    'rsa_private_key'        => '',
    'rsa_public_key'         => '',
    'client_private_key'     => '',
    'client_public_key'      => '',
];