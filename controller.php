<?php

namespace Application\Block\DateCounter;

use Concrete\Core\Block\BlockController;
use DateTime;
use Exception;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 470;
    protected $btInterfaceHeight = 380;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btTable = 'btDateCounter';
    protected $btDefaultSet = 'basic';

    protected $dateValue = '';
    protected $expiredMessage = '';

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
        $this->set('expiredMessage', '');
    }

    public function edit()
    {
        $this->set('dateValue', $this->dateValue);
        $this->set('expiredMessage', $this->expiredMessage);
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
        $args['expiredMessage'] = trim(strip_tags((string) ($args['expiredMessage'] ?? '')));

        parent::save($args);
    }

    public function view()
    {
        $this->set('targetDate', $this->getTargetDateIso());
        $this->set('expiredMessage', $this->getExpiredMessage());
    }

    public function registerViewAssets($outputContent = '')
    {
        $this->requireAsset('javascript', 'jquery');
    }

    public function getSearchableContent()
    {
        return trim($this->dateValue . ' ' . $this->expiredMessage);
    }

    protected function getExpiredMessage(): string
    {
        $message = trim((string) $this->expiredMessage);

        if ($message !== '') {
            return $message;
        }

        return (string) t('Event has passed. Please come back for future updates.');
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
