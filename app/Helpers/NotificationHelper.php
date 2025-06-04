<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class NotificationHelper
{
    public static function add(string $type, string $message, array $options = []): void
    {
        $notifications = Session::get('notyf.notifications', []);
        $notifications[] = [
            'type' => $type,
            'message' => $message,
            'options' => $options,
        ];
        Session::flash('notyf.notifications', $notifications);
    }

    public static function success(string $message, array $options = []): void
    {
        self::add('success', $message, $options);
    }

    public static function error(string $message, array $options = []): void
    {
        self::add('error', $message, $options);
    }

    public static function info(string $message, array $options = []): void
    {
        self::add('info', $message, $options);
    }

    public static function warning(string $message, array $options = []): void
    {
        self::add('warning', $message, $options);
    }
}