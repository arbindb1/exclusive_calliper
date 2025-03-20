<?php

namespace App\Http\Controllers;

use App\Interfaces\CalliperBeadTrimServiceInterface;
use App\Interfaces\CalliperNumberServiceInterface;
use App\Interfaces\ImageServiceInterface;
use Illuminate\Http\Request;


use RuntimeException;

class CalliperController extends Controller
{
    private ImageServiceInterface $ImageService;
    private CalliperNumberServiceInterface $CalliperNumberService;
    private CalliperBeadTrimServiceInterface $CalliperBeadTrimService;

    public function __construct(ImageServiceInterface $ImageService, CalliperNumberServiceInterface $CalliperNumberService,CalliperBeadTrimServiceInterface $CalliperBeadTrimService)
    {
        $this->ImageService = $ImageService;
        $this->CalliperNumberService = $CalliperNumberService;
        $this->CalliperBeadTrimService = $CalliperBeadTrimService;
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
        $outputFilePath = $this->CalliperBeadTrimService->processBeadTrim($this->ImageService->getRawPath());

        //Processing Calliper Number and retriving required parameters
        $this->CalliperNumberService->processCalliperNumber($request);
        $matchedUrls = $this->CalliperNumberService->getMatchedUrls($outputFilePath);
        $finalRightPosition = $this->CalliperNumberService->getFinalRightPosition($matchedUrls);
        $beadMovement = $this->CalliperNumberService->getBeadMovement();
        $beadScale = $this->CalliperNumberService->getBeadScale();

        return view('welcome', compact('matchedUrls', 'finalRightPosition', 'outputFilePath', 'beadMovement', 'beadScale'));
    }

    
    
}