<?php
	require_once "main.php";
	include "inc/header.php";
?>
			<section class="main-content" style="margin:0 auto;width:100%;padding:0;">
				<div class="container panel panel-default">
					<div class="ques_page panel-body">
						<div class="ques_cat col-md-3">
							<h3>Subjects</h3>
							<nav>
								<ul class="nav nav-pills nav-stacked" id="subject">
									<?php
										$subId = "";
										$i = 0;
										// Get Subjects
										$subjects = $ques->getSubjects();

										if(!empty($subjects)){
											foreach ($subjects as $key) {

									?>
									<li <?php
									if($i==0){
										echo "class='active'";
										$subId = $key['subId'];
									}?>><a href="" id="<?php echo $key['subId'];?>"><?php echo $key['subject'];?></a></li>
									<?php
										$i++;
											}
										}
									?>
								</ul>
							</nav>
						</div>
						<div class="questions col-md-9" style="border-left: 1px solid #ccc;">
							<h3>Question Set<a href="home.php" class="btn btn-primary pull-right">Back</a></h3>
							<table class="table table-stripped">
								<tbody id="qSet">
									<?php
										$qSet = $ques->getQset($subId);
										if(!empty($qSet)){
											foreach ($qSet as $key) {
									?>
									<tr>
										<td><a href="quesPage.php?qsetId=<?php echo $key['qsId'];?>"><?php echo $key['qsName'];?></a></td>
									</tr>
									<?php
											}
										}else{
									?>
											<tr>
												<td>No Question Available for this Subject.</td>
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
<?php
		include "inc/footer.php";
?>
