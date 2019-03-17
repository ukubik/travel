<?php

namespace App\Listeners;
use Intervention\Image\Facades\Image;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;

class HasUploadedImageListener
{
    /**
     * Handle the event.
     *
     * @param  ImageWasUploaded  $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        // Get te public path to the file and save it to the database
        $publicFilePath = str_replace(public_path(), "", $event->path());
        $this->imageResizeWidth($publicFilePath);
    }

    /**
    * Сжатие изображения по ширине
    */
    protected function imageResizeWidth($path)
    {
        $img = Image::make($path)->orientate()->widen(1280)->save();
    }
}
