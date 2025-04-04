<?php
namespace App\Interfaces;

interface CalliperBackgroundRemoveServiceInterface
{
    public function removeBackground(string $imagePath, ?string $outputPath = null): string;
}

?>