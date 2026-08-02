<?php

namespace Application\Block\DateCounter;

use Concrete\Core\Block\BlockController;
use DateTime;
use Exception;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 470;
    protected $btInterfaceHeight = 300;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btTable = 'btDateCounter';
    protected $btDefaultSet = 'basic';

    protected $dateValue = '';

    public function getBlockTypeDescription()
    {
        return t('Display a countdown to a selected date and time.');
    }

    public function getBlockTypeName()
    {
        return t('Date Counter');
    }

    public function add()
    {
        $this->set('dateValue', date('Y-m-d H:i:s'));
    }

    public function edit()
    {
        $this->set('dateValue', $this->dateValue);
    }

    public function validate($args)
    {
        $e = $this->app->make('helper/validation/error');
        $wdt = $this->app->make('helper/form/date_time');
        $dateValue = $wdt->translate('dateValue', $args);

        if (!$dateValue) {
            $e->add(t('Please select a target date and time.'));
        }

        return $e;
    }

    public function save($args)
    {
        $wdt = $this->app->make('helper/form/date_time');
        $args['dateValue'] = $wdt->translate('dateValue', $args) ?: '';

        parent::save($args);
    }

    public function view()
    {
        $this->set('targetDate', $this->getTargetDateIso());
    }

    public function registerViewAssets($outputContent = '')
    {
        $this->requireAsset('javascript', 'jquery');
    }

    public function getSearchableContent()
    {
        return $this->dateValue;
    }

    protected function getTargetDateIso(): ?string
    {
        if (!$this->dateValue || $this->dateValue === '0000-00-00 00:00:00') {
            return null;
        }

        try {
            return (new DateTime($this->dateValue))->format('c');
        } catch (Exception $e) {
            return null;
        }
    }
}
