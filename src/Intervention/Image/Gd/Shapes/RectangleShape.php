<?php

namespace Intervention\Image\Gd\Shapes;

use Intervention\Image\AbstractShape;
use Intervention\Image\Gd\Color;
use Intervention\Image\Image;

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
        $background = new Color($this->background);
        imagefilledrectangle($image->getCore(), $this->x1, $this->y1, $this->x2, $this->y2, $background->getInt());

        if ($this->hasBorder()) {
            $border_color = new Color($this->border_color);
            imagesetthickness($image->getCore(), $this->border_width);
            imagerectangle($image->getCore(), $this->x1, $this->y1, $this->x2, $this->y2, $border_color->getInt());
        }

        return true;
    }
}
