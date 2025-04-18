<?php

namespace Intervention\Image\Imagick\Shapes;

use Intervention\Image\AbstractShape;
use Intervention\Image\Image;
use Intervention\Image\Imagick\Color;

class RectangleShape extends AbstractShape
{
    /**
     * X-Coordinate of top-left point
     *
     * @var int
     */
    public $x1 = 0;

    /**
     * Y-Coordinate of top-left point
     *
     * @var int
     */
    public $y1 = 0;

    /**
     * X-Coordinate of bottom-right point
     *
     * @var int
     */
    public $x2 = 0;

    /**
     * Y-Coordinate of bottom-right point
     *
     * @var int
     */
    public $y2 = 0;

    /**
     * Create new rectangle shape instance
     *
     * @param null|int $x1
     * @param null|int $y1
     * @param null|int $x2
     * @param null|int $y2
     */
    public function __construct(?int $x1 = null, ?int $y1 = null, ?int $x2 = null, ?int $y2 = null)
    {
        $this->x1 = is_numeric($x1) ? intval($x1) : $this->x1;
        $this->y1 = is_numeric($y1) ? intval($y1) : $this->y1;
        $this->x2 = is_numeric($x2) ? intval($x2) : $this->x2;
        $this->y2 = is_numeric($y2) ? intval($y2) : $this->y2;
    }

    /**
     * Draw rectangle to given image at certain position
     *
     * @param  Image   $image
     * @param  int     $x
     * @param  int     $y
     * @return boolean
     */
    public function applyToImage(Image $image, $x = 0, $y = 0)
    {
        $rectangle = new \ImagickDraw;

        // set background
        $bgcolor = new Color($this->background);
        $rectangle->setFillColor($bgcolor->getPixel());

        // set border
        if ($this->hasBorder()) {
            $border_color = new Color($this->border_color);
            $rectangle->setStrokeWidth($this->border_width);
            $rectangle->setStrokeColor($border_color->getPixel());
        }

        $rectangle->rectangle($this->x1, $this->y1, $this->x2, $this->y2);

        $image->getCore()->drawImage($rectangle);

        return true;
    }
}
