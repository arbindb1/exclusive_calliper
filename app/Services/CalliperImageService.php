<?php
namespace App\Services;
use App\Interfaces\CalliperImageServiceInterface;
class CalliperImageService implements CalliperImageServiceInterface
{
    private $imageRawPath;
    public function storeImage($request)
    {
        $imageRawPath = '';
        if ($request->hasFile('bead_image')) {
            $image = $request->file('bead_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('misc/certificate/nepa-rudraksha/beads'), $imageName);
            $imagePath = url('misc/certificate/nepa-rudraksha/beads/' . $imageName);
            $imageRawPath = public_path('misc/certificate/nepa-rudraksha/beads/' . $imageName);
            $this->imageRawPath = $imageRawPath;
        }
    }
public function getRawPath()
{
    return $this->imageRawPath;
}
}
?>