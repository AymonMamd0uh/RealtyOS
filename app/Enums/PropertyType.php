<?php

namespace App\Enums;

enum PropertyType: string
{
    case APARTMENT = 'apartment';
    case VILLA = 'villa';
    case TOWNHOUSE = 'townhouse';
    case TWINHOUSE = 'twinhouse';
    case PENTHOUSE = 'penthouse';
    case DUPLEX = 'duplex';

    case OFFICE = 'office';
    case CLINIC = 'clinic';
    case SHOP = 'shop';

    case LAND = 'land';
}