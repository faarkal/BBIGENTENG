<?php

namespace Database\Factories;

use App\Models\MasterBenih;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitoringFactory extends Factory
{
    public function definition()
    {
        return [
            'tanggal' => now()->toDateString(),
            'master_benih_id' => MasterBenih::factory(),
            'kolam' => 'A1',
            'bibit_awal' => rand(50, 200),
            'ukuran' => '3.5',
            'kematian_bibit' => rand(0, 10),
        ];
    }
}
