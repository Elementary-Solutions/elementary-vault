<?php

namespace App\Domain\Enums;

enum PartnerEnum: string
{
    CASE LOCAL = 'Local';
    CASE GOOGLE = 'Google';
    CASE MICROSOFT = 'Microsoft';
    CASE AMAZON = 'Amazon AWS';
    CASE ORACLE = 'Oracle';
    CASE DROPBOX = 'Dropbox';
    CASE MEGA = 'Mega';

}
