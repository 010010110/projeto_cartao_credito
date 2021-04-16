<?php

namespace Middleware\Auth;

use Utils;
use Pecee\Http\Request;

class FuncionarioAuth extends UserAuth
{

    public function handle(Request $request): void
    {
        parent::handle($request);

        if ($_SESSION['tipo'] !== "F") {
            Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
            http_response_code(401);

            exit();
        }
    }

}