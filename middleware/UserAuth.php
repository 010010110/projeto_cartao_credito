<?php

namespace Middleware\Auth;

use Utils;
use Pecee\Http\Request;
use Pecee\Http\Middleware\IMiddleware;

class UserAuth implements IMiddleware
{

    public function handle(Request $request): void
    {
        session_start();

        if (empty($_SESSION['login']) || !$_SESSION['login']) {
            Utils::json(['message' => "Usuário não autenticado", 'error' => true]);
            http_response_code(401);

            session_unset();
            session_abort();
            session_write_close();

            header_remove('Set-Cookie');

            exit();
        }
    }

}

