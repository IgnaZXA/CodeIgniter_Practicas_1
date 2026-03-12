<?php

namespace App\Enums;

enum TableColumnsProducts: int {
    case ID             = 0;
    case Name           = 1;
    case Price          = 2;
    case Stocks         = 3;
    case Categories     = 4;
    case Actions        = 5;
}