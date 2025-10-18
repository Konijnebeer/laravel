<?php

namespace App;

enum UserPermission
{
    case USER;
    case PAID_USER;
    case BLOG_OWNER;
    case ADMIN;
}
//enum UserPermission: string
//{
//    case USER = 'User';
//    case PAID_USER = 'Paid User';
//    case BLOG_OWNER = 'Blog Owner';
//    case ADMIN = 'Admin';
//
//    public static function values(): array
//    {
//        return array_column(self::cases(), 'name', 'value');
//    }
//}
