<?php
  require_once "../main.php";
	include "inc/header.php";
  $subjects = $ques->getSubjects();
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
						<h2 class="text-center">Get Questions</h2>
            <form id="getQues" style="width: 35%;margin:3% auto;">
              <div class="form-group">
                <label>Subject</label>
                <select id="selcSubject" name="selcSubject" class="form-control">
                  <option value="">Select Subject</option>
                  <?php
                    if(!empty($subjects)){
                      foreach ($subjects as $key) {
                  ?>
                  <option value="<?php echo $key['subId'];?>"><?php echo $key['subject'];?></option>
                  <?php
                      }
                    }else{
                      echo "<option value=''>No Subject Found.</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Question Set</label>
                <select id="admQset" name="admQset" class="form-control">
                  <option value="">Select Question Set</option>
                </select>
              </div>
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary"/>
              </div>
            </form>
					</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
