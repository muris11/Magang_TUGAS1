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
            'p' => $request->input('page', 1),
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
            if ($hasFilters) {
                switch ($sort) {
                    case 'terlama': $query->orderByRaw('id + 0 ASC'); break;
                    case 'harga_tinggi': $query->orderByRaw('harga + 0 DESC'); break;
                    case 'harga_rendah': $query->orderByRaw('harga + 0 ASC'); break;
                    case 'nama_asc': $query->orderByRaw("nama_barang || '' ASC"); break;
                    case 'nama_desc': $query->orderByRaw("nama_barang || '' DESC"); break;
                    case 'kategori_asc': $query->orderByRaw("kategori || '' ASC"); break;
                    case 'kategori_desc': $query->orderByRaw("kategori || '' DESC"); break;
                    case 'stok_asc': $query->orderByRaw('stok + 0 ASC'); break;
                    case 'stok_desc': $query->orderByRaw('stok + 0 DESC'); break;
                    case 'terbaru':
                    default: $query->orderByRaw('id + 0 DESC'); break;
                }
            } else {
                switch ($sort) {
                    case 'terlama': $query->orderBy('id', 'asc'); break;
                    case 'harga_tinggi': $query->orderBy('harga', 'desc')->orderBy('id', 'desc'); break;
                    case 'harga_rendah': $query->orderBy('harga', 'asc')->orderBy('id', 'asc'); break;
                    case 'nama_asc': $query->orderBy('nama_barang', 'asc')->orderBy('id', 'asc'); break;
                    case 'nama_desc': $query->orderBy('nama_barang', 'desc')->orderBy('id', 'desc'); break;
                    case 'kategori_asc': $query->orderBy('kategori', 'asc')->orderBy('id', 'asc'); break;
                    case 'kategori_desc': $query->orderBy('kategori', 'desc')->orderBy('id', 'desc'); break;
                    case 'stok_asc': $query->orderBy('stok', 'asc')->orderBy('id', 'asc'); break;
                    case 'stok_desc': $query->orderBy('stok', 'desc')->orderBy('id', 'desc'); break;
                    case 'terbaru':
                    default: $query->orderBy('id', 'desc'); break;
                }
            }

            $limit = (int) $request->input('limit', 15);
            $page = (int) $request->input('page', 1);

            $total = \Illuminate\Support\Facades\Cache::remember(md5($query->toSql() . implode('', $query->getBindings())) . '_count', 3600, function() use ($query) {
                $sql = $query->toSql();
                $bindings = $query->getBindings();
                try {
                    $explain = \Illuminate\Support\Facades\DB::select("EXPLAIN $sql", $bindings);
                    if (preg_match('/rows=(\d+)/', $explain[0]->{"QUERY PLAN"}, $matches)) {
                        return (int) $matches[1];
                    }
                } catch (\Exception $e) {
                    // fallback to standard count
                }
                return $query->count();
            });

            $offset = ($page - 1) * $limit;
            $ids = (clone $query)->select('id')->offset($offset)->limit($limit)->pluck('id')->toArray();

            if (!empty($ids)) {
                $models = \Illuminate\Support\Facades\DB::table('barangs')->whereIn('id', $ids)->get()->keyBy('id');
                // Ensure order is preserved
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
