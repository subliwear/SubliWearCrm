<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/json/upload',
        '/json/project',
        '/json/message',
        '/json/code',
        '/json/ordercode',
        '/json/order',
        '/json/magic-upload-with-preview'
    ];
}
