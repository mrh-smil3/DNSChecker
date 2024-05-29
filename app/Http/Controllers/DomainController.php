<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DomainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    // public function checkDomain(Request $request)
    // {
    //     $request->validate([
    //         'domain' => 'required|string'
    //     ]);

    //     $domain = trim($request->input('domain'));

    //     // Ganti dengan kunci API (X-Rapidapi-Key) dan host (X-Rapidapi-Host) Anda
    //     $apiKey = '0c0f25a99dmshae5adb72444a0f1p133670jsnfd4ba7f17fa9';
    //     $apiHost = 'dns-lookup2.p.rapidapi.com';
    //     $apiUrl = "https://$apiHost/Api/a/$domain";

    //     try {
    //         // Panggil API dengan HTTP client
    //         $response = Http::withHeaders([
    //             'x-rapidapi-key' => $apiKey,
    //             'x-rapidapi-host' => $apiHost
    //         ])->get($apiUrl);

    //         // Periksa apakah respons berhasil
    //         if ($response->successful()) {
    //             $data = $response->json();
    //             // Tentukan status berdasarkan respons API
    //             $status = $data['status'] ?? 'unknown';
    //             if ($status === 'active') {
    //                 $result = 'sudah terdaftar';
    //             } else {
    //                 $result = 'tersedia';
    //             }
    //         } else {
    //             // Jika respons tidak berhasil, kembalikan pesan kesalahan
    //             $result = 'unknown';
    //         }

    //         // Tampilkan hasil ke view
    //         return view('welcome', ['fullDomain' => $domain, 'result' => $result]);
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan jika terjadi
    //         return back()->withErrors(['msg' => 'Exception: ' . $e->getMessage()]);
    //     }
    // }

    public function checkDomainAvailability(Request $request)
    {
        // URL endpoint API
        $url = 'https://domain-checker7.p.rapidapi.com/whois';

        try {
            // Lakukan permintaan HTTP ke API
            $response = Http::withHeaders([
                'X-Rapidapi-Key' => '0c0f25a99dmshae5adb72444a0f1p133670jsnfd4ba7f17fa9',
                'X-Rapidapi-Host' => 'domain-checker7.p.rapidapi.com'
                // Tambahkan header lain jika diperlukan
            ])->get($url, [
                'domain' => $request->input('domain') // Ambil domain dari permintaan pengguna
            ]);

            // Periksa apakah permintaan berhasil
            if ($response->successful()) {
                // Dapatkan data JSON dari respons
                $result = $response->json();

                // Periksa ketersediaan domain dalam respons JSON
                if (isset($result['available']) && $result['available'] === true) {
                    return response()->json(['message' => 'Domain tersedia!']);
                } else {
                    return response()->json(['message' => 'Domain tidak tersedia.']);
                }
            } else {
                return response()->json(['error' => 'Gagal melakukan permintaan ke API.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
