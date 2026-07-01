<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $key = 'barang:' . md5(json_encode([
            's' => $request->input('search'),
            'k' => $request->input('kategori'),
            'o' => $request->input('sort', 'terbaru'),
            'l' => $request->input('limit', 15),
            'c' => $request->input('cursor'),
            'p' => $request->input('page'),
        ]));

        $payload = \Illuminate\Support\Facades\Cache::remember($key, 60, function () use ($request) {
            $query = \Illuminate\Support\Facades\DB::table('barangs');
            $hasFilters = false;

            if ($request->has('search') && !empty($request->search)) {
                $search = strtolower($request->search);
                $query->where(function($q) use ($search) {
                    $q->whereRaw('lower(kode_barang) like ?', [$search . '%'])
                      ->orWhereRaw('lower(nama_barang) like ?', [$search . '%'])
                      ->orWhereRaw('lower(kategori) like ?', [$search . '%']);
                });
                $hasFilters = true;
            }

            if ($request->has('kategori') && !empty($request->kategori)) {
                $query->where('kategori', $request->kategori);
                $hasFilters = true;
            }

            $sort = $request->input('sort', 'terbaru');
            switch ($sort) {
                case 'terlama': $query->orderBy('id', 'asc'); break;
                case 'harga_tinggi': $query->orderBy('harga', 'desc'); break;
                case 'harga_rendah': $query->orderBy('harga', 'asc'); break;
                case 'nama_asc': $query->orderBy('nama_barang', 'asc'); break;
                case 'nama_desc': $query->orderBy('nama_barang', 'desc'); break;
                case 'kategori_asc': $query->orderBy('kategori', 'asc'); break;
                case 'kategori_desc': $query->orderBy('kategori', 'desc'); break;
                case 'stok_asc': $query->orderBy('stok', 'asc'); break;
                case 'stok_desc': $query->orderBy('stok', 'desc'); break;
                case 'terbaru':
                default: $query->orderBy('id', 'desc'); break;
            }

            $limit = (int) $request->input('limit', 15);

            if ($request->has('page')) {
                $page = (int) $request->input('page', 1);

                if (!$hasFilters) {
                    $total = \Illuminate\Support\Facades\Cache::remember('barangs_total_count', 3600, function() {
                        return (int) \Illuminate\Support\Facades\DB::select("SELECT reltuples::bigint AS estimate FROM pg_class WHERE relname = 'barangs'")[0]->estimate;
                    });
                } else {
                    $total = $query->count();
                }

                $offset = ($page - 1) * $limit;
                $ids = (clone $query)->select('id')->offset($offset)->limit($limit)->pluck('id')->toArray();

                if (!empty($ids)) {
                    $models = \Illuminate\Support\Facades\DB::table('barangs')->whereIn('id', $ids)->get()->keyBy('id');
                    $items = collect($ids)->map(function($id) use ($models) {
                        return $models[$id];
                    });
                } else {
                    $items = collect();
                }

                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $items, 
                    $total, 
                    $limit, 
                    $page, 
                    ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), 'pageName' => 'page']
                );
            } else {
                $query->select('id', 'kode_barang', 'nama_barang', 'kategori', 'stok', 'harga');
                $paginator = $query->cursorPaginate($limit);
            }

            return $paginator->toArray();
        });

        return response()->json($payload);
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        
        return response()->json([
            'data' => $barang
        ]);
    }
}
