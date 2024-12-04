<?php

namespace App\Enums;
use Illuminate\Support\Collection;


enum UserType: string
{
    case Admin = 'admin';
    case Tutor = 'tutor';
    case Estudiante = 'estudiante';

    public static function forMigration(): array {
        return collect(self::cases())
            ->map(function ($enum) {
                return property_exists($enum, "value") ? $enum->value : $enum->name;
            })
            ->values()
            ->toArray();
    }
}