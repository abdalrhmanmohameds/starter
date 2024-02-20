<?php

namespace App\Traits;

trait OfferTrait
{
    protected function saveImages($photo, $folder)
{
    $file_extension = $photo->getClientOriginalExtension();          //file extension
    $file_name = time() . '.' . $file_extension;                             //file name
    $path = $folder;                                                //path photo
    $photo->move($path, $file_name);

    return $file_name;
}
}
