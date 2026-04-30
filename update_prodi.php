<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pbi = App\Models\ProgramStudi::where('code', 'PBI')->first();
if ($pbi) {
    $pbi->name = 'S1 Pendidikan Bahasa Inggris';
    $pbi->save();
}

$si = App\Models\ProgramStudi::where('code', 'SI')->first();
if ($si) {
    $si->name = 'S1 Sastra Inggris';
    $si->save();
}

$por = App\Models\ProgramStudi::where('code', 'POR')->first();
if ($por) {
    $por->name = 'S1 Pendidikan Olahraga';
    $por->save();
}

$pm = App\Models\ProgramStudi::where('code', 'PM')->first();
if ($pm) {
    $pm->name = 'S1 Pendidikan Matematika';
    $pm->save();
}

$pbind = App\Models\ProgramStudi::where('code', 'PBIND')->first();
if ($pbind) {
    $pbind->delete();
}

echo 'Done.';
