<?php
  require_once "../main.php";
	include "inc/header.php";
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
						<h2 class="text-center">Manage Question</h2>
            <div class="manageQues">
              <table id="quesBody" class="table table-stripped">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Question</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="qBody">
                  <?php
                    $qSetId = htmlspecialchars($_GET['admQset']);
                    $res = $admin->getQuestion($qSetId);
                    if(!empty($res)){
                      $i = 0;
                      foreach ($res as $key) {
                  ?>
                  <tr>
                    <td><?php echo ++$i;?></td>
                    <td><?php echo $key['question'];?></td>
                    <td>
                      <button value="<?php echo 'qId='.$key['qId']."&qsetId=".$key['qsId'];?>" id="qEdit" class='btn btn-primary'>Edit</button>
                      <button value="<?php echo 'qId='.$key['qId']."&qsetId=".$key['qsId'];?>" id="qDelete" class='btn btn-danger'>Delete</button>
                    </td>
                  </tr>
                  <?php
                      }
                    }else{
                      echo "<tr><td colspan='3'>No Question Found.</td></tr>";
                    }
                  ?>
                </tbody>
              </table>
              <div class="text-center">
                <button id="addQbtn" class='btn btn-success text-center'>Add New Question in this Set</button>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

    <div id="editQues">
			<form id="eQues-content" action="" method="post">
				<div id="uSuccess" class="text-center alert alert-success"></div>
				<div id="uError" class="text-center alert alert-danger"></div>
				<h2 class="text-center">Update Question</h2>
				<div id="upQbody">

				</div>
			</form>
		</div>

    <div id="addQues">
			<form id="addQues-content" action="" method="post">
				<div id="addSuccess" class="text-center alert alert-success"></div>
				<div id="addError" class="text-center alert alert-danger"></div>
				<h2 class="text-center">Add Question</h2>
				<div id="addQbody">
          <div class='form-group'>
            <label>Question</label>
            <input class='form-control' type='text' name='Question'/>
          </div>
          <div class='form-group'>
            <label>Option (A)</label>
            <input class='form-control' type='text' name='Option_A'/>
          </div>
          <div class='form-group'>
            <label>Option (B)</label>
            <input class='form-control' type='text' name='Option_B'/>
          </div>
          <div class='form-group'>
            <label>Option (C)</label>
            <input class='form-control' type='text' name='Option_C'/>
          </div>
          <div class='form-group'>
            <label>Option (D)</label>
            <input class='form-control' type='text' name='Option_D'/>
          </div>
          <div class='form-group'>
            <label>Answer</label>
            <select name="Answer" class="form-control">
              <option value="">Slect Answer</option>
              <option value='a'>A</option>
              <option value='b'>B</option>
              <option value='c'>C</option>
              <option value='d'>D</option>
            </select>
            <input type="hidden" value="<?php echo $qSetId;?>" name="qSet"/>
          </div>
          <div class='form-group'>
            <input class='btn btn-primary' type='submit' value="Submit"/>
            <input class='btn btn-danger' id="cancel" type='submit' value="Cancel"/>
          </div>
        </div>
			</form>
		</div>
<?php
	include "../inc/footer.php";
?>
