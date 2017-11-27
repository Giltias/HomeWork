<?php

namespace HW7\App\Service;

use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageService
 * @package HW7\App\Classes
 */
class ImageService
{
    /**
     * @var \Intervention\Image\Image
     */
    private $image;

    /**
     * ImageClass constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->image = Image::make($filename);
    }

    /**
     * @return $this
     */
    private function rotate()
    {
        $this->image->rotate(45);
        return $this;
    }

    /**
     * @return $this
     */
    public function resize()
    {
        $this->image->resize(480, 480);
        return $this;
    }

    public function save($name)
    {
        $filename = '/web/uploads/' . $name . '.png';
        $this->image->save(__DIR__ . '/../..' . $filename , 60);
        return $filename;
    }

    /**
     * @return $this
     */
    private function setWatermark()
    {
        $watermark = Image::make(__DIR__ . '/../../web/img/Sample-trans.png');
        $watermark->rotate(-45)->resize(200, null);
        $this->image->insert($watermark, 'center');
        return $this;
    }

    /**
     * @return mixed
     */
    public function setChange()
    {
        $this->rotate()->resize()->setWatermark();
        return $this->image->response('png');
    }
}