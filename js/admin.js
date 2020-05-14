/* ------------------------ Code For Admin Panel -------------------------- */

$(document).ready(function(){

  $(document).on("submit","#admin_login",function(){
    $.ajax({
      url: "../ajax/adminLogin.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "html",
      success: function(data){
        window.scrollTo(0,0);
        if(data === "success"){
          window.location = "panel.php";
        }else{
          $("#loginError").html(data).show();
        }
      }
    });
    return false;
  });

  $(document).on("click","#openProf",function(){
    $(".dropdown-menu").hide();
    $("#profile").show();

    $.ajax({
      url: "../ajax/profile.php",
      type: "POST",
      data: "action=getProfile",
      dataType: "html",
      success: function(data){
        if(data === "fail"){
          $("#upError").html("Failed to Get User Profile.").show();
        }else{
          data = JSON.parse(data);
          $("#upName").val(data[0].fullName);
          $("#upEmail").val(data[0].email);
          $("#upPass").val("");
        }
      }
    });

    $(window).click(function(event){
      if(event.target == $("#profile")[0]){
        $("#profile").hide();
      }
    });
    return false;
  });

  $("#admin_profile").submit(function(){
    $.ajax({
      url: "../ajax/profile.php",
      type: "POST",
      data: $(this).serialize()+"&action=upProfile",
      dataType: "html",
      success: function(data){
        if(data === "success"){
          $("#upError").hide();
          $("#upSuccess").html("Profile Updated Successfully.").show();
          setTimeout(function(){
            $("#profile").hide();
            $("#upSuccess").hide();
          },1500);
        }else{
          $("#upSuccess").hide();
          $("#upError").html(data).show();
        }
      }
    });
    return false;
  });

  $(document).on("click","#enable,#disable,#delUser",function(){
    var uId = $(this).val();
    var dataValue = "";
    if(this.id === "disable"){
      dataValue = "uId="+uId+"&action=disable";
    }else if(this.id === "enable"){
      dataValue = "uId="+uId+"&action=enable";
    }else if(this.id === "delUser" && confirm("Are you sure to Delete?")){
      dataValue = "uId="+uId+"&action=delUser";
    }

    if(dataValue){
      $.ajax({
        url: "../ajax/users.php",
        type: "POST",
        data: dataValue,
        dataType: "html",
        success: function(data){
          if(data === "eSuccess"){
            $(".allError").hide();
            $(".allSuccess").html("User has been Enabled.").show();
            getUserHtml();
          }else if(data === "dSuccess"){
            $(".allError").hide();
            $(".allSuccess").html("User has been Disabled.").show();
            getUserHtml();
          }else if(data === "delSuccess"){
            $(".allError").hide();
            $(".allSuccess").html("User Deleted Successfully.").show();
            getUserHtml();
          }else{
            $(".allSuccess").hide();
            $(".allError").html(data).show();
          }
        }
      });
    }
    return false;
  });

  $("#admin_button").click(function(){
    $(".dropdown-menu").toggle();
    return false;
  });

  $("#subAmount").click(function(){
    $("#msg").hide();
    var amount = $("#amount").val();
    var html = "";
    for(i=1;i<=amount;i++){
      html += "<tr><td><label>Question "+i+"</label></td><td><input name='q"+i+"[]' type='text' placeholder='Enter Question' class='form-control'/></td></tr>";
      html += "<tr><td></td><td class='options'><input name='q"+i+"[]' type='text' placeholder='Option A' class='form-control'/><input name='q"+i+"[]' type='text' placeholder='Option B' class='form-control'/></td></tr>";
      html += "<tr><td></td><td class='options'><input name='q"+i+"[]' type='text' placeholder='Option C' class='form-control'/><input name='q"+i+"[]' type='text' placeholder='Option D' class='form-control'/></td></tr>";
      html += "<tr><td><label>Ans: </label></td><td><select class='form-control' name='q"+i+"[]'><option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option></select></td></tr>";
      html += "<tr><td><label style='margin: 20px;'></label></td></tr>";
    }
    $("#quesList").html(html);
    $("#submitQues").show();
    return false;
  });

  $("#addQuestion").submit(function(){
    $.ajax({
      url: "../ajax/addQuestion.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "html",
      success: function(data){
        window.scrollTo(0,0);
        if(data === "success"){
          $(".allError").hide();
          $(".allSuccess").html("Question Successfully Added.").show();
        }else{
          $(".allSuccess").hide();
          $(".allError").html(data).show();
        }
      }
    });
    return false;
  });

  $(document).on("click",".up",function(){

    var udId = $(this).val();
    var subject = $("#"+udId).val();

      if(confirm("Are you sure to Update?")){
        var dataValue = "subject="+subject+"&subId="+udId+"&action=update";
        $.ajax({
          url: "../ajax/subject.php",
          type: "POST",
          data: dataValue,
          dataType: "html",
          success: function(data){
            $("#alert").hide();
            window.scrollTo(0,0);
            if(data.startsWith("<tr>")){
              $(".allError").hide();
              $(".allSuccess").html("Subject Updated Successfully.").show();
              $("#subBody").html(data);
            }else{
              $(".allSuccess").hide();
              $(".allError").html(data).show();
            }
          }
        });
      }
    return false;
  });

  $(document).on("click",".del",function(){
    var udId = $(this).val();

      if(confirm("Are you Sure to Delete?")){
        var dataValue = "subId="+udId+"&action=delete";
        $.ajax({
          url: "../ajax/subject.php",
          type: "POST",
          data: dataValue,
          dataType: "html",
          success: function(data){
            $("#alert").hide();
            window.scrollTo(0,0);
            if(data.startsWith("<tr>")){
              $(".allError").hide();
              $(".allSuccess").html("Subject Deleted Successfully.").show();
              $("#subBody").html(data);
            }else{
              $(".allSuccess").hide();
              $(".allError").html(data).show();
            }
          }
        });
      }
    return false;
  });

  $(document).on("submit","#addSubject",function(event){
    event.preventDefault();
    var dataValue = $(this).serialize()+"&action=addSubject";
    $.ajax({
      url: "../ajax/subject.php",
      type: "POST",
      data: dataValue,
      dataType: "html",
      success: function(data){
        if(data.startsWith("<tr>")){
          $(".allError").hide();
          $(".allSuccess").html("Subject Added Successfully.").show();
          $("#subBody").html(data);
        }else{
          $(".allSuccess").hide();
          $(".allError").html(data).show();
        }
      }
    });

    return false;
  });

  $("#selcSubject").change(function(){
    var dataValue = "subId=" +$(this).val()+"&action=getQsetAdm";
    $.ajax({
      url: "../ajax/qSet.php",
      type: "POST",
      data: dataValue,
      dataType: "html",
      success: function(data){
        $("#admQset").html(data);
      }
    });
    return false;
  });

  $(document).on("submit","#getQues",function(){
    var subId = $("#selcSubject").val();
    var qsetId = $("#admQset").val();

    if(subId === ""){
      $(".allError").html("Please Select Subject.").show();
    }else if(qsetId === ""){
      $(".allError").html("Please Select Question Set").show();
    }else{
      window.location = "manageQues.php?"+$(this).serialize();
    }
    return false;
  });

  $(document).on("click","#qDelete",function(){
    if(confirm("Are you sure to Delete?")){
      var dataValue = $(this).val()+"&action=delQues";
      $.ajax({
        url: "../ajax/delete.php",
        type: "POST",
        data: dataValue,
        dataType: "html",
        success: function(data){
          if(data.startsWith("<tr>")){
            $(".allError").hide();
            $(".allSuccess").html("Question Deleted Successfully.").show();
            $("#qBody").html(data);
          }else{
            $(".allSuccess").hide();
            $(".allError").html(data).show();
          }
        }
      });
    }
    return false;
  });


  $(document).on("change","#sub",function(){
    var dataValue = "subId=" +$(this).val()+"&action=getQuesSet";
    $.ajax({
      url: "../ajax/qSet.php",
      type: "POST",
      data: dataValue,
      dataType: "html",
      success: function(data){
        $(".qsetTable").show();
        $("#qsetBody").html(data).show();
      }
    });
    return false;
  });

  $(document).on("click","#qsUpdate",function(){
    var qsId = $(this).val();
    var qsName = $("#"+qsId).val();
    var dataValue = "qsId="+qsId+"&qsName="+qsName+"&action=upQset";

    $.ajax({
      url: "../ajax/qSet.php",
      type: "POST",
      data: dataValue,
      dataType: "html",
      success: function(data){
        if(data === "success"){
          $(".allError").hide();
          $(".allSuccess").html("Question Set Updated Successfully.").show();
        }else{
          $(".allSuccess").hide();
          $(".allError").html(data).show();
        }
      }
    });
    return false;
  });

  $(document).on("click","#qsDelete",function(){
    if(confirm("Are you sure to Delete?")){
      var qsId = $(this).val();
      var subId = $("#qs"+qsId).val();
      var dataValue = "qsId="+qsId+"&subId="+subId+"&action=delQset";

      $.ajax({
        url: "../ajax/qSet.php",
        type: "POST",
        data: dataValue,
        dataType: "html",
        success: function(data){
          if(data.startsWith("<tr>")){
            $(".allError").hide();
            $(".allSuccess").html("Question Set Deleted Successfully.").show();
            $(".qsetTable").show();
            $("#qsetBody").html(data).show();
          }else{
            $(".allSuccess").hide();
            $(".allError").html(data).show();
          }
        }
      });
    }
    return false;
  });

  $(document).on("click","#qEdit",function(){
    $("#editQues").show();

    var dataValue = $(this).val()+"&action=getQuestion";
    $.ajax({
      url: "../ajax/question.php",
      type: "POST",
      data: dataValue,
      dataType: "html",
      success: function(data){
        if(data.startsWith("<div")){
            $("#upQbody").html(data);
        }else{
            alert("Error Occured: "+data);
        }
      }
    });
    $(window).click(function(event){
      if(event.target == $("#editQues")[0]){
        $("#editQues").hide();
      }
    });

    $(document).on("click","#qCancel",function(){
      $("#editQues").hide();
    });
    return false;
  });


  $(document).on("click","#qUpdate",function(){
    $.ajax({
      url: "../ajax/question.php",
      type: "POST",
      data: $("#eQues-content").serialize()+"&action=upQues",
      dataType: "html",
      success: function(data){
        if(data === "success"){
          $("#uError").hide();
          $("#uSuccess").html("Question Updated Successfully.").show();
        }else{
          $("#uSuccess").hide();
          $("#uError").html(data).show();
        }
      }
    });
    setTimeout(function(){
      $("#uSuccess,#uError").hide();
    },2000);
    return false;
  });

  $(document).on("click","#addQbtn",function(){
    $("#addQues").show();
    return false;
  });

  $(document).on("click","#cancel",function(){
    $("#addQues").hide();
    return false;
  });

  $(window).click(function(event){
    if(event.target == $("#addQues")[0]){
      $("#addQues").hide();
    }
  });

  $(document).on("submit","#addQues-content",function(){
    var dataValue = $(this).serialize()+"&action=addSingleQues";
    $.ajax({
      url: '../ajax/addQuestion.php',
      type: "POST",
      data: dataValue,
      dataType: 'html',
      success: function(data){
        if(data === "success"){
          $("#addError").hide();
          $("#addSuccess").html("Question Successfully Added.").show();
          setTimeout(function(){
            $("#addQues").hide();
            location.reload();
          },2000);
        }else{
          $("#addSuccess").hide();
          $("#addError").html(data).show();
        }
      }
    });
    return false;
  });

  // Special Function

  function getUserHtml(){
    $.ajax({
      url: "../ajax/users.php",
      type: "POST",
      data: "action=getUserHtml",
      dataType: "html",
      success: function(data){
        if(data.startsWith("<tr>")){
          $("#userBody").html(data);
        }else if(data === "fail"){
          $("#userBody").html("<tr><td>No User Found.</td></tr>");
        }else{
          alert("Error Occured!");
        }
      }
    });
  }

});
