<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sejarah;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sejarah::create([
            'judul' => 'Sejarah Balai Usaha Perikanan Genteng',
            'isi' => 'Balai Usaha Perikanan Genteng didirikan sebagai upaya untuk mengembangkan sektor perikanan budidaya di wilayah Genteng. Sejak berdirinya, balai ini berfokus pada pembenihan dan pengelolaan sumber daya ikan untuk mendukung kesejahteraan masyarakat sekitar.',
        ]);
    }
}
