<?php
  require_once "../main.php";
	include "inc/header.php";
  $subjects = $ques->getSubjects();
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
            <div class="manageQset">
              <div class="selectSubject">
                <div class="form-group form-horizontal" style="width: 40%;margin:0 auto;">
                  <label class="col-sm-4" style="margin-top:5px;">Select Subject</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="sub">
                      <option>Select Subject</option>
                      <?php
                        if(!empty($subjects)){
                          foreach ($subjects as $key) {
                            echo "<option value='".$key['subId']."'>".$key['subject']."</option>";
                          }
                        }else{
                          echo "<option>No Subject Found.</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="qsetTable">
                <div>
                  <table class="table table-stripped">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Set Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="qsetBody">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
