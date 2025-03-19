<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use RuntimeException;

class CalliperController extends Controller
{
    public function calliperData(Request $request)
    {
        $request->validate([
            'size' => 'required|string'
        ]);

        $imagePath = '';
        if ($request->hasFile('bead_image')) {
            $image = $request->file('bead_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('misc/certificate/nepa-rudraksha/beads'), $imageName);

            $imagePath = url('misc/certificate/nepa-rudraksha/beads/' . $imageName);
            $imageRawPath = public_path('misc/certificate/nepa-rudraksha/beads/' . $imageName);
            $outputFilePath = $this->execute($imageRawPath);
        }

        $numberString = $request->size;
        list($beforeDot, $afterDot) = array_pad(explode('.', $numberString), 2, 0);

        $beforeDot = intval($beforeDot);
        $afterDot = intval(substr($afterDot, 0, 1));
        $moveRight = $beforeDot * 9.5;
        if($beforeDot == 1 || $beforeDot == 01){
            $beadScale = 0.1;
            $beadMovement = 55;
        }
        else if($beforeDot>=5 && $beforeDot<=9){
            $beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $beadMovement = 60 + ($beforeDot - 1) * -5.8;
        }
        else if($beforeDot>=15 && $beforeDot<=25){
            $beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $beadMovement = 75 + ($beforeDot - 1) * -5.8;
        }
        else if($beforeDot>=26){
            $beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $beadMovement = 85 + ($beforeDot - 1) * -5.8;
        }
        else{

        $beadScale = 0.1 + ($beforeDot - 1) * 0.064;
        $beadMovement = 65 + ($beforeDot - 1) * -5.8;
        }
        $digits = array_map('intval', str_split(str_replace('.', '', $numberString)));
        $matchedUrls = $this->numberAssign($digits);

        $finalRightPosition = 720 - $moveRight;
        return view('welcome', compact('matchedUrls', 'finalRightPosition', 'outputFilePath', 'beadMovement', 'beadScale'));
    }

    public function numberAssign($digits)
    {
        $urls = [
            0 => url('misc/certificate/nepa-rudraksha/length/0.png'),
            1 => url('misc/certificate/nepa-rudraksha/length/1.png'),
            2 => url('misc/certificate/nepa-rudraksha/length/2.png'),
            3 => url('misc/certificate/nepa-rudraksha/length/3.png'),
            4 => url('misc/certificate/nepa-rudraksha/length/4.png'),
            5 => url('misc/certificate/nepa-rudraksha/length/5.png'),
            6 => url('misc/certificate/nepa-rudraksha/length/6.png'),
            7 => url('misc/certificate/nepa-rudraksha/length/7.png'),
            8 => url('misc/certificate/nepa-rudraksha/length/8.png'),
            9 => url('misc/certificate/nepa-rudraksha/length/9.png')
        ];

        return array_map(fn($digit) => $urls[$digit] ?? null, $digits);
    }

    // public function execute(string $imagePath): string
    // {
    //     if (!file_exists($imagePath)) {
    //         throw new RuntimeException('Image file does not exist.');
    //     }
    
    //     Log::info("Processing image: {$imagePath}");
    
    //     // Ensure paths use forward slashes for Python compatibility
    //     $imagePath = str_replace('\\', '/', $imagePath);
    //     $outputDir = storage_path("app/public/rembg/" . time() . "_" . Str::random(6));
    
    //     // Create output directory if it doesn't exist
    //     if (!File::exists($outputDir)) {
    //         File::makeDirectory($outputDir, 0755, true);
    //     }
    
    //     // Define output file path
    //     $fileName = pathinfo($imagePath, PATHINFO_FILENAME) . ".png";
    //     $outputFilePath = "{$outputDir}/{$fileName}";
    //     $outputFilePath = str_replace('\\', '/', $outputFilePath);
    
    //     // Python command with rembg.cli

    //     $command = "\"C:/Users/Arbin/AppData/Local/Programs/Python/Python313/python.exe\" -m rembg.cli i \"{$imagePath}\" \"{$outputFilePath}\" 2>&1";

        
    
    //     Log::info("Executing Command: {$command}");
    
    //     // Execute the command
    //     $output = [];
    //     $returnVar = null;
    //     exec($command, $output, $returnVar);
    
    //     // Log command output
    //     Log::info('Command Output: ' . implode("\n", $output));
    //     Log::info('Return Code: ' . $returnVar);
    
    //     // Check if the output file was successfully created
    //     if (!file_exists($outputFilePath)) {
    //         Log::error("Failed to remove background. File not created.");
    //         throw new RuntimeException("Failed to remove background. Error: " . implode("\n", $output));
    //     }
    
    //     return str_replace(storage_path("app/public"), asset("storage"), $outputFilePath);
    // }
    public function execute(string $imagePath, ?string $outputPath = null): string
    {

        $imagePath = str_replace('\\', '/', $imagePath);
        $fileName = pathinfo($imagePath, PATHINFO_FILENAME);

        $outputPath ??= pathinfo($imagePath, PATHINFO_DIRNAME);
        $outputPath = str_replace('\\', '/', $outputPath);
               if (!File::exists($outputPath)) {
            File::makeDirectory($outputPath, 0755, true);
     }

        $outputFilePath = $outputPath . '/' . $fileName . '-trimmed.png';
        $imagePathAbsolute = url('misc/certificate/nepa-rudraksha/beads/' . $fileName.'-trimmed.png');
        $outputFilePath = str_replace('\\', '/', $outputFilePath);
        $imagePath = str_replace('\\', '/', $imagePath);
        // for windows server
        // $convertPath = 'C:/Program Files/ImageMagick-7.1.1-Q16-HDRI/magick.exe';
        // $command = "\"{$convertPath}\" \"{$imagePath}\" -trim \"{$outputFilePath}\" 2>&1";

        // for unix server
        // $command = "convert \"{$imagePath}\" -trim \"{$outputFilePath}\" 2>&1";
        $command = "magick convert \"{$imagePath}\" -trim \"{$outputFilePath}\" 2>&1";

        Log::info('Executing command trimwhitespace: ' . $command);

        $output = shell_exec($command);

        // Return the output file path
        return $imagePathAbsolute;

        // $fileName = pathinfo($imagePath, PATHINFO_FILENAME);

        // $outputPath ??= pathinfo($imagePath, PATHINFO_DIRNAME);

        // $this->makeDirectory($outputPath);

        // $outputFilePath = $outputPath . '/' . $fileName . '-trimmed.png';

        // shell_exec("convert -trim {$imagePath} {$outputFilePath}");

        // return $outputPath . '/' . $fileName . '.png';
    } 
    
    
}