<?php
namespace App\Interfaces;
Interface ImageServiceInterface
{
    public function storeImage($request);
    public function getRawPath();
}
?>