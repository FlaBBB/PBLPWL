<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case MAHASISWA = 'MAHASISWA';
    case DOSEN = 'DOSEN';
    case ADMIN = 'ADMIN';
}
