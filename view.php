<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div class="counter-wrap counter-<?php echo $bID?>">
    <div class="row">
        <div class="col-sm-3">
            <div class="days-cnt"></div>
            <label>DAYS</label>
        </div>
        <div class="col-sm-3">
            <div class="hours-cnt"></div>
            <label>HOURS</label>
        </div>
        <div class="col-sm-3">
            <div class="minutes-cnt"></div>
            <label>MINUTES</label>
        </div>
        <div class="col-sm-3">
            <div class="seconds-cnt"></div>
            <label>SECONDS</label>
        </div>
    </div>
</div>

<script>

    $(function(){
        counter.vars.date = new Date('<?php echo $dateValue; ?>');
        counter.vars.counterID = '.counter-<?php echo $bID?>',
        counter.initCounter();
    });
    
</script>