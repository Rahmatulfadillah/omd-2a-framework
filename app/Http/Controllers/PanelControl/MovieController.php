<?php

namespace App\Http\Controllers\PanelControl;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request)
    {
        try {

            $query = trim($request->get('keyword', ''));
            $page  = (int) $request->get('page', 1);

            $defaultResponse = [
                'movies' => [],
                'total'  => 0,
                'error'  => null,
            ];

            if (empty($query)) {

                if ($request->ajax()) {
                    return response()->json($defaultResponse);
                }

                return view('controlpanel.dashboard', $defaultResponse);
            }

            $result = $this->movieService->search($query, $page);

            if (!$result) {

                $errorResponse = [
                    'movies' => [],
                    'total'  => 0,
                    'error'  => 'Gagal menghubungi API, coba lagi.',
                ];

                if ($request->ajax()) {
                    return response()->json($errorResponse, 500);
                }

                return view('controlpanel.dashboard', $errorResponse);
            }

            // AJAX response
            if ($request->ajax()) {
                return response()->json($result);
            }

            return view('controlpanel.dashboard', $result);

        } catch (\Throwable $th) {

            Log::error('Error during movie search', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            $errorResponse = [
                'movies' => [],
                'total'  => 0,
                'error'  => 'Terjadi kesalahan.',
            ];

            if ($request->ajax()) {
                return response()->json($errorResponse, 500);
            }

            return view('controlpanel.dashboard', $errorResponse);
        }
    }

    public function detail($imdbId)
    {
        try {

            $movie = $this->movieService->detail($imdbId);

           
            if (empty($movie)) {
                return redirect()
                    ->back()
                    ->with('error', 'Film tidak ditemukan!');
            }

            return view('controlpanel.detail.detail', compact('movie'));

        } catch (\Throwable $th) {

            Log::error('Error fetching movie detail', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
                'imdb_id' => $imdbId,
            ]);

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan saat mengambil detail film.'
                );
        }
    }
}