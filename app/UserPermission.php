<?php

namespace App;

enum UserPermission
{
    case USER;
    case PAID_USER;
    case BLOG_OWNER;
    case ADMIN;
}
