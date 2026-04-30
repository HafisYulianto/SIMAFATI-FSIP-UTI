<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        // BAAK Super Admin
        $baak = User::create([
            'name' => 'Admin BAAK',
            'email' => 'baak@teknokrat.ac.id',
            'password' => bcrypt('password'),
            'nip' => '198001012000121001',
            'is_active' => true,
        ]);
        $baak->assignRole('BAAK');

        // Pimpinan
        $pimpinan = User::create([
            'name' => 'Dekan FSIP',
            'email' => 'pimpinan@teknokrat.ac.id',
            'password' => bcrypt('password'),
            'nip' => '197501012000121002',
            'is_active' => true,
        ]);
        $pimpinan->assignRole('Pimpinan');

        // Kaprodi sample
        $kaprodi = User::create([
            'name' => 'Kaprodi PBI',
            'email' => 'kaprodi.pbi@teknokrat.ac.id',
            'password' => bcrypt('password'),
            'nip' => '199001012020121003',
            'program_studi_id' => 1,
            'is_active' => true,
        ]);
        $kaprodi->assignRole('Kaprodi');

        // Dosen sample
        $dosen = User::create([
            'name' => 'Dr. Ahmad Fauzi',
            'email' => 'dosen@teknokrat.ac.id',
            'password' => bcrypt('password'),
            'nip' => '199201012021121004',
            'program_studi_id' => 1,
            'is_active' => true,
        ]);
        $dosen->assignRole('Dosen');
    }
}
