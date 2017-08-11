<?php
/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2017/3/3
 * Time: 16:26
 * Email: zhoulin@mapgoo.net
 */

return array(
    'redis'=>[
        'test'=>[
            'web'=>[
                'host' => '192.168.201.60',
                'port' => '4500',
                'select'=>1
            ],
            'user'=>[
                'host' => '192.168.201.60',
                'port' => '4501',
                'select'=>1
            ]
        ],
        'demo'=>[

        ],
        'service'=>[

        ]
    ],
    'mysql'=>[
        'test'=>[
            'host' => '192.168.204.68',
            'port' => '3388',
            'user' => 'optuser',
            'password' => 'optuser123',
            'database' => 'public_web',
            'prefix' => 'web_'
        ],
        'demo'=>[

        ],
        'service'=>[

        ]
    ],
    'cookie'=>[
        'name'=>'BOYYA_PUBLIC_WEB_UID',
        'expire'=>86400*30
    ],
);
