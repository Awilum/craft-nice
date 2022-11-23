<?php

/*
 * This file is part of the Nice plugin.
 *
 * (c) Sergey Romanenko <awilum@msn.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace CraftPlugins\Nice;

use TypeError;

/**
 * Get nice file size
 * 
 * @param int $input Input
 * @param bool $decimal Is decimal?
 * 
 * @return string
 */
function niceFileSize(int $input, bool $decimal = true): ?string {
    if ($input <= 0) return null;
    
    $calcBase = $decimal ? 1000 : 1024;

    $input = (int) $input;
    $base = log($input) / log($calcBase);
    $suffixes = $decimal ? ['B', 'KB', 'MB', 'GB', 'TB'] : ['B', 'KiB', 'MiB', 'GiB', 'TiB'];

    return round(pow($calcBase, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
}

/**
 * Get nice human number
 * 
 * @param int $input Input
 * @param bool $showDecimal Show decimal
 * @param int $decimals Decimals
 * 
 * @return string
 */
function niceHumanNumber(int $input, bool $showDecimal = false, int $decimals = 0): string {
    $decimals = $showDecimal && $decimals == 0 ? 1 : $decimals;

    $match = match(true) {
        $input >= 0 && $input < 1000 => ['floor' => floor($input), 'floor_number' => 0, 'suffix' => ''],
        $input >= 1000 && $input < 1000000 => ['floor' => floor($input / 1000), 'floor_number' => 1000, 'suffix' => 'K'],
        $input >= 1000000 && $input < 1000000000 => ['floor' => floor($input / 1000000), 'floor_number' => 1000000, 'suffix' => 'M'],
        $input >= 1000000000 && $input < 1000000000000 => ['floor' => floor($input / 1000000000), 'floor_number' => 1000000000, 'suffix' => 'B'],
        $input >= 1000000000000 => ['floor' => floor($input / 1000000000000), 'floor_number' => 1000000000000, 'suffix' => 'T'],
    };

    if ($showDecimal && $match['floor_number'] > 0) {
        $input -= ($match['floor'] * $match['floor_number']);
        if ($input > 0) {
            $input /= $match['floor_number'];
            $match['floor'] += $input;
        }
    }

    return !empty($match['floor'] . $match['suffix']) ? number_format($match['floor'], $decimals) . $match['suffix'] : '0';
}

/**
 * Get nice number
 * 
 * @param mixed $input Input
 * @param int $decimals Decimals
 * @param string $point Point
 * @param string $delimiter Delimiter
 * 
 * @return string
 */
function niceNumber($input, int $decimals = 0, string $point = '.', string $delimiter = ','): string {
    if (!in_array(gettype($input), ['integer', 'double', 'float'])) { 
        throw new TypeError("Wrong Input Type.");
    }

    return number_format($input, $decimals, $point, $delimiter);
}

/**
 * Get nice date/time
 * 
 * @param mixed $input Input
 * @param string $format Format
 * 
 * @return string
 */
function niceDateTime($input, string $format = 'F j, Y, g:i a'): string {
    return date($format, $input);
}

/**
 * Get nice file name
 * 
 * @param string $input Input
 * @param string $delimiter Delimiter
 * 
 * @return string
 */
function niceFileName(string $input, string $delimiter = '-'): string {
    return preg_replace('/[^a-z0-9]+/', $delimiter, strtolower($input));
}