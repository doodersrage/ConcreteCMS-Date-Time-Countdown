<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Form\Service\Form $form */
$form = app('helper/form');
/** @var \Concrete\Core\Form\Service\Widget\DateTime $datetime */
$datetime = app('helper/form/date_time');

$dateValue = $dateValue ?? null;
$expiredMessage = $expiredMessage ?? '';
?>

<fieldset>
    <legend><?php echo t('Countdown Settings'); ?></legend>

    <div class="mb-3">
        <?php echo $form->label('dateValue', t('Target date and time')); ?>
        <?php echo $datetime->datetime('dateValue', $dateValue); ?>
    </div>

    <div class="mb-3">
        <?php echo $form->label('expiredMessage', t('Message when countdown ends')); ?>
        <?php echo $form->textarea('expiredMessage', $expiredMessage, [
            'rows' => 3,
            'class' => 'form-control',
            'placeholder' => t('Event has passed. Please come back for future updates.'),
        ]); ?>
        <div class="form-text">
            <?php echo t('Shown when the countdown reaches zero. Leave blank to use the default message.'); ?>
        </div>
    </div>
</fieldset>
