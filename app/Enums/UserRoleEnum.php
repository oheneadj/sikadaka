<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case Collector = 'collector';
    case Viewer = 'viewer';
}
