<?php
namespace App\Services;

use App\Interfaces\CalliperBackgroundRemoveServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class CalliperBackgroundRemoveService implements CalliperBackgroundRemoveServiceInterface
{
    public function removeBackground(string $imagePath, ?string $outputPath = null): string
    {
    
            $imagePath = str_replace('\\', '/', $imagePath);
            $fileName = pathinfo($imagePath, PATHINFO_FILENAME);
    
            $outputPath ??= pathinfo($imagePath, PATHINFO_DIRNAME);
            $outputPath = str_replace('\\', '/', $outputPath);
                   if (!File::exists($outputPath)) {
                File::makeDirectory($outputPath, 0755, true);
         }
    
        $outputFilePath = public_path("misc/certificate/nepa-rudraksha/beads/{$fileName}-removed.png");

            $imagePathAbsolute = url('misc/certificate/nepa-rudraksha/beads/' . $fileName.'-removed.png');
            $outputFilePath = str_replace('\\', '/', $outputFilePath);
            $imagePath = str_replace('\\', '/', $imagePath);

      $rembgPath = 'C:\Users\Arbin\AppData\Local\Programs\Python\Python313\Scripts\rembg.exe'; 
      $rembgPath = str_replace('\\', '/', $rembgPath);// Update as per your output
      $command = "\"{$rembgPath}\" i \"{$imagePath}\" \"{$outputFilePath}\"";
        Log::info('Executing command trimwhitespace: ' . $command);

        $output = shell_exec($command);
        Log::info("Executing command: $command");
Log::info("Command output: $output");
        // Return the output file path
        return $outputFilePath;
        } 
}

?>