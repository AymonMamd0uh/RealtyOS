<?php

namespace App\Enums;

enum PropertyStatus: string
{
    case DRAFT = 'draft';
    case AVAILABLE = 'available';
    case RESERVED = 'reserved';
    case SOLD = 'sold';
    case RENTED = 'rented';
}