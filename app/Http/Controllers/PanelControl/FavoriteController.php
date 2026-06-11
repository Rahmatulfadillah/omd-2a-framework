<?php

namespace App\Http\Controllers\PanelControl;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    /**
     * Halaman Favorite Movies
     */
    public function index()
    {
        try {

            // cek login
            if (!session('logged_in')) {
                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Silakan login terlebih dahulu.'
                    );
            }

            $favorites = Favorite::where(
                'user_id',
                session('user_id')
            )
            ->latest()
            ->get();

            return view(
                'controlpanel.my',
                compact('favorites')
            );

        } catch (\Throwable $th) {

            Log::error('Favorite Index Error', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan saat mengambil favorite.'
                );
        }
    }

    /**
     * Tambah Favorite
     */
    public function store(Request $request)
    {
        try {

            // cek login
            if (!session('logged_in')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu.'
                ], 401);
            }

            // cek user_id session
            if (!session('user_id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session user_id tidak ditemukan.',
                    'session' => session()->all()
                ], 400);
            }

            // validasi request
            $validated = $request->validate([
                'imdb_id' => 'required|string',
                'title'   => 'required|string|max:255',
                'year'    => 'nullable|string|max:10',
                'poster'  => 'nullable|string',
                'type'    => 'nullable|string|max:50',
            ]);

            // cek duplicate favorite
            $exists = Favorite::where(
                'user_id',
                session('user_id')
            )
            ->where(
                'imdb_id',
                $validated['imdb_id']
            )
            ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Film sudah ada di favorites!'
                ], 409);
            }

            // simpan favorite
            $favorite = Favorite::create([
                'user_id' => session('user_id'),
                'imdb_id' => $validated['imdb_id'],
                'title'   => $validated['title'],
                'year'    => $validated['year'] ?? null,
                'poster'  => $validated['poster'] ?? null,
                'type'    => $validated['type'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Film berhasil ditambahkan ke favorites!',
                'favorite' => $favorite
            ]);

        } catch (\Throwable $th) {

            Log::error('Favorite Store Error', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            // tampilkan error asli
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ], 500);
        }
    }

    /**
     * Hapus Favorite
     */
    public function destroy($imdbId)
    {
        try {

            // cek login
            if (!session('logged_in')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu.'
                ], 401);
            }

            $deleted = Favorite::where(
                'user_id',
                session('user_id')
            )
            ->where(
                'imdb_id',
                $imdbId
            )
            ->delete();

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Film tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Film berhasil dihapus dari favorites!'
            ]);

        } catch (\Throwable $th) {

            Log::error('Favorite Destroy Error', [
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
            ], 500);
        }
    }
}