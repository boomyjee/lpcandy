<?

$config = array(
    'invites_enabled' => false,
    'domain' => [
        'ru_RU' =>'lpcandy.ru',
        'en_EN' =>'en.lpcandy.ru',
    ],
    'acl' => [
        'project_editor_group' => [
            'users' => [1,2,4,11,80,55, 158, 156, 214],
            'res' => ['project_editor']
        ]
    ],
    'smtp' => [
        'host' => 'localhost',
        'port' => '25',
        'username' => '',
        'password' => ''
    ]
);