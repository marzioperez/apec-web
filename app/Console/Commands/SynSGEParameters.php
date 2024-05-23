<?php

namespace App\Console\Commands;

use App\Models\Economy;
use App\Models\Param;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SynSGEParameters extends Command {
    protected $signature = 'sync:sge-parameters';

    protected $description = 'Comando para sincronizar los parámetros del SGE';

    public function base_request($param, $group, $headers = []) {
        $this->info("\nSincronizando grupo: {$group}");
        try {
            $response = Http::withBasicAuth(config('services.sge.user'), config('services.sge.password'))
                ->withOptions(['verify' => false])
                ->withHeaders($headers)
                ->get(config('services.sge.url') . "/{$param}");
            $result = $response->json();
            if ($result) {
                if (count($result['data']) > 0) {
                    $progress_bar = $this->output->createProgressBar(count($result['data']));
                    foreach ($result['data'] as $item) {
                        Param::create([
                            'group' => $group,
                            'name' => $item['nombre'],
                            'value' => $item['codigo']
                        ]);
                        $progress_bar->advance();
                    }
                    $progress_bar->finish();
                }
            }
        } catch (RequestException $exception) {
            $this->error("Error: {$exception->getMessage()}");
        }
    }

    public function economies($headers) {
        $this->info("\nSincronizando economías");
        try {
            $response = Http::withBasicAuth(config('services.sge.user'), config('services.sge.password'))
                ->withOptions(['verify' => false])
                ->withHeaders($headers)
                ->get(config('services.sge.url') . "/economia");
            $result = $response->json();
            if ($result) {
                if (count($result['data']) > 0) {
                    $progress_bar = $this->output->createProgressBar(count($result['data']));
                    foreach ($result['data'] as $item) {
                        Economy::create([
                            'name' => $item['nombre'],
                            'sge_code' => $item['codigo']
                        ]);
                        $progress_bar->advance();
                    }
                    $progress_bar->finish();
                }
            }
        } catch (RequestException $exception) {
            $this->error("Error: {$exception->getMessage()}");
        }
    }

    public function handle() {
        $this->base_request('evento', 'EVENT');
        $event_code = Param::where('group', 'EVENT')->first()->value;
        $this->base_request('titulo', 'TITLES', ['CodEvento' => $event_code]);
        $this->base_request('genero', 'GENDERS', ['CodEvento' => $event_code]);
        $this->base_request('tipodocumento', 'DOCUMENTS', ['CodEvento' => $event_code]);
        $this->base_request('categoria', 'CATEGORIES', ['CodEvento' => $event_code]);
        $this->economies(['CodEvento' => $event_code]);
    }
}
