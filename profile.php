<?php
	// Get User Profile
	require_once "main.php";
	include "inc/header.php";
	$profile = $userObj->getProfile();
?>
			<section class="container" style="width:40%;margin:0 auto;">
				<div class="alert alert-danger" id="upError"></div>
				<div class="alert alert-success" id="upSuccess"></div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Update Profile<a href="home.php" class="btn btn-primary pull-right">Back</a></h3>
					</div>
					<div class="panel-body">
						<form id="profile_form">
							<?php
							  if(!empty($profile)){
									foreach ($profile as $key) {
							?>
							<div class="form-group">
								<label>Full Name</label>
								<input class="form-control" value="<?php echo $key['fullName'];?>" type="text" name="name"/>
								<input type="hidden" name="uId" class="form-control" value="<?php echo $key['uId'];?>"/>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" value="<?php echo $key['email'];?>" type="text" name="email"/>
							</div>
							<div class="form-group">
								<label>Old Password</label>
								<input class="form-control" placeholder="To Change Password (Optional)" type="password" name="password"/>
							</div>
							<div class="form-group">
								<label>New Password</label>
								<input class="form-control" placeholder="To Change Password (Optional)" type="password" name="repassword"/>
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" name="profile" value="Update"/>
							</div>
							<?php
									}
								}else{
									echo "Failed to Load Profile.";
								}
							?>
						</form>
					</div>
				</div>
			</section>
<?php
		include "inc/footer.php";
?>
