<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_barang_list_with_cursor_pagination()
    {
        $user = User::factory()->create();
        Barang::factory()->count(100)->create();

        $response = $this->actingAs($user)->getJson('/api/barang?limit=50');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                             'id', 'kode_barang', 'nama_barang', 'kategori', 'stok', 'harga'
                         ]
                     ],
                     'next_page_url',
                     'prev_page_url'
                 ]);
        
        $this->assertCount(50, $response->json('data'));
    }

    public function test_api_can_search_barang_by_name()
    {
        $user = User::factory()->create();
        
        Barang::factory()->create(['nama_barang' => 'Laptop Asus ROG']);
        Barang::factory()->create(['nama_barang' => 'Mouse Logitech']);

        $response = $this->actingAs($user)->getJson('/api/barang?search=Asus');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('Laptop Asus ROG', $response->json('data.0.nama_barang'));
    }
}
