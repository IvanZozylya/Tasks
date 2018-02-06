<?php

class Image
{

    var $image;
    var $image_type;

    function load($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    function getWidth()
    {
        return imagesx($this->image);
    }

    function getHeight()
    {
        return imagesy($this->image);
    }

    function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function resize($width, $height)
    {


        // Get current dimensions
        $old_width  = $this->getWidth();
        $old_height = $this->getHeight();

        // Calculate the scaling we need to do to fit the image inside our frame
        $scale = min($width/$old_width, $height/$old_height);

        // Get the new dimensions1
        $new_width  = ceil($scale*$old_width);
        $new_height = ceil($scale*$old_height);

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
}