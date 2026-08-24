<?php

namespace Application\Block\DateCounter;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Form\Service\Widget\DateTime as DateTimeWidget;
use Concrete\Core\Localization\Service\Date;
use Exception;

class Controller extends BlockController
{
    /**
     * @var string
     */
    protected $btTable = 'btDateCounter';

    /**
     * @var string
     */
    protected $btDefaultSet = 'basic';

    /**
     * @var int
     */
    protected $btInterfaceWidth = 550;

    /**
     * @var int
     */
    protected $btInterfaceHeight = 420;

    /**
     * @var bool
     */
    protected $btCacheBlockRecord = true;

    /**
     * @var bool
     */
    protected $btCacheBlockOutput = true;

    /**
     * @var bool
     */
    protected $btCacheBlockOutputOnPost = true;

    /**
     * @var bool
     */
    protected $btCacheBlockOutputForRegisteredUsers = false;

    /**
     * Target datetime stored in system timezone (Y-m-d H:i:s).
     *
     * @var string|null
     */
    public $dateValue;

    /**
     * Custom message shown when the countdown ends.
     *
     * @var string|null
     */
    public $expiredMessage;

    public function getBlockTypeName(): string
    {
        return t('Date Counter');
    }

    public function getBlockTypeDescription(): string
    {
        return t('Display a live countdown to a selected date and time.');
    }

    public function add(): void
    {
        /** @var Date $dateHelper */
        $dateHelper = $this->app->make('date');
        $this->set('dateValue', $dateHelper->toDB('now'));
        $this->set('expiredMessage', '');
    }

    public function edit(): void
    {
        $this->set('dateValue', $this->dateValue);
        $this->set('expiredMessage', (string) $this->expiredMessage);
    }

    /**
     * @param array<string, mixed>|string|null $args
     */
    public function validate($args): ErrorList
    {
        /** @var ErrorList $e */
        $e = $this->app->make(ErrorList::class);

        if (!is_array($args)) {
            $e->add(t('Invalid request.'));

            return $e;
        }

        /** @var DateTimeWidget $wdt */
        $wdt = $this->app->make('helper/form/date_time');
        $dateValue = $wdt->translate('dateValue', $args);

        if (!$dateValue) {
            $e->add(t('Please select a target date and time.'));
        }

        return $e;
    }

    /**
     * @param array<string, mixed> $args
     */
    public function save($args): void
    {
        /** @var DateTimeWidget $wdt */
        $wdt = $this->app->make('helper/form/date_time');

        $args['dateValue'] = $wdt->translate('dateValue', $args) ?: null;
        $args['expiredMessage'] = trim(strip_tags((string) ($args['expiredMessage'] ?? '')));

        parent::save($args);
    }

    public function view(): void
    {
        $this->set('bID', (int) $this->bID);
        $this->set('targetDate', $this->getTargetDateIso());
        $this->set('expiredMessage', $this->getExpiredMessage());
        $this->set('invalidMessage', t('Invalid target date.'));
        $this->set('missingDateMessage', t('No target date has been configured.'));
    }

    public function getSearchableContent(): string
    {
        return trim(implode(' ', array_filter([
            (string) $this->dateValue,
            (string) $this->expiredMessage,
        ])));
    }

    protected function getExpiredMessage(): string
    {
        $message = trim((string) $this->expiredMessage);

        return $message !== ''
            ? $message
            : (string) t('Event has passed. Please come back for future updates.');
    }

    protected function getTargetDateIso(): ?string
    {
        if (!$this->dateValue || $this->dateValue === '0000-00-00 00:00:00') {
            return null;
        }

        try {
            /** @var Date $dateHelper */
            $dateHelper = $this->app->make('date');
            $date = $dateHelper->toDateTime((string) $this->dateValue, 'system', 'system');

            return $date ? $date->format('c') : null;
        } catch (Exception $e) {
            return null;
        }
    }
}
