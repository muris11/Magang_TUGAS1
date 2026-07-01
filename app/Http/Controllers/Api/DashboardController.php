<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = \Illuminate\Support\Facades\Cache::remember('total_barang_count', 300, function () {
            return Barang::count();
        });
        
        $totalUser = \Illuminate\Support\Facades\Cache::remember('total_user_count', 300, function () {
            return User::count();
        });
        
        try {
            DB::connection()->getPdo();
            $dbStatus = 'Connected';
        } catch (\Exception $e) {
            $dbStatus = 'Disconnected';
        }

        $serverStatus = 'Online';

        return response()->json([
            'data' => [
                'total_barang' => $totalBarang,
                'total_user' => $totalUser,
                'server_status' => $serverStatus,
                'database_status' => $dbStatus
            ]
        ]);
    }
}
