<?php
return [
    'authorize'  => true,
    'BASE_URL'  => env('APP_BASE_URL'),
    'FLAG_URL'=>env('APP_URL').'public/flag/',

    'oppwa'=>[
        'SANDBOX_MODE'=>FALSE,
        'test'=>[
            'URL'=>[
                'PREPARE-CHECKOUT'=>'https://eu-test.oppwa.com/v1/checkouts',
            ],
            'ACCESS_TOKEN'=>'OGFjN2E0Yzg4MTQ2NzMwMzAxODE0NzkwZTRjYzAyMWZ8WHh3aHB3cUpTNw==',
            // 'ENTITY_ID_MADA'=>'8ac7a4c881467303018147980712023f',
            // 'ENTITY_ID'=>'8ac7a4c881467303018147988b320245',
            'ENTITY_ID'=>'8ac7a4c881467303018147980712023f',
            
            'CURRENCY'=>'SAR'
        ],
        'production'=>[
            'URL'=>[
                'PREPARE-CHECKOUT'=>'https://eu.oppwa.com/v1/checkouts',
            ],
            'ACCESS_TOKEN'=>'',
            'ENTITY_ID_MADA'=>'',
            'ENTITY_ID'=>'',
        ]
    ]
];
