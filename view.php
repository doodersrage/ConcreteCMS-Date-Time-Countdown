<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div
    class="ccm-block-date-counter counter-wrap counter-<?php echo (int) $bID; ?>"
    data-expired-message="<?php echo h($expiredMessage); ?>"
    data-invalid-message="<?php echo h(t('Invalid target date.')); ?>"
    <?php if ($targetDate) { ?>
        data-target-date="<?php echo h($targetDate); ?>"
    <?php } ?>
    aria-live="polite"
>
    <?php if (!$targetDate) { ?>
        <p class="counter-message"><?php echo t('No target date has been configured.'); ?></p>
    <?php } else { ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="days-cnt" aria-label="<?php echo t('Days'); ?>"></div>
                <label><?php echo t('DAYS'); ?></label>
            </div>
            <div class="col-sm-3">
                <div class="hours-cnt" aria-label="<?php echo t('Hours'); ?>"></div>
                <label><?php echo t('HOURS'); ?></label>
            </div>
            <div class="col-sm-3">
                <div class="minutes-cnt" aria-label="<?php echo t('Minutes'); ?>"></div>
                <label><?php echo t('MINUTES'); ?></label>
            </div>
            <div class="col-sm-3">
                <div class="seconds-cnt" aria-label="<?php echo t('Seconds'); ?>"></div>
                <label><?php echo t('SECONDS'); ?></label>
            </div>
        </div>
    <?php } ?>
</div>
