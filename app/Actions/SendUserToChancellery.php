<?php

namespace App\Actions;

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Models\Economy;
use App\Models\Param;
use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class SendUserToChancellery {
    use AsAction;

    public function handle(User $user) {
        $event_code = Param::where('group', 'EVENT')->first()->value;
        $title_code = Param::where('id', $user['title'])->first()->value;
        $gender_code = Param::where('id', $user['gender'])->first()->value;
        $document_type_code = Param::where('id', $user['document_type'])->first()->value;
        $economy_code = Economy::where('id', $user['economy'])->first()->sge_code;

        $category_name = null;
        switch ($user['type']) {
            case (Types::VIP->value):
            case (Types::PARTICIPANT->value):
            case (Types::FREE_PASS_PARTICIPANT->value):
                $category_name = 'DELEGATE';
                break;
            case (Types::COMPANION->value):
            case (Types::FREE_PASS_COMPANION->value):
                $category_name = 'ACCOMPANYING PERSON';
                break;
            case (Types::STAFF->value):
            case (Types::FREE_PASS_STAFF->value):
                $category_name = 'STAFFER';
                break;
            case (Types::STAFF_CP->value):
                $category_name = 'STAFF';
                break;
            case (Types::SUPPLIER->value):
                $category_name = 'SUPPLIER';
                break;
            case (Types::PERSONAL_SECURITY->value):
                $category_name = 'PERSONAL SECURITY';
                break;
            case (Types::SECURITY->value):
                $category_name = 'SECURITY';
                break;
            case (Types::LIAISON->value):
                $category_name = 'LIAISON';
                break;
            case (Types::EXHIBITOR->value):
                $category_name = 'EXHIBITOR';
                break;
            default:
                $category_name = 'DELEGATE';
            break;
        }

        $category = Param::where('group', "CATEGORIES")->where('name', $category_name)->first();

        $body = [
            'CodRegistro' => '',
            'CodEvento' => $event_code,
            'CodTitulo' => $title_code,
            'Nombres' => $user['name'],
            'Apellidos' => $user['last_name'],
            'CodGenero' => $gender_code,
            'Nacionalidad' => $user['nationality'],
            'CodTipoDocumento' => $document_type_code,
            'NumDocumento' => "47804236",
            'CodEconomia' => $economy_code,
            'Organizacion' => $user['business'],
            'Cargo' => $user['role'],
            'Correo' => $user['email'],
            'NumContacto' => $user['phone_number'],
            'CodCategoria' => $category['value'],
            'ArchivoDocumento' => "data:file/{$user['identity_extension']};base64,". base64_encode(file_get_contents(storage_path('app/public/ids/' . $user['identity_document']))),
            'ExtArchivoDocumento' => strtoupper($user['identity_extension']),
            'ArchivoFoto' => "data:image/{$user['badge_extension']};base64,". base64_encode(file_get_contents(storage_path('app/public/badges/' . $user['badge_photo']))),
            'ExtArchivoFoto' => strtoupper($user['badge_extension'])
        ];
        dd($body);

        Storage::disk('sends')->put("send-{$user['id']}.json", json_encode($body));
        try {
            $response = Http::withBasicAuth(config('services.sge.user'), config('services.sge.password'))
                ->withOptions(['verify' => false])->asJson()
                ->post(config('services.sge.url') . "/registro", $body);
            $result = $response->json();

            if (isset($result['error'])) {
                $user->update([
                    'chancellery_sent_response' => $result,
                    'status' => Status::ERROR_IN_CHANCELLERY->value
                ]);
            }

            if (isset($result['codRegistro'])) {
                $user->update([
                    'chancellery_code' => $result['codRegistro'],
                    'chancellery_sent_response' => $result,
                    'status' => Status::SEND_TO_CHANCELLERY->value
                ]);
            }

        } catch (RequestException $exception) {
            $this->error("Error: {$exception->getMessage()}");
        }

    }
}
