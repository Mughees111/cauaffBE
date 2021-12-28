<li class="<?php echo $msg->sender_id==$user->id?'':"reverse"; ?>">

    <?php if($msg->sender_id==$user->id){ ?>
     <div class="chat-img"><img src="<?php echo base_url()."resources/backend/images/"; ?>users/dummy.png" alt="user" /></div>
    <?php } ?>
    <div class="chat-content">
        <h5><?php 

        if($msg->sender_id!=$user->id) echo "Admin"; else

         echo $user->first_name.' ' .$user->last_name; ?></h5>
        <div class="box bg-light-info"><?php echo $msg->msg; ?></div>
        <div class="chat-time"><?php echo date("d, F h:i A",strtotime($msg->created_at)); ?></div>
    </div>



    <?php if($msg->sender_id!=$user->id){ ?>
     <div class="chat-img"><img src="<?php echo base_url()."resources/backend/images/"; ?>users/dummy.png" alt="user" /></div>
    <?php } ?>
</li>