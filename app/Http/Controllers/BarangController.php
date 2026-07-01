<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = \Illuminate\Support\Facades\DB::table('barangs')
            ->select('id', 'kode_barang', 'nama_barang', 'kategori', 'stok', 'harga');

        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                // Use lower() and LIKE to utilize the varchar_pattern_ops indexes
                $q->whereRaw('lower(kode_barang) like ?', [$search . '%'])
                  ->orWhereRaw('lower(nama_barang) like ?', [$search . '%']);
            });
        }

        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }

        $sort = $request->input('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('id', 'asc');
                break;
            case 'harga_tinggi':
                $query->orderBy('harga', 'desc');
                break;
            case 'harga_rendah':
                $query->orderBy('harga', 'asc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('id', 'desc');
                break;
        }
        
        $limit = $request->input('limit', 15);

        if ($request->has('page')) {
            $barangs = $query->paginate($limit);
        } else {
            $barangs = $query->cursorPaginate($limit);
        }

        return response()->json($barangs);
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        
        return response()->json([
            'data' => $barang
        ]);
    }
}
