<?php
  class Questions{
    private $db;
    private $valid;

    public function __construct($db,$validate){
      $this->db = $db;
      $this->valid = $validate;
    }

    public function getSubjects(){
      $sql = "select * from tbl_subject";
      $res = $this->db->execQuery($sql,NULL,"select");
      return $res;
    }

    public function getQset($subId){
      $sql = "select * from tbl_quesSet where subId=:subId";
      $data = array("subId" => $subId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function getHtml($res){
      $html = "";
      if($res){
        foreach ($res as $key) {
          $html .= "<tr><td><a href='quesPage.php?qsetId=".$key['qsId']."'>".$key['qsName']."</a></td></tr>";
        }
      }else{
        $html .= "<tr><td>No Question Available for this Subject.</td></tr>";
      }
      return $html;
    }

    public function getQuestions($qsetId){
      $sql = "select * from tbl_question where qsId = :qsId";
      $data = array("qsId" => $qsetId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function getOptions($qId){
      $sql = "select * from tbl_options where qId = :qId";
      $data = array("qId" => $qId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function getNumofQues($qsetId){
      $res = $this->getQuestions($qsetId);
      $row = 0;
      foreach ($res as $key) {
        $row++;
      }
      return $row;
    }

    public function getMarks(){
      $mark = 0;
      foreach ($_POST as $key => $value) {
        if($key === "submit_ans" || $key === "qsetId"){
          continue;
        }
        $sql = "select * from tbl_options where opId=:opId and ans=:ans";
        $data = array("opId" => $value,"ans" => '1');
        $res = $this->db->execQuery($sql,$data,"select");
        if(!empty($res)){
          $mark++;
        }
      }

      $totQues = $this->getNumofQues($_POST['qsetId']);
      $mark = round(($mark/$totQues)*100,2);

      $sql = "select tbl_quesSet.*,tbl_subject.subject from tbl_quesset inner join tbl_subject on tbl_quesset.subId = tbl_subject.subId where qsId=:qsId";
      $data = array("qsId" => $_POST['qsetId']);
      $res = $this->db->execQuery($sql,$data,"select");

      $uId = Session::get("userId");
      $date = date("d M Y");

      foreach($res as $key) {
        $sql = "insert into tbl_result(uId,subject,qset,date,score)values(:uId,:subject,:qset,:date,:score)";
        $data = array(
          "uId" => $uId,
          "qset" => $key['qsName'],
          "subject" => $key['subject'],
          "date" => $date,
          "score" => $mark
        );
        $this->db->execQuery($sql,$data,"insert");
      }

      return $mark;
    }

    public function getUserResults(){
      $uId = Session::get("userId");
      $sql = "select * from tbl_result where uId=:uId";
      $data = array("uId" => $uId);
      $res = $this->db->execQuery($sql,$data,"select");
      return $res;
    }

    public function deleteResult(){
      $delId = htmlspecialchars($_POST['delId']);
      $sql = "delete from tbl_result where resId=:resId";
      $data = array("resId" => $delId);
      $res = $this->db->execQuery($sql,$data,"delete");
      if($res){
        echo "success";
        exit();
      }else{
        echo "fail";
        exit();
      }
    }

    public function addSingleQues(){
      $this->valid->validate("Question")->isEmpty();
      $this->valid->validate("Option_A")->isEmpty();
      $this->valid->validate("Option_B")->isEmpty();
      $this->valid->validate("Option_C")->isEmpty();
      $this->valid->validate("Option_D")->isEmpty();
      $this->valid->validate("Answer")->isEmpty();

      if($this->valid->submit()){
        $sql = "insert into tbl_question(qsId,question)values(:qsId,:question)";
        $data = array("qsId" => $_POST['qSet'],"question" => $this->valid->value['Question']);
        $res = $this->db->execQuery($sql,$data,"insert");
        if($res){
          $lastId = $this->db->con->lastInsertId();
          $sql = "insert into tbl_options(qId,options,ans,qSetId)values(:qId,:options,:ans,:qSetId)";
          $options = array(
            "a" => $this->valid->value['Option_A'],
            "b" => $this->valid->value['Option_B'],
            "c" => $this->valid->value['Option_C'],
            "d" => $this->valid->value['Option_D']
          );
          foreach ($options as $key => $value) {
            $data = array(
              "qId" => $lastId,
              "options" => $value,
              "ans" => '0',
              "qSetId" => $_POST['qSet']
            );
            if($key === $this->valid->value['Answer']){
              $data['ans'] = '1';
            }
            $res = $this->db->execQuery($sql,$data,"insert");
          }
          if($res){
            echo "success";
            exit();
          }else{
            echo "Faild to Add Question.";
            exit();
          }
        }else{
          echo "Faild to Add Question.";
          exit();
        }
      }else{
        echo "Something Wrong. Question is not Added.";
        exit();
      }
    }

  }
?>
