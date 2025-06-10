<?php

namespace App\Enums;

enum Prodi: string
{
    case TI = 'Teknik Informatika';
    case SIB = 'Sistem Informasi Bisnis';
    case PPLS = 'Pengembangan Piranti Lunak Situs';

    public function abbreviation(): string
    {
        return match ($this) {
            self::TI => 'TI',
            self::SIB => 'SIB',
            self::PPLS => 'PPLS',
        };
    }
}