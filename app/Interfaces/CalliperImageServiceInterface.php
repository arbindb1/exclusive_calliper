<?php
namespace App\Interfaces;
Interface CalliperImageServiceInterface
{
    public function storeImage($request);
    public function getRawPath();
}
?>