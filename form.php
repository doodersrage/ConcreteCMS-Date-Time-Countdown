<?php defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Form\Service\Widget\DateTime $datetime */
$datetime = app('helper/form/date_time');
?>
<fieldset>
    <legend><?php echo t('Target Date'); ?></legend>
    <?php echo $datetime->datetime('dateValue', $dateValue); ?>
</fieldset>
