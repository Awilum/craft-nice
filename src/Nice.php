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

use Craft;
use craft\base\Plugin;
use CraftPlugins\Nice\NiceTwigExtension;

class Nice extends Plugin
{
    public function init()
    {
        parent::init();
        Craft::$app->view->registerTwigExtension(new NiceTwigExtension());
    }
}