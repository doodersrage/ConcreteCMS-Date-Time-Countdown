<?php defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Form\Service\Widget\DateTime $datetime */
$datetime = app('helper/form/date_time');
/** @var \Concrete\Core\Form\Service\Form $form */
$form = app('helper/form');
?>
<fieldset>
    <legend><?php echo t('Target Date'); ?></legend>
    <?php echo $datetime->datetime('dateValue', $dateValue); ?>
</fieldset>

<fieldset>
    <legend><?php echo t('End Message'); ?></legend>
    <div class="form-group">
        <?php echo $form->label('expiredMessage', t('Message when countdown ends')); ?>
        <?php echo $form->textarea('expiredMessage', $expiredMessage, ['rows' => 3]); ?>
        <small class="form-text text-muted">
            <?php echo t('Shown when the countdown reaches zero. Leave blank to use the default message.'); ?>
        </small>
    </div>
</fieldset>
