<?php

namespace App\Actions;

use App\Concerns\Enums\Status;
use App\Models\Param;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class Webhook {
    use AsAction;

    public function handle(Request $request) {
        if ($request->hasHeader('php-auth-user') && $request->hasHeader('php-auth-pw')) {
            if ($request->header('php-auth-user') === "sge" && $request->header('php-auth-pw') === "1a2b3c4f5d") {
                $data = $request->all();
                if (isset($data['CodRegistro'])) {
                    $user = User::where('chancellery_code', $data['CodRegistro'])->first();
                    if ($user) {
                        Storage::disk('sends')->put("received-{$user['id']}.json", json_encode($data));
                        $user->update(['chancellery_receive_response' => $data]);
                        if (isset($data['CodEstado'])) {
                            $param = Param::where('group', 'STATUS')->where('value', $data['CodEstado'])->first();
                            if ($param) {
                                if ($param['name'] === 'Approved') {
                                    $user->update(['status' => Status::PENDING_ACCREDITATION->value]);
                                }

                                if ($param['name'] === 'Observed') {
                                    $user->update(['status' => Status::OBSERVED_ACCREDITATION->value]);
                                }

                                if ($param['name'] === 'Canceled') {
                                    $user->update(['status' => Status::CANCEL_ACCREDITATION->value]);
                                }
                            }
                        }
                    }
                }
                return response()->json($request->all());
            } else {
                abort(401, 'Unauthorized');
            }
        } else {
            abort(401, 'Unauthorized');
        }
    }
}
