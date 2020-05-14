<?php
	include "inc/header.php";
?>
			<section class="text-center" style="overflow:hidden;width:50%;margin:5% auto;">
				<div>
					<i style="font-size:12em;color:#4BB34B;" class="far fa-check-circle"></i>
          <h2>Your Score is: <?php
            if(!empty(Session::get("mark"))){
              echo Session::get("mark");
            }else{
              echo 0;
            }
          ?>%</h2>
          <a style='border:none;margin: 0;padding: 0;color:#337ab7;' href="home.php">Go Back to Home</a> or
          <a href="answers.php?qsetId=<?php echo Session::get("qsetId");?>">See Answers</a>
				</div>
			</section>
	<?php
		include "inc/footer.php";
	?>
