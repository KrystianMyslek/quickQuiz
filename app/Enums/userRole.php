<?php

namespace App\Enums;

enum userRole: string
{
    case Admin = 'admin';
    case User = 'user';

    public static function values(): array
    {
        $map = [];
        foreach (self::cases() as $case) {
            $map[$case->name] = $case->value;
        }
        return $map;
    }
}
