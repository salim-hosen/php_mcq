<?php
  require_once "../main.php";
	include "inc/header.php";

  $subjects = $ques->getSubjects();
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
							<div class="col-md-6">
                <form id="addSubject" action="" method="POST">
                  <div class="form-group">
                    <label>Add Subject</label>
                    <input type="text" name="subject" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="submit" name="addSub" value="Add" class="btn btn-primary"/>
                  </div>
                </form>
              </div>
              <div class="col-md-6" style="border-left: 1px solid #ddd;">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Subject Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody id="subBody">
                    <?php
                      if(!empty($subjects)){
                        foreach ($subjects as $key) {

                    ?>
                    <tr>
                      <td><input id="<?php echo $key['subId'];?>" class="form-control" type="text" value="<?php echo $sub = $key['subject'];?>"/></td>
                      <td>
                        <button value="<?php echo $key['subId'];?>" id="update" class="up btn btn-primary">Update</button>
                        <button value="<?php echo $key['subId'];?>" id="delete" class="del btn btn-danger">Delete</button>
                      </td>
                    </tr>
                    <?php
                        }
                      }else{
                        echo "<tr><td>No Subject Found.</td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
					</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
