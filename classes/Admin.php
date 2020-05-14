<?php
  class Admin{
    private $db;
    private $valid;

    public function __construct($db,$validate){
      $this->db = $db;
      $this->valid = $validate;
    }

    public function adminLogin(){
      $this->valid->validate("email")->isEmpty()->checkEmail();
      $this->valid->validate("password")->isEmpty();
      if($this->valid->submit()){
        $sql = "select * from tbl_admin where email=:email and password=:password";
        $data = array("email" => $this->valid->value['email'],"password" => md5($this->valid->value["password"]));
        $res = $this->db->execQuery($sql,$data,"select");
        if($res){
          Session::init();
          Session::set("admLogin",true);
          Session::set("admName",$res[0]['fullName']);
          Session::set("adminId",$res[0]['admId']);
          echo "success";
          exit();
        }else{
          echo "Username and Password doesn't Match.";
          exit();
        }
      }else{
        echo "Something Wrong.";
        exit();
      }
    }

    public function getProfile(){
      Session::init();
      $id = Session::get("adminId");
      if(!empty($id)){
        $sql = "select * from tbl_admin where admId = :admId";
        $data = array("admId" => $id);
        $res = $this->db->execQuery($sql,$data,"select");
        if($res){
          $res = json_encode($res);
          echo $res;
          exit();
        }else{
          echo "fail";
          exit();
        }
      }else{
        echo "fail";
        exit();
      }
    }

    public function updateProfile(){
      Session::init();
      $id = Session::get("adminId");
      $this->valid->validate("email")->isEmpty()->checkEmail()->isExistsAdmin($id);
      $this->valid->validate("name")->isEmpty()->checkLength();

      $password = htmlspecialchars($_POST['password']);

      if(empty($password) && $this->valid->submit()){
        $sql = "update tbl_admin set fullName = :fullName,email=:email where admId=:admId";
        $data = array(
          "fullName" => $this->valid->value['name'],
          "email" => $this->valid->value['email'],
          "admId" => $id
        );
        $res = $this->db->execQuery($sql,$data,"update");
        if($res){
          echo "success";
          exit();
        }else{
          echo "Failed to Update.";
          exit();
        }
      }else{
        $this->valid->validate("password")->checkLength();
        $sql = "update tbl_admin set fullName = :fullName,email=:email,password=:password where admId=:admId";
        $data = array(
          "fullName" => $this->valid->value['name'],
          "email" => $this->valid->value['email'],
          "password" => md5($this->valid->value['password']),
          "admId" => $id
        );
        $res = $this->db->execQuery($sql,$data,"update");
        if($res){
          echo "success";
          exit();
        }else{
          echo "Failed to Update.";
          exit();
        }
      }
    }

    public function insertQuestion(){

      $this->valid->validate("subject")->isEmpty();
      $this->valid->validate("qSet")->isEmpty();

      $sql = "select * from tbl_quesset where qsName=:qsName";
      $data = array("qsName" => $this->valid->value['qSet']);
      $res = $this->db->execQuery($sql,$data,"select");

      if($res){
        echo "Question Set Already Exists";
        exit();
      }

      $sql = "insert into tbl_quesset(subId,qsName)values(:subId,:qsName)";
      $data = array("subId" => $this->valid->value['subject'],"qsName" => $this->valid->value['qSet']);
      $res = $this->db->execQuery($sql,$data,"insert");
      $qslastId = $this->db->con->lastInsertId();

      foreach ($_POST as $fkey => $value) {
        if($fkey === "subject" || $fkey === "qSet")continue;
        $lastId = "";
        foreach ($value as $key => $v) {
          if($v === ""){
            echo "Please Fill up All the Field.";
            exit();
          }else if($key === 0){
            $sql = "insert into tbl_question(qsId,question)values(:qsId,:question)";
            $data = array("qsId" => $qslastId,"question" => $v);
            $this->db->execQuery($sql,$data,"insert");
            $lastId = $this->db->con->lastInsertId();
          }else if($key > 0 && $key < 5){
            $ans = strtolower($value[5]);
            $sql = "insert into tbl_options(qId,options,ans,qsetId)values(:qId,:options,:ans,:qsetId)";
            $data = array();
            if(($key === 1 && $ans === "a") || ($key === 2 && $ans === "b") || ($key === 3 && $ans === "c") || ($key === 4 && $ans === "d")){
              $data = array("qId" => $lastId,"options" => $v,"ans"=>'1',"qsetId" => $qslastId);
            }else {
              $data = array("qId" => $lastId,"options" => $v,"ans"=>'0',"qsetId" => $qslastId);
            }
            $res = $this->db->execQuery($sql,$data,"insert");
          }
        }
      }
      if($res){
        echo "success";
        exit();
      }else{
        echo "Failed to Insert Question.";
        exit();
      }
    }

    public function getSubjects(){
      $sql = "select * from tbl_subject";
      $res = $this->db->execQuery($sql,NULL,"select");
      return $res;
    }

    public function makeHtml($res){
      $html = "";
      foreach ($res as $key) {
        $html .= "<tr>
          <td><input id='".$key['subId']."' class='form-control' type='text' value='".$key['subject']."'/></td>
          <td>
          <button value='".$key['subId']."' id='update' class='up btn btn-primary'>Update</button>
          <button value='".$key['subId']."' id='delete' class='del btn btn-danger'>Delete</button>
          </td>
          </tr>";
      }
      return $html;
    }

    public function upSubject(){
      $this->valid->validate("subject")->isEmpty();
      $this->valid->validate("subId")->isEmpty();

      $sql = "update tbl_subject set subject=:subject where subId=:subId";
      $data = array("subject" => $this->valid->value['subject'],"subId" => $this->valid->value['subId']);
      $res = $this->db->execQuery($sql,$data,"update");
      if($res){
        $html = $this->makeHtml($this->getSubjects());
        echo $html;
        exit();
      }else{
        echo "You didn't update anything.";
        exit();
      }
    }

    public function delSubject(){
      $this->valid->validate("subId")->isEmpty();
      $data = array("subId" => $this->valid->value['subId']);

      // Select qsetId to Delete question and options
      $sql = "select qsId from tbl_quesset where subId = :subId";
      $qsId = $this->db->execQuery($sql,$data,"select");

      // Delete Subject
      $sql = "delete from tbl_subject where subId=:subId";
      $res = $this->db->execQuery($sql,$data,"delete");

      // Delete Question Set
      $qsId = $qsId[0]['qsId'];
      $data = array("qsId" => $qsId);
      $sql = "delete from tbl_quesset where qsId=:qsId";
      $res = $this->db->execQuery($sql,$data,"delete");

      // Delete Question
      $data = array("qsId" => $qsId);
      $sql = "delete from tbl_question where qsId=:qsId";
      $res = $this->db->execQuery($sql,$data,"delete");

      // Delete Options
      $data = array("qsetId" => $qsId);
      $sql = "delete from tbl_options where qsetId=:qsetId";
      $res = $this->db->execQuery($sql,$data,"delete");

      if($res){
        $sub = $this->getSubjects();
        if($sub){
          $html = $this->makeHtml($sub);
          echo $html;
          exit();
        }else{
          echo "<tr><td>No Subject Found.</td></tr>";
          exit();
        }
      }else{
        echo "Couldn't Delete. Something wen't Wrong.";
        exit();
      }
    }

    public function addSubject(){
      $this->valid->validate("subject")->isEmpty();

      $sql = "insert into tbl_subject(subject)values(:subject)";
      $data = array("subject" => $this->valid->value['subject']);
      $res = $this->db->execQuery($sql,$data,"update");
      if($res){
        $html = $this->makeHtml($this->getSubjects());
        echo $html;
        exit();
      }else{
        echo "Couldn't Add. Something wen't Wrong.";
        exit();
      }
    }

    public function getUsers(){
      $sql = "select * from tbl_user";
      $res = $this->db->execQuery($sql,NULL,"select");
      return $res;
    }

    public function userStatus($param){

      $this->valid->validate("uId");
      $data = array("uId" => $this->valid->value['uId']);

      if($param === "enable"){
        $sql = "update tbl_user set status='1' where uId=:uId";
        $res = $this->db->execQuery($sql,$data,"delete");
        if($res){
          echo "eSuccess";
          exit();
        }else{
          echo "Couldn't Perform Operation. Something Wrong.";
          exit();
        }
      }else if($param === "disable"){
        $sql = "update tbl_user set status='0' where uId=:uId";
        $res = $this->db->execQuery($sql,$data,"delete");
        if($res){
          echo "dSuccess";
          exit();
        }else{
          echo "Couldn't Perform Operation. Something Wrong.";
          exit();
        }
      }else if($param === "delUser"){
        $sql = "delete from tbl_user where uId=:uId";
        $res = $this->db->execQuery($sql,$data,"delete");
        if($res){
          $sql = "delete from tbl_result where uId=:uId";
          $this->db->execQuery($sql,$data,"delete");
          echo "delSuccess";
          exit();
        }else{
          echo "Couldn't Perform Operation. Something Wrong.";
          exit();
        }
      }

    }

    public function getUserHtml(){
      $users = $this->getUsers();
      if($users){
        $html = "";
        $i = 0;
        foreach ($users as $key) {
          $html .= "<tr><td>".++$i."</td><td>".$key['fullName']."</td><td>".$key['email']."</td><td>";

          if($key['status'] === '1'){
           $html .= "<b class='text-success'>Active</b>";
          }else{
           $html .= "<b class='text-danger'>Disabled</b>";
          }
          $html .= "</td><td>";

          if($key['status'] === '1'){
            $html .= " <button id='disable' value='".$key['uId']."' class='btn btn-warning'>Disable</button> ";
          }else{
             $html .= " <button id='enable' value='".$key['uId']."' class='btn btn-primary'>Enable</button> ";
          }

          $html .= " <button id='delUser' value='".$key['uId']."' class='btn btn-danger'>Delete</button> </td></tr>";
        }
        echo $html;
        exit();
      }else{
        echo "fail";
        exit();
      }
    }

    public function getQsetHtml($res){
      if($res){
        $html = "<option value=''>Select Question Set</option>";
        foreach ($res as $key) {
          $html .= "<option value='".$key['qsId']."'>".$key['qsName']."</option>";
        }
        echo $html;
        exit();
      }else{
        echo "<option value=''>No Question Set Found.</option>";
        exit();
      }
    }

    public function getQuestion($qSetId){
      $sql = "select * from tbl_question where qsId=:qsId";
      $data = array("qsId" => $qSetId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function delQuestion(){
      $this->valid->validate("qId");
      $this->valid->validate("qsetId");
      $sql = "delete from tbl_question where qId = :qId";
      $data = array("qId" => $this->valid->value['qId']);
      $this->db->execQuery($sql,$data,"delete");
      $sql = "delete from tbl_options where qId = :qId";
      $res = $this->db->execQuery($sql,$data,"delete");
      if($res){
        $ques = $this->getQuestion($this->valid->value['qsetId']);
        if($ques){
          $i = 0;
          $html = "";
          foreach ($ques as $key) {
            $html .= "<tr>
              <td>".++$i."</td>
              <td>".$key['question']."</td>
              <td>
                <button value='qId=".$key['qId']."&qsetId=".$key['qsId']."' id='qEdit' class='btn btn-primary'>Edit</button>
                <button value='qId=".$key['qId']."&qsetId=".$key['qsId']."' id='qDelete' class='btn btn-danger'>Delete</button>
              </td>
            </tr>";
          }
          echo $html;
          exit();
        }else{
          echo "<tr><td>No Question Found.</td></tr>";
          exit();
        }
      }else{
        echo "Couldn't Delete Question.";
        exit();
      }
    }

    public function makeQsetHtml($res){
      if($res){
        $html = "";
        $i = 0;
        foreach ($res as $key) {
          $html .= "<tr>
                      <td>".++$i."</td>
                      <td><input type='text' class='form-control' id='".$key['qsId']."' value='".$key['qsName']."'/></td>
                      <td>
                        <button id='qsUpdate' class='btn btn-primary' value='".$key['qsId']."'>Update</button>
                        <button id='qsDelete' class='btn btn-danger' value='".$key['qsId']."'>Delete</button>
                        <input type='hidden' id='qs".$key['qsId']."' value='".$key['subId']."'/>
                      </td>
                    </tr>";
        }
      }else{
        return "Question Set Not Found.";
      }
      return $html;
    }

    public function updateQset(){
      $this->valid->validate("qsId");
      $this->valid->validate("qsName");
      $sql = "update tbl_quesset set qsName=:qsName where qsId=:qsId";
      $data = array(
        "qsId" => $this->valid->value['qsId'],
        "qsName" => $this->valid->value['qsName']
      );
      $res = $this->db->execQuery($sql,$data,"update");
      if($res){
        echo "success";
        exit();
      }else{
        echo "Couldn't Update. Something wen't Wrong.";
        exit();
      }
    }

    public function deleteQset(){
      $this->valid->validate("qsId");

      $sql = "delete from tbl_quesset where qsId=:qsId";
      $data = array("qsId" => $this->valid->value['qsId']);
      $this->db->execQuery($sql,$data,"delete");
      $sql = "delete from tbl_question where qsId=:qsId";
      $this->db->execQuery($sql,$data,"delete");
      $sql = "delete from tbl_options where qsetId=:qsetId";
      $data = array("qsetId" => $this->valid->value['qsId']);
      $res = $this->db->execQuery($sql,$data,"delete");

      if(!$res){
        echo "Something wen't Wrong.";
        exit();
      }
    }

    public function getEditQuestion(){
      $this->valid->validate("qId");
      $sql = "select * from tbl_question where qId = :qId";
      $data = array("qId" => $this->valid->value['qId']);
      $res = $this->db->execQuery($sql,$data,"select");

      if($res){
        $html = "<div class='form-group'>
          <label>Question</label>
          <input id='qName' value='".$res[0]['question']."' class='form-control' type='text' name='question'/>
        </div>";

        $sql = "select * from tbl_options where qId=:qId";
        $res = $this->db->execQuery($sql,$data,"select");
        $i = 0;$ans="<div class='form-group'><label>Ans</label><select name='ans' class='form-control'>";
        foreach ($res as $key) {
          $html .= "<div class='form-group'>
            <label>Option ".++$i."</label>
            <input id='op".$i."' value='".$key['options']."' class='form-control' type='text' name='op[".$key['opId']."]'/>
          </div>";
		  
		  if($key['ans'] == '1'){
			$ans .= "<option selected value='".$key['opId']."'>";
		  }else{
			$ans .= "<option value='".$key['opId']."'>";  
		  }
			if($i==1){
				$ans .= "A";
			}else if($i==2){
				$ans .= "B";
			}else if($i==3){
				$ans .= "C";
			}else if($i==4){
				$ans .= "D";
			}
		  $ans .= "</option>";
		  
        }
		$ans .= " </select></div>";
		$html .= $ans;
        $html .= "<div class='form-group'>
          <input id='qUpdate' class='btn btn-success' type='submit' value='Update'/>
          <input id='qCancel' class='btn btn-primary' type='submit' value='Cancel'/>
          <input type='hidden' name='qId' value='".$key['qId']."'/>
        </div>";
        echo $html;
        exit();
      }else{
        echo "No Question Found.";
        exit();
      }
    }

    public function updateQuestion(){
      $this->valid->validate("question")->isEmpty();
	  $this->valid->validate("ans")->isEmpty();
      $this->valid->validate("qId");
      $sql = "update tbl_question set question=:question where qId=:qId";
      $data = array("question" => $this->valid->value['question'],"qId" => $this->valid->value['qId']);
      $res1 = $this->db->execQuery($sql,$data,"update");
      foreach ($_POST['op'] as $key => $val) {
        if(empty($val)){
          echo "You must fill all the Option.";
          exit();
        }
      }

      foreach ($_POST['op'] as $key => $val) {
        $sql = "update tbl_options set options=:options,ans=:ans where opId=:opId";
        $data = array("opId" => $key,"options" => $val,"ans" => '0');
		if($key == $this->valid->value['ans']){
			$data = array("opId" => $key,"options" => $val,"ans" => '1');
		}
        $res2 = $this->db->execQuery($sql,$data,"update");
      }
	  
		
      if($res1 && $res2){
        echo "success";
        exit();
      }else{
        echo "Couldn't Update. Something wen't Wrong.";
        exit();
      }
    }
  }
?>
