<a href="javascript:void(0)" style="background: #e9ecef; margin-bottom: 2px;" class="<?php echo $colored?"coloredBG":""; ?>">
    <div class="mail-contnet">
        <h5><?php echo $employee->first_name .  ' '.$employee->last_name; ?> </h5> <span class="mail-desc"><?php echo type_to_text($atten->type); ?> at <?php echo date("h:i A",strtotime($atten->created_at)); ?></span> <span class="time">(<?php echo ago($atten->created_at); ?>)</span> </div>
</a>