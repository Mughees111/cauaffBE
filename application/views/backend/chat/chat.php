<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Chat</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url."admin";?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="chat-main-box">
                                <!-- .chat-left-panel -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                                    <div class="chat-left-inner">
                                        <div class="form-material">
                                            <input class="form-control p-2" type="text" placeholder="Search Contact">
                                        </div>
                                        <ul class="chatonline style-none ">

                                            <?php foreach($chats as $chat){
                                                $user = $this->db->where("id",$chat->user_id)->get("users")->result_object()[0];
                                             ?>
                                                <li>
                                                    <a href="<?php echo $chat->user_id!=$user_id? base_url()."admin/chat/chat/".$chat->user_id: 'javascript:;';  ?>" class="<?php if($chat->user_id==$user_id) echo 'active'; ?>"><img src="<?php echo base_url()."resources/backend/images/"; ?>users/dummy.png" alt="user-img" class="img-circle"> <span><?php echo $user->first_name .' '.$user->last_name; ?></span></a>
                                                </li>
                                            <?php } ?>
                                           
                                            <li class="p-20"></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-3 b-b">
                                            <h4 class="box-title">Chat Message</h4>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-3">


                                            <?php $msgs= $this->db->where("user_id",$user_id)->get("chat")->result_object(); ?>
                                            <!--chat Row -->

                                            <?php foreach($msgs as $msg){
                                                echo get_chat_elem($msg,$user);
                                             ?>

                                        <?php } ?>
                                            <!--chat Row -->
                                          
                                        </ul>
                                    </div>
                                    <div class="card-body border-top">
                                        <div class="row">
                                            <div class="col-8">
                                                <textarea id="newmsg" placeholder="Type your message here" class="form-control border-0"></textarea>
                                            </div>
                                            <div class="col-4 text-right">

                                                <button id="sender_place" type="button" class="btn btn-info btn-circle btn-lg" style="display: none;"><i style="font-size: 14px; " class="fa fa-spinner fa-pulse fa-3x fa-fw"></i> </button>
                                                <button onclick="sendMsg(this)" type="button" class="btn btn-info btn-circle btn-lg"><i class="fa fa-paper-plane"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<script type="text/javascript">
  var chat_user_id = <?php echo $user_id; ?>;
</script>

<style type="text/css">
    /*
Template Name: Admin Template
Author: Wrappixel

File: scss
*/
@import url(https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700);
/*Theme Colors*/
/**
 * Table Of Content
 *
 *  1. Color system
 *  2. Options
 *  3. Body
 *  4. Typography
 *  5. Breadcrumbs
 *  6. Cards
 *  7. Dropdowns
 *  8. Buttons
 *  9. Typography
 *  10. Progress bars
 *  11. Tables
 *  12. Forms
 *  14. Component
 */
/*******************
chat application Page
******************/
.chat-main-box {
  position: relative;
  overflow: hidden; }
  .chat-main-box .chat-left-aside {
    position: relative;
    width: 250px;
    float: left;
    z-index: 9;
    top: 0px;
    border-right: 1px solid #e9ecef; }
    .chat-main-box .chat-left-aside .open-panel {
      display: none;
      cursor: pointer;
      position: absolute;
      left: -webkit-calc(100% - 1px);
      top: 50%;
      z-index: 100;
      background-color: #fff;
      -webkit-box-shadow: 1px 0 3px rgba(0, 0, 0, 0.2);
      box-shadow: 1px 0 3px rgba(0, 0, 0, 0.2);
      border-radius: 0 100px 100px 0;
      line-height: 1;
      padding: 15px 8px 15px 4px; }
    .chat-main-box .chat-left-aside .chat-left-inner {
      position: relative; }
      .chat-main-box .chat-left-aside .chat-left-inner .chatonline {
        position: relative;
        height: 100%; }
      .chat-main-box .chat-left-aside .chat-left-inner .form-control {
        height: 60px;
        padding: 15px;
        background-image: linear-gradient(#03a9f3, #03a9f3), linear-gradient(#e9ecef, #e9ecef); }
      .chat-main-box .chat-left-aside .chat-left-inner .style-none {
        padding: 0px; }
        .chat-main-box .chat-left-aside .chat-left-inner .style-none li {
          list-style: none;
          overflow: hidden; }
          .chat-main-box .chat-left-aside .chat-left-inner .style-none li a {
            padding: 20px; }
            .chat-main-box .chat-left-aside .chat-left-inner .style-none li a:hover, .chat-main-box .chat-left-aside .chat-left-inner .style-none li a.active {
              background: #f8f9fa; }
  .chat-main-box .chat-right-aside {
    width: calc(100% - 250px);
    float: left; }
    .chat-main-box .chat-right-aside .chat-rbox {
      height: auto;
      position: relative; }
    .chat-main-box .chat-right-aside .chat-list {
      max-height: none;
      height: 100%;
      padding-top: 40px; }
      .chat-main-box .chat-right-aside .chat-list .chat-text {
        border-radius: 6px; }
      .chat-main-box .chat-right-aside .chat-list li .chat-time {
        display: block;
        text-align: left; }
      .chat-main-box .chat-right-aside .chat-list li.reverse .chat-time {
        margin-left: auto;
        text-align: right; }
    .chat-main-box .chat-right-aside .send-chat-box {
      position: relative; }
      .chat-main-box .chat-right-aside .send-chat-box .form-control {
        border: none;
        border-top: 1px solid #e9ecef;
        resize: none;
        height: 80px;
        padding-right: 180px; }
        .chat-main-box .chat-right-aside .send-chat-box .form-control:focus {
          border-color: #e9ecef; }
      .chat-main-box .chat-right-aside .send-chat-box .custom-send {
        position: absolute;
        right: 20px;
        bottom: 10px; }
        .chat-main-box .chat-right-aside .send-chat-box .custom-send .cst-icon {
          color: #212529;
          margin-right: 10px; }
</style>