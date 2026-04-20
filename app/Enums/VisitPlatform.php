<?php

declare(strict_types=1);

namespace App\Enums;

enum VisitPlatform: string
{
    case Android = 'Android';
    case ChromeOS = 'Chrome OS';
    case ChromiumOS = 'Chromium OS';
    case IOS = 'iOS';
    case Linux = 'Linux';
    case MacOS = 'macOS';
    case Windows = 'Windows';
    case Unknown = 'Unknown';

    /**
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        return [
            self::Android->value => 'Android',
            self::ChromeOS->value => 'ChromeOS',
            self::ChromiumOS->value => 'ChromiumOS',
            self::IOS->value => 'IOS',
            self::Linux->value => 'Linux',
            self::MacOS->value => 'MacOS',
            self::Windows->value => 'Windows',
            self::Unknown->value => 'Unknown',
        ];
    }
}
