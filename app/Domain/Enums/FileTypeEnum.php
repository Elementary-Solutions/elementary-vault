<?php

namespace App\Domain\Enums;

enum FileTypeEnum: int
{
    case IMAGE = 1;
    case VIDEO = 2;
    case AUDIO = 3;
    case DOCUMENT = 4;
    case SPREADSHEET = 5;
    case PRESENTATION = 6;
    case CODE = 7;
    case FONT = 8;
    case MODEL = 9;
    case DATA = 10;
    case SCRIPT = 11;
    case COMPRESSED = 12;
    case EXECUTABLE = 13;
    case OTHER = 14;
}
