<?php
namespace App\Interfaces;
Interface CalliperNumberServiceInterface
{
    public function processCalliperNumber($request);
    public function getBeadMovement();
    public function getBeadScale();
    public function getMatchedUrls();
    public function getFinalRightPosition();
}
?>