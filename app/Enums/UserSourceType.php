<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CMD()
 * @method static static API()
 * @method static static OTHERS()
 */
final class UserSourceType extends Enum
{
    const CMD = 'cmd';
    const API = 'api';
    const OTHERS = '3rdparty';
}
