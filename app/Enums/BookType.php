<?php

namespace App\Enums;

enum BookType: string
{
    case Graphic = 'graphic'; //Графическое издание
    case Digital = 'digital'; //Цифровое издание
    case Print = 'print'; // Печатное издание
}
