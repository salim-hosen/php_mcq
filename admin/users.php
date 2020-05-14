<?php
  require_once "../main.php";
	include "inc/header.php";

  $users = $admin->getUsers();
?>
				<div class="panel panel-default" style="border-radius:0px 0px 6px 6px;">
					<div class="panel-body">
						<div id="users">
              <h2 class="text-center" style="padding: 20px 0">Manage Users</h2>
              <div class="user_data">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="userBody">
                    <?php
                      if(!empty($users)){
                        $i = 0;
                        foreach ($users as $key) {
                    ?>
                    <tr>
                      <td><?php echo ++$i;?></td>
                      <td><?php echo $key['fullName'];?></td>
                      <td><?php echo $key['email'];?></td>
                      <td><?php if($key['status'] === '1'){
                        echo "<b class='text-success'>Active</b>";
                      }else{
                        echo "<b class='text-danger'>Disabled</b>";
                      }?></td>
                      <td>
                        <?php
                          if($key['status'] === '1'){
                        ?>
                        <button id="disable" value="<?php echo $key['uId'];?>" class="btn btn-warning">Disable</button>
                      <?php }else{ ?>
                        <button id="enable" value="<?php echo $key['uId'];?>" class=" btn btn-primary">Enable</button>
                        <?php } ?>
                        <button id="delUser" value="<?php echo $key['uId'];?>" class="btn btn-danger">Delete</button>
                      </td>
                    </tr>
                    <?php
                        }
                      }else{
                        echo "<tr><td>No User Found.</td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>
<?php
	include "../inc/footer.php";
?>
