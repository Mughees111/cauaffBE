<!DOCTYPE html>
<html>
<head>
	<title>YouDeh</title>
  <style type="text/css">
    video{
      float: left;
      width: 100%;
    }
  </style>
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>

	<script src="//media.twiliocdn.com/sdk/js/video/releases/2.7.1/twilio-video.min.js"></script>
  <style type="text/css">
    video{
      
    }
  </style>

</head>
<body style="float: left;width: 100%;">
<!-- <a href=""
style="position: fixed;
    bottom: 10px;
    right: 10px;
    background: red;
    color: white;
    padding: 8px 20px;
    font-family: arial;
    text-decoration: none;
    font-size: 20px;
    border-radius: 5px;
" 

><?php //echo $user->id==$party->user_id?"End Party":"Leave Party"; ?></a> -->

<div style="float: left;width: 100%;margin-bottom: 10px;" id="remote-media-div" class="remote-media-div"></div>
<div id="local-media" style="

float: left;margin-right: 5px;margin-bottom: 5px;
      border:1px solid green;
      width: auto;
      max-width: 49%;
      text-align: center;
      position: relative;


">
  

  <div class="name_comes_here" style="width: 100%; float: left;padding: 4px 0px; text-align: center;position: absolute;bottom: 0;left: 0;

  background: #00000075;
    color: #fff;
    font-family: arial;

  ">My Feed</div>
</div>



<div id="useMe" style="

float: left;margin-right: 5px;margin-bottom: 5px;
      border:1px solid green;
      width: auto;
      max-width: 49%;
      text-align: center;
      position: relative;

">
  

  <div class="name_comes_here" style="    width: 100%;
    float: left;
    padding: 4px 0px;
    text-align: center;
    position: absolute;
    bottom: 0;
    left: 0;
    background: #00000075;
    color: #fff;
    font-family: arial;"></div>
</div>
</body>

<script type="text/javascript">
	
	// const { connect } = require('twilio-video');
	const Video = Twilio.Video;
  const divIside = document.getElementById('remote-media-div');

Video.createLocalVideoTrack().then(track => {
  const localMediaContainer = document.getElementById('local-media');


  localMediaContainer.appendChild(track.attach());
});

 Video.connect('<?php echo $room_token; ?>', { name:'<?php echo $room; ?>' }).then(room => {
  console.log('Connected to Room "%s"', room.name);
  console.log(room);
  $.post("<?php echo base_url()."api/update_room_sid"; ?>",{party_id:<?php echo $party->id; ?>,sid:room.sid},function(){

  });
  room.participants.forEach(participantConnected);
  room.on('participantConnected', participantConnected);

  room.on('participantDisconnected', participantDisconnected);
  room.once('disconnected', error => room.participants.forEach(participantDisconnected));
});

function participantConnected(participant) {
  console.log('Participant "%s" connected', participant.identity);

  var timeId = $("#useMe").clone();

  
  timeId.id = participant.sid;

  $.post("<?php echo base_url()."api/get_name/"; ?>"+participant.identity,{id:participant.identity},function(dataName){

    // div.innerText = participant.identity;

    timeId.find(".name_comes_here").html(dataName);

    $("#remote-media-div").append(timeId);

    participant.on('trackSubscribed', track => trackSubscribed(timeId, track));
    participant.on('trackUnsubscribed', trackUnsubscribed);

    participant.tracks.forEach(publication => {
      if (publication.isSubscribed) {
        trackSubscribed(timeId, publication.track);
      }
    });

    // document.body.appendChild(div);

  });
  
}

function participantDisconnected(participant) {
  console.log('Participant "%s" disconnected', participant.identity);
  document.getElementById(participant.sid).remove();
}

function trackSubscribed(div, track) {
  div.append(track.attach());
  // ;
}

function trackUnsubscribed(track) {
  track.detach().forEach(element => element.remove());
}
setTimeout(function(){
  $.post("<?php echo base_url()."api/check_party_ended_web/".$party->id."/".$user->id; ?>",{id:1},function(data){
    if(data=="end")
    {
      Alert("Party has been ended by the host, Please return to the app.");
    }
  });
},2000);


</script>
</html>