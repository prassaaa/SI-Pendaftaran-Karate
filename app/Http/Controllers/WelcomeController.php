<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\BiayaKategori;
use App\Models\KategoriUsia;
use App\Models\Ranting;

class WelcomeController extends Controller
{
    public function index()
    {
        $data = [
            'biaya_kategori' => BiayaKategori::active()->first(),
            'kategori_usia' => KategoriUsia::all(),
            'total_ranting' => Ranting::count(),
            'app_name' => Setting::get('app_name', 'Karate INKAI Kediri'),
            'event_name' => Setting::get('event_name', 'Kejuaraan Karate INKAI Kediri 2025'),
            'event_date' => Setting::get('event_date', '15-17 Juni 2025'),
            'event_location' => Setting::get('event_location', 'GOR Jayabaya Kediri'),
            'registration_deadline' => Setting::get('registration_deadline', '10 Juni 2025'),
        ];

        return view('welcome', $data);
    }
}
