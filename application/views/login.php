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
  </head>
  <body>
    <div class="container">
    	<div class="col-md-4 col-md-offset-3">
    		<div class="page-header">Simple Trello</div>
    	</div>
    	<div class="clearfix"></div>
    	<div class="col-md-4 col-md-offset-3">
    		<form method="POST" action="<?php echo site_url('login/validate');?>">
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-success">Login</button>
			</form>
			<!-- showing error validation form-->
			<?php if(validation_errors()): ?>
			<p class="text-danger"><?php echo validation_errors();?></p>
			<?php endif; ?>
			<!-- end showing error validation form-->
    	</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  </body>
</html>