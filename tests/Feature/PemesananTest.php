<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class PemesananTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pemesanan_store_redirects_to_whatsapp_with_correct_message()
    {
        $data = [
            'jenis_bibit' => 'Nila Gift',
            'nama_pemesan' => 'Budi Santoso',
            'no_Telpon' => '081234567890',
            'jumlah_ikan' => 3,
        ];

        $response = $this->post(route('pemesanan'), $data);

        $response->assertStatus(302);

        $target = $response->getTargetUrl();
        $this->assertStringStartsWith('https://wa.me/', $target);

        // Ensure message contains the submitted values (URL encoded)
        $query = parse_url($target, PHP_URL_QUERY) ?: '';
        $decoded = '';
        if ($query) {
            $parts = explode('=', $query, 2);
            $decoded = isset($parts[1]) ? urldecode($parts[1]) : '';
        }
        $this->assertStringContainsString('Nama: ' . $data['nama_pemesan'], $decoded);
        $this->assertStringContainsString('No. Telp: ' . $data['no_Telpon'], $decoded);
        $this->assertStringContainsString('Jenis Ikan: ' . $data['jenis_bibit'], $decoded);
        $this->assertStringContainsString('Jumlah: ' . $data['jumlah_ikan'], $decoded);

        // Assert the order was persisted in the database
        $this->assertDatabaseHas('pemesanan', [
            'nama_pemesan' => $data['nama_pemesan'],
            'no_Telpon' => $data['no_Telpon'],
            'jenis_bibit' => $data['jenis_bibit'],
            'jumlah_ikan' => $data['jumlah_ikan'],
        ]);
    }

    /** @test */
    public function pemesanan_store_validates_required_fields()
    {
        $response = $this->from(route('pemesanan.form'))->post(route('pemesanan'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['jenis_bibit', 'nama_pemesan', 'no_Telpon', 'jumlah_ikan']);
    }
}
