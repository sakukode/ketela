<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple Trello</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Simple Trello</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->session->userdata('name');?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                <li><a href="<?php echo site_url('login/logout');?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <!-- form add list -->
      <div class="row">
        <div class="col-md-4">
          <h4>Add New List</h4>
          <form class="form-inline" method="POST" action="<?php echo site_url('home/addList');?>">
            <div class="form-group">            
              <input type="text" class="form-control" name="list-title" id="list-title" placeholder="Title">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
          </form>
          <!-- show form error-->
          <?php if(isset($list_error)): ?>
          <p><?php echo $list_error; ?></p>
          <?php endif; ?>
          <!-- end show form error-->
          <!-- show success message-->
          <?php if($this->session->flashdata('success_list')): ?>
          <br>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success_list'); ?>
          </div>
          <?php endif;?>
          <!-- end show success message-->
        </div>
      </div>
      <!-- end form add list-->
      <!-- content lists -->
      <div class="row">
        <div class="col-md-12">
          <hr>
          <!-- show form error-->
          <?php if(isset($card_error)): ?>
          <p><?php echo $card_error; ?></p>
          <?php endif; ?>
          <!-- end show form error-->
          <!-- show success message-->
          <?php if($this->session->flashdata('success_card')): ?>
          <br>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success_card'); ?>
          </div>
          <?php endif;?>
          <!-- end show success message-->

          <?php if($lists != null): ?>
          <?php foreach($lists as $list): ?>
          <!-- content a list-->
          <div class="col-md-3">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><?php echo $list->title;?></div>
              <!-- cards -->
              <?php if($cards != null): ?>
              <?php foreach($cards as $card): ?>
              <ul class="list-group">
                <?php if($card->listId == $list->id): ?>
                <li class="list-group-item"><?php echo $card->title;?>
                  <span class="pull-right">
                    <a href="#" class="btnViewDetail" data-url="<?php echo site_url('home/viewCardDetail/'.$card->id);?>"><i class="glyphicon glyphicon-eye-open" aria-hidden="true" title="view"></i></a>
                    <a href="#"><i class="glyphicon glyphicon-edit" aria-hidden="true" title="edit"></i></a>
                    <a href="#" class="btnAddMember" data-cardId="<?php echo $card->id;?>"><i class="glyphicon glyphicon-user" aria-hidden="true" title="add member"></i></a>
                    <a href="#" class="btnAddAttachment" data-cardId="<?php echo $card->id;?>"><i class="glyphicon glyphicon-paperclip" aria-hidden="true" title="attachments"></i></a>
                    <a href="#"><i class="glyphicon glyphicon-remove" aria-hidden="true" title="remove"></i></a>
                  </span>
                </li>
                <?php endif; ?>
              </ul>
              <?php endforeach; ?>
              <?php endif; ?>
              <!-- end cards -->
              <div class="panel-footer"><button class="btn btn-success btn-sm btn-addCard" data-listId="<?php echo $list->id;?>">add card</button></div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
          <!-- content a list-->
        </div>
      </div>
      <!-- end content lists -->
    </div>

    <!-- modal form add card -->
    <!-- Modal -->
    <div class="modal fade" id="cardFormModal" tabindex="-1" role="dialog" aria-labelledby="cardFormLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="<?php echo site_url('home/addCard');?>">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="cardFormModal">Add Card</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" id="list-id" name="list-id" />
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="card-title" name="card-title" class="form-control" placeholder="Card Title" />
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal form add card -->

    <!-- modal view card details -->
    <div class="modal fade" id="cardViewModal" tabindex="-1" role="dialog" aria-labelledby="cardViewLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="cardFormModal"><span class="view-cardTitle"></span> <small class="view-cardListTitle"></small></h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                 <h4 class="view-cardTitle"></h4>
                 <span>Members :</span> 
                 <p class="view-cardMemberList">
                 </p>
               
                 <p id="view-cardDescription"></p>
                 <hr>

                 <h4>Attachments</h4>
                 <p class="view-cardAttachmentList">

                 </p>
                 <hr> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal view card details -->

    <!-- modal form add member -->
    <!-- Modal -->
    <div class="modal fade" id="memberFormModal" tabindex="-1" role="dialog" aria-labelledby="cardFormLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="<?php echo site_url('home/addMember');?>" id="form-member">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="memberFormModal">Add Member</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" id="card-id" name="card-id" />
              <div class="form-group">
                <label for="title">Member name</label>
                <select class="form-control" name="user">
                  <?php if($users != null): ?>
                    <?php foreach($users as $user): ?>
                      <option value="<?php echo $user->id;?>"><?php echo $user->name; ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <span class="alert alert-danger" id="member-error" style="display:none"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal form add member -->

    <!-- modal form add attachment -->
    <!-- Modal -->
    <div class="modal fade" id="attachmentFormModal" tabindex="-1" role="dialog" aria-labelledby="cardFormLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="<?php echo site_url('home/addAttachment');?>" id="form-attachment">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="attachmentFormModal">Add Attachment</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" id="card-id-attachment" name="card-id" />
              <div class="form-group">
                <label for="title">Please select file</label>
                <input type="file" class="form-control" name="file" id="file" />
              </div>
              <span class="alert alert-danger" id="attachment-error" style="display:none"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal form add attachment -->
    
   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script>
      $(function() {

          //open form add card
          $('.btn-addCard').click(function() {
            var listId = $(this).attr('data-listId');
            
            //set list id in form add card
            if(listId)
              $('#list-id').val(listId);
            
            $('#cardFormModal').modal();
          });

          $('.btnAddMember').click(function() {
            var cardId = $(this).attr('data-cardId');
            
            //set list id in form add card
            if(cardId)
              $('#card-id').val(cardId);
            
            $('#memberFormModal').modal();
          });

          $('.btnAddAttachment').click(function() {
            var cardId = $(this).attr('data-cardId');
            
            //set list id in form add card
            if(cardId)
              $('#card-id-attachment').val(cardId);
            
            $('#attachmentFormModal').modal();
          });

          $('#form-member').submit(function(event) {
              console.log("add member");
              event.preventDefault();
              $('#member-error').text("");
              $('#member-error').fadeOut();
              $.post(
                this.action,
                $(this).serialize(),
                function(data) {
                  if(data.status == true) {
                    location.reload();
                  } else {
                    $('#member-error').text(data.error);
                        $('#member-error').fadeIn();

                        setTimeout(function(){ $('#member-error').fadeOut() }, 5000);
                  }
                },
                "json"
              );
          });

          $('#form-attachment').submit(function(event) {
              event.preventDefault();
              $('#attachment-error').text("");
              $('#attachment-error').fadeOut();
              var formData = new FormData($(this)[0]);
              $.ajax({
                url:$(this).attr("action"),
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (data) {
                    if(data.status == false){
                        $('#attachment-error').text(data.error);
                        $('#attachment-error').fadeIn();

                        setTimeout(function(){ $('#attachment-error').fadeOut() }, 5000);
                    }else {
                        location.reload();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
              });
              return false;
          });

          $(".btnViewDetail").click(function(){
              $.get($(this).attr('data-url'), function(data, status){
                  if(data.status == false) {
                    
                  } else {
                    //set detail
                    var model = data.model;
                    var members = data.members;
                    var attachments = data.attachments;
                    $('.view-cardListTitle').html("in " + model.listTitle);
                    $('.view-cardTitle').html(model.title);
                    $('#view-cardDescription').html(model.description);
                    //each member list
                    if(members != null) {
                      $('.view-cardMemberList').html("");
                      members.forEach(function(obj) {
                        $('.view-cardMemberList').append('<span class="label label-success">' +obj.username+ '</span>&nbsp;');
                      });
                    } 

                    //each attachment list
                    if(attachments != null) {
                      $('.view-cardAttachmentList').html("");
                      attachments.forEach(function(obj) {
                        $('.view-cardAttachmentList').append('<a href="public/file/'+obj.filename+'" target="_BLANK">' +obj.filename+ '</a><br />');
                      });
                    }

                    $('#cardViewModal').modal();
                  }
              },"json");
          });

      });
    </script>
  </body>
</html>