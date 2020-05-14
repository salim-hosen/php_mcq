<?php
  require_once "../main.php";
	include "inc/header.php";

  $subjects = $ques->getSubjects();
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
							<div class="col-md-4">
                  <div class="form-group">
                    <label>Select Subject</label>
                    <select form="addQuestion" name="subject" class="form-control">
                      <option value="">Select Subject</option>
                      <?php
                        if(!empty($subjects)){
                          foreach ($subjects as $key) {
                      ?>
                      <option value="<?php echo $key['subId'];?>"><?php echo $key['subject'];?></option>
                      <?php
                          }
                        }else{
                          echo "No Subjects Found.";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Question Set Name</label>
                    <input type="text" name="qSet" form="addQuestion" placeholder="Enter Question Name" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>How Many?</label>
                    <input type="number" value="1" max="50" id="amount" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Add" id="subAmount" class="btn btn-primary"/>
                  </div>
              </div>
              <div class="col-md-8" style="border-left: 1px solid #ddd;">
                <form action="" method="post" id="addQuestion">
                  <table style="width:100%;">
                    <tbody id="quesList">
                      <tr id="msg"><td colspan="2">Select How Many Question You want to Add?</td></tr>
                    </tbody>
                  </table>
                  <div class="text-center">
                    <input id="submitQues" type="submit" class="btn btn-primary" value="Submit"/>
                  </div>
                </form>
              </div>
						</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
