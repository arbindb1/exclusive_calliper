<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalliperController extends Controller
{
    public function calliperData(Request $request){

        $request->validate([
            'size' => 'required|string'
        ]);
$imagePath = '';
if($request->hasFile('bead_image')){
    $image = $request->file('bead_image');
    $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique name
    $image->move(public_path('misc/certificate/nepa-rudraksha/beads'), $imageName);

    // Generate file path
    $imagePath = asset('misc/certificate/nepa-rudraksha/beads/' . $imageName);

}

        $numberString = $request->size;
        $parts = explode('.', $numberString);

        // Ensure safe extraction of before and after decimal values
        $beforeDot = isset($parts[0]) ? intval($parts[0]) : 0;

        $afterDot = isset($parts[1]) ? intval(substr($parts[1], 0, 1)) : 0;
        // Adjust scaling for movement
        $moveRight = ($beforeDot*9.5);
        $beadScale = 0.1;
        $beadMovement = -60;

        //bead movement and scale
        if($beforeDot == 1 || $beforeDot == 01){
            $beadScale = 0.1;
            $beadMovement = -60;

        }
        else{
        $beadMovement = -60+(($beforeDot-1)*(-5.8));
        $beadScale = 0.1 + (($beforeDot-1)*0.064);
        }

        // Extract digits from number for URL matching
        $digits = array_map('intval', str_split(str_replace('.', '', $numberString)));

        // Assign correct images based on digits
        $matchedUrls = $this->numberAssign($digits);

        // Compute the final right position
        $finalRightPosition = 720 - $moveRight;
        return view('welcome', compact('matchedUrls', 'finalRightPosition','imagePath','beadMovement','beadScale'));
    }

    public function numberAssign($digits){
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

        $matchedUrls = [];

        // Assign the correct image URL for each digit
        foreach ($digits as $digit){
            if (isset($urls[$digit])) {
                $matchedUrls[] = $urls[$digit]; 
            }
        }

        return $matchedUrls;
    }
}