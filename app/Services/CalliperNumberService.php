<?php
namespace App\Services;
use App\Interfaces\CalliperNumberServiceInterface;
class CalliperNumberService implements CalliperNumberServiceInterface
{
    private $beadMovement;
    private $beadScale;
    private $matchedUrls;
    private $finalRightPosition;
    public function processCalliperNumber($request)
    {
        $numberString = $request->size;
        list($beforeDot, $afterDot) = array_pad(explode('.', $numberString), 2, 0);

        $beforeDot = intval($beforeDot);
        $afterDot = intval(substr($afterDot, 0, 1));
        $moveRight = $beforeDot * 9.5;
        if($beforeDot == 1 || $beforeDot == 01){
            $this->beadScale = 0.1;
            $this->beadMovement = 55;
        }
        else if($beforeDot>=5 && $beforeDot<=9){
            $this->beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $this->beadMovement = 60 + ($beforeDot - 1) * -5.8;
        }
        else if($beforeDot>=15 && $beforeDot<=25){
            $this->beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $this->beadMovement = 75 + ($beforeDot - 1) * -5.8;
        }
        else if($beforeDot>=26){
            $this->beadScale = 0.1 + ($beforeDot - 1) * 0.064;
            $this->beadMovement = 85 + ($beforeDot - 1) * -5.8;
        }
        else{

        $this->beadScale = 0.1 + ($beforeDot - 1) * 0.064;
        $this->beadMovement = 65 + ($beforeDot - 1) * -5.8;
        }
        $digits = array_map('intval', str_split(str_replace('.', '', $numberString)));
        $this->matchedUrls = $this->numberAssign($digits);

        $this->finalRightPosition = 720 - $moveRight;
    }
    public function getBeadMovement()
    {
        return $this->beadMovement;
    }
    public function getBeadScale()
    {
        return $this->beadScale;
    }
    public function getMatchedUrls()
    {
        return $this->matchedUrls;
    }
    public function getFinalRightPosition()
    {
        return $this->finalRightPosition;
    }
    public function numberAssign($digits)
    {
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

        return array_map(fn($digit) => $urls[$digit] ?? null, $digits);
    }

}
?>