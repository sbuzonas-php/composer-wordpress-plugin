<?php
/**
 * This file is part of FancyGuy WordPress Composer Plugin.
 *
 * Copyright (c) 2015 Steve Buzonas <steve@fancyguy.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FancyGuy\Composer\WordPress\Installer;

use Composer\Composer;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Plugin\PluginInterface;
use Composer\Util\Filesystem;

class PluginInstaller extends LibraryInstaller
{
    const PACKAGE_TYPE = 'wordpress-plugin';

    private $wordpressPlugin;

    public function __construct(IOInterface $io, Composer $composer, PluginInterface $plugin, Filesystem $filesystem = null)
    {
        $this->wordpressPlugin = $plugin;
        parent::__construct($io, $composer, self::PACKAGE_TYPE, $filesystem);
    }

    /**
     * @{inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getName(), 2);
        return $this->wordpressPlugin->getConfig()->getPluginPath().'/'.$name;
    }

    /**
     * @{inheritDoc}
     */
    public function supports($packageType)
    {
        return $packageType === $this->type;
    }
}
