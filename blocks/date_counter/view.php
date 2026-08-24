<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var int $bID */
/** @var string|null $targetDate */
/** @var string $expiredMessage */
/** @var string $invalidMessage */
/** @var string $missingDateMessage */
?>

<div
    id="ccm-block-date-counter-<?php echo (int) $bID; ?>"
    class="ccm-block-date-counter"
    data-expired-message="<?php echo h($expiredMessage); ?>"
    data-invalid-message="<?php echo h($invalidMessage); ?>"
    <?php if ($targetDate) { ?>
        data-target-date="<?php echo h($targetDate); ?>"
    <?php } ?>
    aria-live="polite"
>
    <?php if (!$targetDate) { ?>
        <p class="ccm-block-date-counter__message"><?php echo h($missingDateMessage); ?></p>
    <?php } else { ?>
        <div class="ccm-block-date-counter__units" role="timer">
            <div class="ccm-block-date-counter__unit">
                <span class="ccm-block-date-counter__value days-cnt" aria-label="<?php echo t('Days'); ?>">0</span>
                <span class="ccm-block-date-counter__label"><?php echo t('Days'); ?></span>
            </div>
            <div class="ccm-block-date-counter__unit">
                <span class="ccm-block-date-counter__value hours-cnt" aria-label="<?php echo t('Hours'); ?>">00</span>
                <span class="ccm-block-date-counter__label"><?php echo t('Hours'); ?></span>
            </div>
            <div class="ccm-block-date-counter__unit">
                <span class="ccm-block-date-counter__value minutes-cnt" aria-label="<?php echo t('Minutes'); ?>">00</span>
                <span class="ccm-block-date-counter__label"><?php echo t('Minutes'); ?></span>
            </div>
            <div class="ccm-block-date-counter__unit">
                <span class="ccm-block-date-counter__value seconds-cnt" aria-label="<?php echo t('Seconds'); ?>">00</span>
                <span class="ccm-block-date-counter__label"><?php echo t('Seconds'); ?></span>
            </div>
        </div>
    <?php } ?>
</div>
