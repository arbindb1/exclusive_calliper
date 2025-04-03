<?php
namespace App\Services;
use App\Interfaces\CalliperBeadTrimServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CalliperBeadTrimService implements CalliperBeadTrimServiceInterface{
    public function processBeadTrim(string $imagePath, ?string $outputPath = null): string
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
        //     $command = "convert \"{$imagePath}\" -trim \"{$outputFilePath}\" 2>&1";
    
        //     Log::info('Executing command trimwhitespace: ' . $command);
    
        //     $output = shell_exec($command);
    
        //     // Return the output file path
        //     return $imagePathAbsolute;
    //     $imagePath = str_replace('\\', '/', $imagePath);
    //     $fileName = pathinfo($imagePath, PATHINFO_FILENAME);

    //     $outputPath ??= pathinfo($imagePath, PATHINFO_DIRNAME);
    //     $outputPath = str_replace('\\', '/', $outputPath);
    //            if (!File::exists($outputPath)) {
    //         File::makeDirectory($outputPath, 0755, true);
    //  }

    //     $outputFilePath = $outputPath . '/' . $fileName . '-trimmed.png';
    //     $imagePathAbsolute = url('misc/certificate/nepa-rudraksha/beads/' . $fileName.'-trimmed.png');
    //     $outputFilePath = str_replace('\\', '/', $outputFilePath);
    //     $imagePath = str_replace('\\', '/', $imagePath);

      $command = "python3 -m rembg i \"{$imagePath}\" \"{$outputFilePath}\" 2>&1";

        Log::info('Executing command trimwhitespace: ' . $command);

        $output = shell_exec($command);

        // Return the output file path
        return $imagePathAbsolute;
        } 
    }
?>