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

namespace Awilum\CraftNice;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;
use Twig_Extension;
use function Awilum\CraftNice\niceFileSize;
use function Awilum\CraftNice\niceHumanNumber;
use function Awilum\CraftNice\niceNumber;
use function Awilum\CraftNice\niceDateTime;
use function Awilum\CraftNice\niceFileName;

class NiceTwigExtension extends AbstractExtension
{
	/**
	 * Get Name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'Nice';
	}

	/**
	 * Get TwigFilter
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return [
			new TwigFilter('niceFileSize', fn(int $input, bool $decimal = true) => niceFileSize($input, $decimal)),
			new TwigFilter('niceHumanNumber', fn(int $input, bool $showDecimal = false, int $decimals = 0) => niceHumanNumber($input, $showDecimal)),
			new TwigFilter('niceNumber', fn($input, int $decimals = 0, string $point = '.', string $delimiter = ',') => niceNumber($input, $decimals, $point, $delimiter)),
			new TwigFilter('niceDateTime', fn($input, string $format = 'F j, Y, g:i a') => niceDateTime($input, $format)),
			new TwigFilter('niceFileName', fn(string $input, string $delimiter = '-') => niceFileName($input, $delimiter))
		];
	}

	/**
	 * Get Functions
	 *
	 * @return array
	 */
	public function getFunctions()
	{
		return [
			new TwigFunction('niceFileSize', fn(int $input, bool $decimal = true) => niceFileSize($input, $decimal)),
			new TwigFunction('niceHumanNumber', fn(int $input, bool $showDecimal = false, int $decimals = 0) => niceHumanNumber($input, $showDecimal)),
			new TwigFunction('niceNumber', fn($input, int $decimals = 0, string $point = '.', string $delimiter = ',') => niceNumber($input, $decimals, $point, $delimiter)),
			new TwigFunction('niceDateTime', fn($input, string $format = 'F j, Y, g:i a') => niceDateTime($input, $format)),
			new TwigFunction('niceFileName', fn(string $input, string $delimiter = '-') => niceFileName($input, $delimiter))
		];
	}
}