<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->

  <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
</head>

<body>
<form action="https://sandbox.payfast.co.za/eng/process" method="POST">

<input type="hidden" name="merchant_id" value="<?php echo $the_iid; ?>">
<input type="hidden" name="merchant_key" value="<?php echo $the_key; ?>">
<input type="hidden" name="return_url" value="<?php echo base_url()."api/payfast_is_good/".$user->id."/".$total; ?>">
<input type="hidden" name="cancel_url" value="<?php echo base_url()."api/paypal_is_bad"; ?>">
<input type="hidden" name="notify_url" value="<?php echo base_url()."api/complete_payfast"; ?>">
<input type="hidden" name="name_first" value="<?php echo explode(" ",$user->name)[0]; ?>">
<input type="hidden" name="name_last" value="<?php echo explode(" ",$user->name)[1]; ?>">
<input type="hidden" name="email_address" value="<?php echo $user->email; ?>">
<input type="hidden" name="cell_number" value="<?php echo $user->phone; ?>">



<input type="hidden" name="m_payment_id" value="<?php echo $user->id; ?>">
<input type="hidden" name="amount" value="<?php echo $to_charge; ?>">
<input type="hidden" name="item_name" value="Topup">
<input type="hidden" name="custom_str1" value="<?php echo $total; ?>">

<input type="submit" name="submit" value="Pay Now" style="

width: 100%;
    float: left;
    padding: 14px 50px;
    color: #fff;
    border: 0;
    background-color: #CD1073;
    border-radius: 20px;
    font-size: 40px;
">
</form>
</body>