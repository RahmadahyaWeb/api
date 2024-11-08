<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Sync extends Model
{
    use HasFactory;

    public function login()
    {
        try {
            $response = Http::timeout(60)->asForm()->post('http://36.91.145.235/kcpapi/auth/login', [
                'username' => config('api.username'),
                'password' => config('api.password'),
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function syncTable($token)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
        ])
            ->timeout(0)  // Timeout set ke 0 untuk menonaktifkan timeout (tidak ada batas waktu)
            ->get('36.91.145.235/kcpapi/api/table');

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }
}
