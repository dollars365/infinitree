<?php

namespace Encore\infinitree;

use Encore\Admin\Extension;

class infinitree extends Extension
{
    public $name = 'infinitree';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Infinitree',
        'path'  => 'infinitree',
        'icon'  => 'fa-gears',
    ];
}