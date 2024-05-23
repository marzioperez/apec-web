<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class Webhook {
    use AsAction;

    public function handle(Request $request) {
        if ($request->hasHeader('php-auth-user') && $request->hasHeader('php-auth-pw')) {
            if ($request->header('php-auth-user') === "sge" && $request->header('php-auth-pw') === "1a2b3c4f5d") {
                return response()->json($request->all());
            } else {
                abort(401, 'Unauthorized');
            }
        } else {
            abort(401, 'Unauthorized');
        }
    }
}
