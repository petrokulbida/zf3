<?php
return [
    'view_manager' => [
        'editor' => 'sublime',
        'display_not_found_reason' => true,
        'display_exceptions' => false,
        'json_exceptions' => [
            'display' => true,
            'ajax_only' => true,
            'show_trace' => true
        ],
        'whoops_no_catch' => [
            'BjyAuthorize\Exception\UnAuthorizedException'
        ]
    ]
];
