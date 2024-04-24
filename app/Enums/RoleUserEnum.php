<?php

namespace App\Enums;

enum RoleUserEnum: string
{
    case ADMIN = 'Admin';
    case USERJUNIOR = 'UserJunior';
    case USERVIP = 'UserVip';
}