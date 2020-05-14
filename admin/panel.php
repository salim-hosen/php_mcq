<?php
	include "inc/header.php";
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
						<div class="panel-body text-center" style="padding: 5%;">
							<h2>Welcome, <?php echo Session::get("admName");?></h2>
							<p>You are Logged in as Admin</p>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
