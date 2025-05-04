<?php

namespace App\Domain\Enums;

enum PartnerEnum: string
{
    case LOCAL = 'Local';
    case GOOGLE = 'Google';
    case MICROSOFT = 'Microsoft';
    case AMAZON = 'Amazon AWS';
    case ORACLE = 'Oracle';
    case DROPBOX = 'Dropbox';
    case MEGA = 'Mega';

}
