<?php

namespace App\Helpers;

class AvatarHelper
{
    private static $colors = [
        '#f56565', '#ed8936', '#ecc94b', '#48bb78', '#38b2ac', 
        '#4299e1', '#667eea', '#9f7aea', '#ed64a6', '#f687b3'
    ];

    public static function generate($name, $size = 40)
    {
        $initials = self::getInitials($name);
        $color = self::getColor($name);
        
        return self::createSvgAvatar($initials, $color, $size);
    }

    private static function getInitials($name)
    {
        $words = explode(' ', trim($name));
        $initials = '';
        
        if (count($words) >= 2) {
            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
        } else {
            $initials = strtoupper(substr($name, 0, 2));
        }
        
        return $initials;
    }

    private static function getColor($name)
    {
        $hash = crc32($name);
        return self::$colors[abs($hash) % count(self::$colors)];
    }

    private static function createSvgAvatar($initials, $color, $size)
    {
        $fontSize = max(12, $size * 0.4);
        
        return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 ' . $size . ' ' . $size . '" xmlns="http://www.w3.org/2000/svg">
            <circle cx="' . ($size / 2) . '" cy="' . ($size / 2) . '" r="' . ($size / 2) . '" fill="' . $color . '"/>
            <text x="50%" y="50%" dy="0.35em" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="' . $fontSize . '" font-weight="bold">' . $initials . '</text>
        </svg>';
    }
} 