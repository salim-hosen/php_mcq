<?php
  class User{
    private $db;
    private $valid;

    public function __construct($db,$validate){
      $this->db = $db;
      $this->valid = $validate;
    }

    public function matchLogin(){

      $this->valid->validate('email')->isEmpty()->checkEmail();
      $this->valid->validate('password')->isEmpty();

      if($this->valid->submit()){
        $data = array("email" => $this->valid->value['email'],"password" => md5($this->valid->value['password']));
        $sql = "select * from tbl_user where email=:email and password=:password";
        $res = $this->db->execQuery($sql,$data,"select");
        if($res){
          if($res[0]['status'] === '1'){
            Session::init();
            Session::set("login",true);
            Session::set("name",$res[0]['fullName']);
            Session::set("userId",$res[0]['uId']);
            echo "success";
            exit();
          }else{
            echo "You can't Login. You are Blocked.";
            exit();
          }
        }else{
          echo "Username and Password didn't Match.";
          exit();
        }
      }
    }

    public function userRegistration(){
      $this->valid->validate('name')->isEmpty()->checkLength();
      $this->valid->validate('email')->isEmpty()->checkEmail()->isExists();
      $this->valid->validate('password')->isEmpty()->checkLength();
      $this->valid->validate('repassword')->isEmpty()->checkLength();

      if($this->valid->value['password'] !== $this->valid->value['repassword']){
        echo "Password didn't Match.";
        exit();
      }else{
        if($this->valid->submit()){
          $sql = "insert into tbl_user(fullName,email,password,status)values(:fullName,:email,:password,:status)";
          $data = array(
            "fullName" => $this->valid->value['name'],
            "email" => $this->valid->value['email'],
            "password" => md5($this->valid->value['password']),
            "status" => "1"
          );
          $res = $this->db->execQuery($sql,$data,"insert");
          if($res){
            echo "success";
            exit();
          }else{
            echo "Registraion Unsuccessful";

          }
        }else{
          echo "Something Wen't Wrong.";
          exit();
        }
      }
    }

    public function getProfile(){
      $uId = Session::get("userId");
      $sql = "select * from tbl_user where uId=:uId";
      $data = array("uId"=>$uId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function userUpdate(){
      $this->valid->validate('uId');
      $uId = $this->valid->value['uId'];
      $this->valid->validate('name')->isEmpty()->checkLength();
      $this->valid->validate('email')->isEmpty()->checkEmail()->isExists($uId);
      $this->valid->validate('password');
      $this->valid->validate('repassword');

      $password = $this->valid->value['password'];
      $repassword = $this->valid->value['repassword'];

      if(empty($password) && empty($repassword) && $this->valid->submit()){
        $sql = "update tbl_user set fullName=:fullName,email=:email where uId=:uId";
        $data = array(
          "fullName" => $this->valid->value['name'],
          "email" => $this->valid->value['email'],
          "uId" => $uId
        );
        $res = $this->db->execQuery($sql,$data,"update");
        if($res){
          echo "success";
          exit();
        }else{
          echo "You didn't Update Anything.";
          exit();
        }
      }else{
        if(strlen($repassword) < 4 || strlen($repassword) > 20){
          echo "New Password should be min 4 or max 20 characters long.";
          exit();
        }else if($this->valid->submit()){
            $sql = "select * from tbl_user where uId=:uId and password=:password";
            $data = array("uId" => $uId,"password"=>md5($password));
            $res = $this->db->execQuery($sql,$data,"select");
            if($res){
              $sql = "update tbl_user set fullName=:fullName,email=:email,password=:password where uId=:uId";
              $data = array(
                "fullName" => $this->valid->value['name'],
                "email" => $this->valid->value['email'],
                'password' => md5($this->valid->value['repassword']),
                "uId" => $uId
              );
              $res = $this->db->execQuery($sql,$data,"update");
              if($res){
                echo "success";
                exit();
              }else{
                echo "You didn't Update Anything.";
                exit();
              }
            }else{
              echo "Old Password is Wrong.";
              exit();
            }
        }else{
          echo "Something Wrong.";
          exit();
        }
      }
    }
  }
?>
