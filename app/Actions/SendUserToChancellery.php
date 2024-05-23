<?php

namespace App\Actions;

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

        $body = [
            'CodEvento' => $event_code,
            'CodTitulo' => $title_code,
            'Nombres' => $user['name'],
            'Apellidos' => $user['last_name'],
            'CodGenero' => $gender_code,
            'Nacionalidad' => $user['nationality'],
            'CodTipoDocumento' => $document_type_code,
            'NumDocumento' => $user['document_number'],
            'CodEconomia' => $economy_code,
            'Organizacion' => $user['business'],
            'Cargo' => $user['role'],
            'Correo' => $user['email'],
            // Todo: Completar con el código de tipo de usuario
            'CodCategoria' => '00000020',
            'ArchivoDocumento' => "data:file/{$user['identity_extension']};base64,". base64_encode(file_get_contents(storage_path('app/public/ids/' . $user['identity_document']))),
            'ExtArchivoDocumento' => strtoupper($user['identity_extension']),
            'ArchivoFoto' => "data:image/{$user['badge_extension']};base64,". base64_encode(file_get_contents(storage_path('app/public/badges/' . $user['badge_photo']))),
            'ExtArchivoFoto' => strtoupper($user['badge_extension'])
        ];
        Storage::disk('sends')->put("send-{$user['id']}.json", json_encode($body));
        try {
            $response = Http::withBasicAuth(config('services.sge.user'), config('services.sge.password'))
                ->withOptions(['verify' => false])
                ->withHeaders($body)
                ->get(config('services.sge.url') . "/registro");
            $result = $response->json();
            dd($result);
        } catch (RequestException $exception) {
            $this->error("Error: {$exception->getMessage()}");
        }

    }
}
