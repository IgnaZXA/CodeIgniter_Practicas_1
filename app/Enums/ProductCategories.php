<?php

namespace App\Enums;

enum ProductCategories: string{
    case FootWear   = "Footwear";
    case Music      = "Music";
    case FBaking = "Food - Baking";
    case FSnacks = "Food - Snacks";

    public function id(): int{
        return match($this) {
            ProductCategories::FootWear => 1,
            ProductCategories::Music    => 2,
            ProductCategories::FBaking  => 3,
            ProductCategories::FSnacks  => 4,
        };
    }
}
