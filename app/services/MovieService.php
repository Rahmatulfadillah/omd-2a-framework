<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{
    protected $apiKey;
    protected $baseUrl;


    public function __construct()
    {
        $this->apiKey = config('services.omdb.api_key');
        $this->baseUrl = config('services.omdb.base_url');
    }

  
    public function search($query, $page = 1)
    {
        try {

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->get($this->baseUrl, [
                    'apikey' => $this->apiKey,
                    's'       => trim($query),
                    'page'    => $page,
                    'type'    => 'movie',
                ]);

            $data = $response->json();

            Log::info('OMDB Search Response', [
                'query' => $query,
                'response' => $data,
            ]);

            if (!$response->successful()) {

                return [
                    'movies' => [],
                    'total'  => 0,
                    'error'  => 'Gagal menghubungi server OMDb.',
                ];
            }

            if (
                isset($data['Response']) &&
                $data['Response'] === 'True'
            ) {

                return [
                    'movies' => $data['Search'] ?? [],
                    'total'  => (int) ($data['totalResults'] ?? 0),
                    'error'  => null,
                ];
            }

            return [
                'movies' => [],
                'total'  => 0,
                'error'  => $data['Error'] ?? 'Film tidak ditemukan.',
            ];

        } catch (\Throwable $th) {

            Log::error('OMDB Search Error', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            return [
                'movies' => [],
                'total'  => 0,
                'error'  => $th->getMessage(),
            ];
        }
    }

    public function detail($imdbId)
    {
        try {

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->get($this->baseUrl, [
                    'apikey' => $this->apiKey,
                    'i'       => $imdbId,
                    'plot'    => 'full',
                ]);

            $data = $response->json();

            // Debug log
            Log::info('OMDB Detail Response', [
                'imdb_id' => $imdbId,
                'response' => $data,
            ]);

            if (
                isset($data['Response']) &&
                $data['Response'] === 'True'
            ) {
                return $data;
            }

            return false;

        } catch (\Throwable $th) {

            Log::error('OMDB Detail Error', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            return false;
        }
    }
}