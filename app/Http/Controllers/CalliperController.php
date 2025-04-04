<?php

namespace App\Http\Controllers;

use App\Interfaces\CalliperBackgroundRemoveServiceInterface;
use App\Interfaces\CalliperBeadTrimServiceInterface;
use App\Interfaces\CalliperNumberServiceInterface;
use App\Interfaces\CalliperImageServiceInterface;
use Illuminate\Http\Request;


use RuntimeException;

class CalliperController extends Controller
{
    private CalliperImageServiceInterface $ImageService;
    private CalliperNumberServiceInterface $CalliperNumberService;
    private CalliperBeadTrimServiceInterface $CalliperBeadTrimService;
    private CalliperBackgroundRemoveServiceInterface $CalliperBackgroundRemoveService;

    public function __construct(CalliperImageServiceInterface $ImageService, CalliperNumberServiceInterface $CalliperNumberService,CalliperBeadTrimServiceInterface $CalliperBeadTrimService,CalliperBackgroundRemoveServiceInterface $CalliperBackgroundRemoveService) 
    {
        $this->ImageService = $ImageService;
        $this->CalliperNumberService = $CalliperNumberService;
        $this->CalliperBeadTrimService = $CalliperBeadTrimService;
        $this->CalliperBackgroundRemoveService = $CalliperBackgroundRemoveService;
    }
    public function calliperData(Request $request)
    {
        $request->validate([
            'size' => 'required|string'
        ]);

        //Storing Image and retriving path
        $imagePath = '';
        $imageRawPath = '';
        $this->ImageService->storeImage($request);
        $removedPath = $this->CalliperBackgroundRemoveService->removeBackground($this->ImageService->getRawPath());
        $outputFilePath = $this->CalliperBeadTrimService->processBeadTrim($removedPath);

        //Processing Calliper Number and retriving required parameters
        $this->CalliperNumberService->processCalliperNumber($request);
        $matchedUrls = $this->CalliperNumberService->getMatchedUrls($outputFilePath);
        $finalRightPosition = $this->CalliperNumberService->getFinalRightPosition($matchedUrls);
        $beadMovement = $this->CalliperNumberService->getBeadMovement();
        $beadScale = $this->CalliperNumberService->getBeadScale();

        return view('welcome', compact('matchedUrls', 'finalRightPosition', 'outputFilePath', 'beadMovement', 'beadScale'));
    }

    
    
}