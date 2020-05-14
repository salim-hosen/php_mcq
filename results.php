<?php
 	require_once "main.php";
	include "inc/header.php";

	// Get User Results
	$userRes = $ques->getUserResults();
?>
			<section class="container" style="width:80%;margin:0 auto;">
				<div class="alert alert-success" style="display:none;" id="delSuccess"></div>
				<div class="alert alert-danger" style="display:none;" id="delError"></div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Your Results<a href="home.php" class="btn btn-primary pull-right">Back</a></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-stripped">
								<thead>
									<th>Serial</th>
									<th>Subject</th>
									<th>Question Name</th>
									<th>Date</th>
									<th>Score</th>
									<th>Action</th>
								</thead>
								<tbody id="result">
									<?php
										if(!empty($userRes)){
											$i = 1;
											foreach ($userRes as $key) {

									?>
									<tr id="<?php echo $key['resId'];?>">
										<td><?php echo $i++;?></td>
										<td><?php echo $key['subject'];?></td>
										<td><?php echo $key['qset'];?></td>
										<td><?php echo $key['date'];?></td>
										<td><?php echo $key['score'];?>%</td>
										<td><button onclick="delFun(<?php echo $key['resId'];?>);" class="btn btn-danger">Delete</button></td>
									</tr>
									<?php
											}
										}else{
									?>
									<tr>
										<td colspan="6">No Results Found.</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
			<section id="alert">
				<div class="text-center" id="alert-content">
					<p>Are you Sure to Delete?</p>
					<input type="submit" class="btn btn-danger" id="yes" value="Delete"/>
					<input type="submit" class="btn btn-success" id="no" value="Cancel"/>
				</div>
			</section>
<?php
	include "inc/footer.php";
?>
