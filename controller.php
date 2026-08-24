<?php

namespace Concrete\Package\DateCounter;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Package\Package;

class Controller extends Package
{
    /**
     * @var string
     */
    protected $pkgHandle = 'date_counter';

    /**
     * @var string
     */
    protected $appVersionRequired = '9.0.0';

    /**
     * @var string
     */
    protected $pkgVersion = '1.0.0';

    public function getPackageName(): string
    {
        return t('Date Counter');
    }

    public function getPackageDescription(): string
    {
        return t('Adds a countdown block that displays the time remaining until a selected date and time.');
    }

    public function install()
    {
        $pkg = parent::install();
        $this->installOrRefreshBlockType($pkg);

        return $pkg;
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installOrRefreshBlockType($this);
    }

    /**
     * @param \Concrete\Core\Entity\Package|\Concrete\Core\Package\Package $pkg
     */
    protected function installOrRefreshBlockType($pkg): void
    {
        $bt = BlockType::getByHandle('date_counter');
        if (!is_object($bt)) {
            BlockType::installBlockType('date_counter', $pkg);

            return;
        }

        $bt->refresh();
    }
}
