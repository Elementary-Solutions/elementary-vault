<?php

namespace App\Domain\Enums;

enum AdapterEnum: int
{
    case LOCAL = 1;
    case FTP   = 2;

    case GOOGLE_DRIVE = 3;
    case GCS = 4;

    case ONE_DRIVE = 5;
    case AZURE_BLOB = 6;

    case S3 = 7;

    case OCI = 8;

    case DROPBOX = 9;

    case MEGA = 10;

}
