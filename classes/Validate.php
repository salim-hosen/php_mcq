<?php
  class Validate{
    protected $errors = array();
    protected $key;
    public $value = array();
    private $db;

    public function __construct($db){
      $this->db = $db;
    }

    public function validate($key){
      $this->key = $key;
      $this->value[$this->key] = trim($_POST[$this->key]);
      $this->value[$this->key] = stripcslashes($this->value[$this->key]);
      $this->value[$this->key] = htmlspecialchars($this->value[$this->key]);
      return $this;
    }

    public function isEmpty(){
      if(empty($this->value[$this->key])){
        if($this->key === "repassword"){
          $this->errors[$this->key] = "Please Repeat your Password.";
          echo $this->errors[$this->key];
          exit();
        }else{
          $this->errors[$this->key] = "Error! ".ucfirst($this->key)." is Empty.";
          echo $this->errors[$this->key];
          exit();
        }
      }
      return $this;
    }

    public function checkLength(){
      if(strlen($this->value[$this->key])<4){
        $this->errors[$this->key] = ucfirst($this->key)." is too Short.";
        echo $this->errors[$this->key];
        exit();
      }
      return $this;
    }

    public function checkEmail(){
      if(!filter_var($this->value[$this->key],FILTER_VALIDATE_EMAIL)){
        $this->errors[$this->key] = "Error! Invalid ".ucfirst($this->key)." Address.";
        echo $this->errors[$this->key];
        exit();
      }
      return $this;
    }

    public function isExists($uId=NULL){
        $sql = "select ".$this->key." from tbl_user where ".$this->key."=:".$this->key;
        $data = array();
        if(!empty($uId)){
          $sql .= " and uId != :uId";
          $data = array($this->key => $this->value[$this->key],"uId" => $uId);
        }else{
          $data = array($this->key => $this->value[$this->key]);
        }

        $res = $this->db->execQuery($sql,$data,"select");

        if($res){
            $this->errors[$this->key] = ucfirst($this->key)." Already Exists.";
            echo $this->errors[$this->key];
            exit();
        }
        return $this;
    }

    public function isExistsAdmin($admId=NULL){
        $sql = "select email from tbl_admin where email=:email and admId != :admId";
        $data = array("email" => $this->value[$this->key], "admId" => $admId);
        $res = $this->db->execQuery($sql,$data,"select");

        if($res){
            $this->errors[$this->key] = ucfirst($this->key)." Already Exists.";
            echo $this->errors[$this->key];
            exit();
        }
        return $this;
    }

    public function onlyNum(){
      if(!ctype_digit($this->value[$this->key])){
        echo "ID can Contains Numeric Character Only.";
        exit();
      }
      return $this;
    }

    public function submit(){
      if(empty($this->errors)){
        return true;
      }else{
        return false;
      }
    }

  }
?>
