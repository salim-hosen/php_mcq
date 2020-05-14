<?php
	require_once "main.php";

		// Get Questions of Exam
		if(isset($_GET['qsetId'])){
			$qsetId = htmlspecialchars($_GET['qsetId']);
			$totalQues = 0;
			$questions = $ques->getQuestions($qsetId);
			if(!empty($questions)){
				foreach ($questions as $key) {
					$totalQues++;
				}
			}
		}else{
			header("Location: error.php");
			exit();
		}

	include "inc/header.php";

?>
			<section class="container">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Total Questions: <?php echo $totalQues;?><a href="questions.php" class="btn btn-primary pull-right">Back</a></h3>
					</div>
					<div class="panel-body">
						<form action="main.php" method="POST">
						<?php
							if(!empty($questions)){
								$i = 1;
								foreach ($questions as $key) {
						?>
						<div class="ques_no">
							<h4><?php echo $i++.". ".$key['question'];?></h4>
							<?php
								$options = $ques->getOptions($key['qId']);
								if(!empty($options)){
									foreach ($options as $key2) {
							?>
							<div class="options">
								<div>
									<input type="radio" value="<?php echo $key2['opId'];?>" name="<?php echo $key2['qId'];?>"/><?php echo $key2['options'];?>
								</div>
							</div>
							<?php
									}
								}else{
									echo "Database Error. No Options Found.<br/>";
								}
							?>
						</div>
						<?php
								}
								?>
								<input type="hidden" name="qsetId" value="<?php echo $_GET['qsetId'];?>"/>
								<input type="submit" name="submit_ans" class="btn btn-primary" value="Submit"/>
							<?php
							}else{
								echo "No Question Found for this Question set.<br/>";
							}
						?>
						</form>
					</div>
				</div>
			</section>
<?php
	include "inc/footer.php";
?>
