<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\MasterBenih;
use App\Models\Monitoring;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MonitoringTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    #[Test]
    public function melihat_monitoring()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.monitoring.index'));

        $response->assertStatus(200);
    }

    #[Test]
    public function menginput_data_monitoring()
    {

        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $benih = MasterBenih::factory()->create();

        $data = [
            'tanggal' => now()->toDateString(),
            'master_benih_id' => $benih->id,
            'kolam' => 'A1',
            'bibit_awal' => 100,
        ];

        $response = $this->post(route('admin.monitoring.store'), $data);

        $this->assertDatabaseHas('monitoring', [
            'kolam' => 'A1',
            'bibit_awal' => 100,
        ]);

        $response->assertRedirect();
    }

    #[Test]
    public function memonitoring_data_mingguan()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $benih = MasterBenih::factory()->create();
        $monitoring = Monitoring::factory()->create([
            'master_benih_id' => $benih->id,
            'kolam' => 'B2',
        ]);

        $data = [
            'tanggal' => now()->toDateString(),
            'master_benih_id' => $benih->id,
            'kolam' => 'B2',
            'bibit_awal' => 200,
            'ukuran' => '3.5',
            'kematian_bibit' => 10,
        ];

        $response = $this->put(route('admin.monitoring.update', $monitoring->id), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('monitoring', [
            'id' => $monitoring->id,
            'kolam' => 'B2',
            'bibit_awal' => 200,
        ]);
    }

    #[Test]
    public function menghapus_data_monitoring()
    {
        $user = User::factory()->create();
        $benih = MasterBenih::factory()->create();
        $monitoring = Monitoring::factory()->create([
            'master_benih_id' => $benih->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('admin.monitoring.destroy', $monitoring->id));

        $response->assertRedirect(route('admin.monitoring.index'));

        $this->assertDatabaseMissing('monitoring', [
            'id' => $monitoring->id,
        ]);
    }
}
