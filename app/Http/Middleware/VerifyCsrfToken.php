<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 要排除的URl
     * @var array
     */
    protected $except = [
        '*/upload*',
        'wechat',
        '*/sort_list_tree',
        '*/sort_tree_grid',
        '*/u_sort_list_tree*',
        '*/u_sort_tree_grid*',
        '*/asyn/*',
    ];
}
