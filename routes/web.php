<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalliperController;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::post('/data',[CalliperController::class,'calliperData'])->name('calliper.data');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/test-rembg', function () {
    $input = 'C:\Users\Arbin\Desktop\exclusive_calliper\public\misc\certificate\nepa-rudraksha\beads\1742302699.jpg';
    $output = 'C:\Users\Arbin\Desktop\exclusive_calliper\public\misc\certificate\nepa-rudraksha\beads\test-output.png';
    $input = str_replace('\\', '/', $input);
$output = str_replace('\\', '/', $output);

    // Check if the input file exists
    if (!file_exists($input)) {
        return response()->json(['error' => 'Input file does not exist.'], 404);
    }

    // Check if the output directory is writable
    $outputDir = dirname($output);
    if (!is_writable($outputDir)) {
        return response()->json(['error' => 'Output directory is not writable.'], 500);
    }


    $rembgPath = 'C:\Users\Arbin\AppData\Local\Programs\Python\Python313\Scripts\rembg.exe'; 
    $rembgPath = str_replace('\\', '/', $rembgPath);// Update as per your output
    $cmd = "\"{$rembgPath}\" i \"{$input}\" \"{$output}\"";

    $result = shell_exec($cmd);
    Log::info("Command: " . $cmd);
Log::info("Output: " . $output);


    return response()->json([
        'cmd' => $cmd,
        'output' => $result,
        'exists' => file_exists($output)
    ]);
});
