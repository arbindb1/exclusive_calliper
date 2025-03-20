<?php
namespace App\Interfaces;
interface CalliperBeadTrimServiceInterface
{
    public function processBeadTrim(string $imagePath, ?string $outputPath = null): string;
}
?>