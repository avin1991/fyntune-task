<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>


<div class="container" style="margin-top: 50px;">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4" style="margin: 0 auto;">
			<?php $errorMsg = $this->session->userdata('errorMsg');?>
			<?php if(!empty($userdata)){?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<?php echo $errorMsg;?>
			</div>
		<?php }?>
	<form method="post" action="<?php echo base_url().'login/index';?>">

	<h3 align="center">Admin Login</h3>

		<div class="form-group">
			<label for="Username">Username:</label>
			
			<input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="<?php echo set_value('username');?>">
			<?php echo form_error('username');?>
		</div>
		
		<div class="form-group">
			<label for="pwd">Password:</label>
			
			<input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo set_value('password');?>">
			<?php echo form_error('password');?>
		</div>

		<!-- <button type="submit" class="btn btn-success">Submit</button> -->
		<?php echo form_submit(array('type'=>'submit','class'=>'btn btn-success btn-block btn-lg','value'=>'Submit'))?>
</form>
		
	</div>	
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>