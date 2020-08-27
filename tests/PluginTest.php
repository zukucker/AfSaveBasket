<?php

namespace AfSaveBasket\Tests;

use AfSaveBasket\AfSaveBasket as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'AfSaveBasket' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['AfSaveBasket'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
