<?php

namespace DZ06\App\Classes;

use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageClass
 * @package DZ06\App\Classes
 */
class ImageClass
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
    private function resize()
    {
        $this->image->resize(200, null);
        return $this;
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