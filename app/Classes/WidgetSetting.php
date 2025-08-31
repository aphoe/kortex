<?php

namespace App\Classes;

class WidgetSetting
{
    public const MAX_HEIGHT = "400px";

    /**
     * Return an array of colors
     *
     * @param bool $shuffle
     * @param float $opacity
     * @return string[]
     */
    public function colors(bool $shuffle, float $opacity): array
    {
        if($opacity > 1) $opacity = 1;
        if($opacity < 0) $opacity = 0;

        $colors = [
            "rgba(244, 67, 54, {$opacity})",
            "rgba(233, 30, 99, {$opacity})",
            "rgba(156, 39, 176, {$opacity})",
            "rgba(103, 58, 183, {$opacity})",
            "rgba(63, 81, 181, {$opacity})",
            "rgba(33, 150, 243, {$opacity})",
            "rgba(3, 169, 244, {$opacity})",
            "rgba(0, 188, 212, {$opacity})",
            "rgba(0, 150, 136, {$opacity})",
            "rgba(76, 175, 80, {$opacity})",
            "rgba(139, 195, 74, {$opacity})",
            "rgba(205, 220, 57, {$opacity})",
            "rgba(255, 235, 59, {$opacity})",
            "rgba(255, 193, 7, {$opacity})",
            "rgba(255, 152, 0, {$opacity})",
            "rgba(255, 87, 34, {$opacity})",
            "rgba(121, 85, 72, {$opacity})",
            "rgba(158, 158, 158, {$opacity})",
            "rgba(96, 125, 139, {$opacity})",
        ];

        if($shuffle){
            shuffle($colors);
        }

        return $colors;
    }
}
