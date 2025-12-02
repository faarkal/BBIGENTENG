<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PemesananFactory extends Factory
{
    // The name of the factory's corresponding model.
    protected $model = \App\Models\Pemesanan::class;

    // Define the model's default state.
    public function definition()
    {
        $jenis = $this->faker->randomElement(['Nila Gift', 'Nila Hitam', 'Gurame', 'Tombro', 'Koi']);
        $harga = match ($jenis) {
            'Nila Gift' => 100,
            'Nila Hitam' => 1500,
            'Gurame' => 2500,
            'Tombro' => 3000,
            'Koi' => 500,
            default => 0,
        };

        $jumlah = $this->faker->numberBetween(1, 10);

        return [
            'jenis_bibit' => $jenis,
            'nama_pemesan' => $this->faker->name(),
            'no_Telpon' => $this->faker->numerify('08##########'),
            'jumlah_ikan' => $jumlah,
            'total_harga' => $harga * $jumlah,
            'status' => 'pending',
        ];
    }
}
