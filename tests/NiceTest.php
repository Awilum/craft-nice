<?php

use function Awilum\CraftNice\niceFileSize;
use function Awilum\CraftNice\niceHumanNumber;
use function Awilum\CraftNice\niceNumber;
use function Awilum\CraftNice\niceDateTime;
use function Awilum\CraftNice\niceFileName;

test('nice file size', function () {
    expect(niceFileSize(1))->toBe('1 B');
    expect(niceFileSize(1000))->toBe('1 KB');
    expect(niceFileSize(100000))->toBe('100 KB');
    expect(niceFileSize(1000000))->toBe('1 MB');
    expect(niceFileSize(1000000000))->toBe('1 GB');
    expect(niceFileSize(1000000000000))->toBe('1 TB');

    expect(niceFileSize(1, false))->toBe('1 B');
    expect(niceFileSize(1000, false))->toBe('1000 B');
    expect(niceFileSize(100000, false))->toBe('97.66 KiB');
    expect(niceFileSize(1000000, false))->toBe('976.56 KiB');
    expect(niceFileSize(1000000000, false))->toBe('953.67 MiB');
    expect(niceFileSize(1000000000000, false))->toBe('931.32 GiB');
});

test('nice human number', function () {
    expect(niceHumanNumber(0))->toBe('0');
    expect(niceHumanNumber(1))->toBe('1');
    expect(niceHumanNumber(1000))->toBe('1K');
    expect(niceHumanNumber(1000000))->toBe('1M');
    expect(niceHumanNumber(1000000000))->toBe('1B');
    expect(niceHumanNumber(1000000000000))->toBe('1T');

    expect(niceHumanNumber(0, true))->toBe('0');
    expect(niceHumanNumber(1, true))->toBe('1.0');
    expect(niceHumanNumber(1000, true))->toBe('1.0K');
    expect(niceHumanNumber(1500, true))->toBe('1.5K');
    expect(niceHumanNumber(1000000, true))->toBe('1.0M');
    expect(niceHumanNumber(1500000, true))->toBe('1.5M');
    expect(niceHumanNumber(1000000000, true))->toBe('1.0B');
    expect(niceHumanNumber(105000000, true))->toBe('105.0M');
    expect(niceHumanNumber(1000000000000, true))->toBe('1.0T');
    expect(niceHumanNumber(1050000000000, true))->toBe('1.1T');

    expect(niceHumanNumber(1050000000000, true, 10))->toBe('1.0500000000T');
});

test('nice number', function () {
    expect(niceNumber(10050050))->toBe('10,050,050');
    expect(niceNumber(10050050, 2))->toBe('10,050,050.00');
    expect(niceNumber(10050050, 2, '/'))->toBe('10,050,050/00');
    expect(niceNumber(10050050, 2, '/', ':'))->toBe('10:050:050/00');
});

test('nice date time', function () {
    $time  = time();
    $time2 = date('F j, Y, g:i a', $time);
    expect(niceDateTime($time))->toBe($time2);
});

test('nice file name', function () {
    expect(niceFileName('foo bar'))->toBe('foo-bar');
    expect(niceFileName('foo bar', '_'))->toBe('foo_bar');
    expect(niceFileName('bar#foo',))->toBe('bar-foo');
});