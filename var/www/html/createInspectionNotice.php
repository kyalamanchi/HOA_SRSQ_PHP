<html>
  <head>
    <title>Create Inspection Notice</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
[hidden] {
  display: none !important;
}
</style>
<script type="text/javascript">
function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 100%">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}
<?php
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$hoaidquery = "SELECT * FROM HOAID WHERE COMMUNITY_ID=2";
        $hoaidqueryresult = pg_query($hoaidquery);
        $hoaIDArray = array();
        $userEmails = array();
        while ($row = pg_fetch_assoc($hoaidqueryresult)) {
          $name = $row['firstname'];
          $name = $name.' ';
          $name = $name.$row['lastname'];
         $hoaIDArray[$row['hoa_id']]  = $name;
         $userEmails[$row['hoa_id']] = $row['email'];
        }
$inspectionCategoryQuery = "SELECT * FROM INSPECTION_CATEGORY ";
$inspectionCategoryQueryResult = pg_query($inspectionCategoryQuery);
$inspectionCategoryArray = array();
while ($row = pg_fetch_assoc($inspectionCategoryQueryResult)) {
  array_push($inspectionCategoryArray, $row['name']);
}

?>
  function calc()
{
  document.getElementById("authPassword").disabled = !(document.getElementById("authPassword").disabled);
}

function changeDetails(){
  showPleaseWait();
  var request = new XMLHttpRequest();
  request.open("POST","https://hoaboardtime.com/getHoaIDDetails.php",true);
  request.send( $("#hoaID").find("option:selected").text() );
  request.onreadystatechange  = function(){
    if ( request.readyState == XMLHttpRequest.DONE ){
      hidePleaseWait();
      var data = JSON.parse(request.responseText);
      document.getElementById("home_id").value  = data.home_id;
    }
  }
}

function getFileData()
{
  var file = document.getElementById("fileInput").files[0];
  if ( file ){
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function (evt) {
       var  fileData =evt.target.result.split(',')[1];
        alert(fileData);
        return fileData;
    }
    reader.onerror = function (evt) {
        fileData = "Error";
        return fileData;
    }
}
}
function sendData(){

  swal({
      title: "Notice Created",
      closeOnClickOutside: false,
      icon: "success",
      buttons: ["Send Later","Send Now"],
    });

    var hoaID = $("#hoaID").find("option:selected").text();
    var category = $("#inspectionCategory").find("option:selected").text();
    var subCategory = $("#documentType").find("option:selected").text();
    var location  = $("#locations").find("option:selected").text();
    var legalDocument = $("#legalDocument").find("option:selected").text();
    var description = document.getElementById("inspectionDescription").value;
    var noticeType = $("#noticeType").find("option:selected").text();
    var status = $("#noticeStatus").find("option:selected").text();
    var cDate = document.getElementById("ComplianceDate").value;
    alert(getFileData());
    



  // var documentCategory = document.getElementById('documentCategory').value;
  // if ( documentCategory == ""){
  //   alert("One or more required fields empty");
  //   return;
  // }
  // var selectedDocument = $("#documentType").find("option:selected").text();
  // if ( selectedDocument == ""){
  //   alert("One or more required fields empty");
  //   return;
  // }
  // var selectedEmails = document.getElementById("emails").value;
  // if ( !selectedEmails ){
  //   alert("One or more required fields empty");
  //   return;
  // }
  // var selectedHoaID = $("#hoaID").find("option:selected").text();
  // var agreementTitle = document.getElementById('agreementTitle').value;
  // var documentName = document.getElementById('documentType').value;
  // var ccEmails = document.getElementById('ccEmails').value;
  // var signatureType  = document.getElementById('signatureType').value;
  // var role = document.getElementById('signerRole').value;
  // var signatureFlow = document.getElementById('signatureFlow').value;
  // var customMessage = document.getElementById('customMessage').value;
  // var completeInOrder = $('#completeInOrder').is(':checked');
  // var enablePassword = $('#enablePassword').is(':checked');
  // var setPassword = document.getElementById('authPassword').value;
  // if ( enablePassword && !setPassword){
  //   alert("One or more required fields empty");
  // }
  // if ( !emails ){
  //   alert("One or more required fields is empty");
  // }
  // else {
  // jsonObj = [];
  // item = {};
  // item["documentCategory"] = documentCategory;
  // item["documentName"]  = documentName;
  // item["agreementTitle"] = agreementTitle;
  // item["emailAddresses"] = selectedEmails;
  // item["ccAddresses"] = ccEmails;
  // item["signType"] = signatureType;
  // item["roleType"] = role;
  // item["signFlow"] = signatureFlow;
  // item["customMessage"] = customMessage;
  // item["completeInOrder"] = completeInOrder;
  // item["passwordStatus"] = enablePassword;
  // item["setPassword"] = setPassword;
  // item["hoaID"] = selectedHoaID;
  // jsonObj.push(item);
  // lol =  JSON.stringify(jsonObj);
  // var request= new XMLHttpRequest();
  // request.open("POST", "https://hoaboardtime.com/adobeSign2.php", true);
  // request.setRequestHeader("Content-type", "application/json");
  // request.send(lol);
  // showPleaseWait();
  // request.onreadystatechange = function () {
  //       if (request.readyState == XMLHttpRequest.DONE) {
  //           hidePleaseWait();
  //           alert(request.responseText);
  //       }
  //       }
  // }
}
function updateName(){
  document.getElementById("agreementTitle").value = $("#documentType").find("option:selected").text();
}
function getSubCategory(){
  $("#documentType").find("option").remove();
  var category = $("#inspectionCategory").find("option:selected").text();
  var request = new XMLHttpRequest();
  request.open("POST","https://hoaboardtime.com/getInspectionSubCategories.php",true);
  request.send(category);
  showPleaseWait();
  request.onreadystatechange = function(){
    if (request.readyState == XMLHttpRequest.DONE){
      hidePleaseWait();
      var data = JSON.parse(request.responseText);

      $("#documentType").append('<option selected="true" disabled="disabled"></option>');
      document.getElementById("documentType").options[0].disabled = true;
      for( var i=0;i<data.length;i++){
          $("#documentType").append('<option id='+data[i][0]+'>'+data[i][1]+'</option>');
      }
     $("#documentType").selectpicker('refresh');
    }
  }


}

</script>
  </head>
  <div class="container">
    <div class="row">
      <h2>Inspection Management</h2>
      <hr />
    </div>
    <form>
    <div class="row-fluid" style="float: left;">
      <h4>HOA ID</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="hoaID" onchange="changeDetails();">
      <?php
        echo '<option></option>';
        foreach ($hoaIDArray as $key => $value) {
          echo '<option data-subtext="'.$value.'">'.$key.'</option>';
        }
      ?>
      </select>
    </div>
      <div style="width: 25%;float: left;padding-left: 10px;">
      <h4>HOME ID</h4>
      <input type="email" class="form-control" id="home_id" aria-describedby="homeID" placeholder="HOME ID" disabled="disabled" >
      <small id="emailHelp" class="form-text text-muted"></small>
      </div>
      <div style="clear: both;"></div>
      <br>
      <div class="row-fluid" style="float: left;">
      <h4>Category</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="inspectionCategory" onchange="getSubCategory();">
      <?php
        echo '<option></option>';
        foreach ($inspectionCategoryArray as $category) {
          echo '<option data-subtext="">'.$category.'</option>';
        }
      ?>
      </select>
    </div>

    <div class="row-fluid" style="float: left;padding-left: 10">
      <h4>Sub Category</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="documentType">
      </select>
    </div>
      <div style="clear: both;"></div>
      <br>
      <div class="row-fluid"n style="float: left;">
      <h4>Legal Document</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="legalDocument">
        <option></option>
        <?php
        $query = "SELECT * FROM COMMUNITY_LEGAL_DOCS WHERE COMMUNITY_ID = 2";
        $queryResult = pg_query($query);
        while ( $row = pg_fetch_assoc($queryResult)) {
          echo "<option id=".$row['id'].">";
            echo $row['name'];
          echo "</option>";
        }
        ?>
      </select>
      </div>
      <div class="row-fluid"n style="float: left;padding-left: 10px;">
      <h4>Location</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="locations">
        <option></option>
        <?php
        $query = "SELECT * FROM LOCATIONS_IN_COMMUNITY WHERE COMMUNITY_ID = 2";
        $queryResult = pg_query($query);
        while ( $row = pg_fetch_assoc($queryResult)) {
          echo "<option id=".$row['id'].">";
            echo $row['location'];
          echo "</option>";
        }
        ?>
      </select>
      </div>

      <div style="clear: both;"></div>
      <br>
      <div class="form-group">
          <h4>Description</h4>
          <textarea class="form-control" rows="5" id="inspectionDescription" style="width: 35%"></textarea>
      </div>
      <br>
       <div class="row-fluid" style="float: left;">
      <h4>Notice Type</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="noticeType">
        <option></option>
        <?php
        $query = "SELECT * FROM INSPECTION_NOTICE_TYPE";
        $queryResult = pg_query($query);
        while ( $row = pg_fetch_assoc($queryResult)) {
          echo "<option id=".$row['id'].">";
            echo $row['name'];
          echo "</option>";
        }
        ?>
      </select>
      </div>
      <div class="row-fluid" style="float: left;padding-left: 10px;">
      <h4>Status</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="noticeStatus">
        <?php
        $query = "SELECT * FROM INSPECTION_STATUS";
        $queryResult = pg_query($query);
        while ( $row = pg_fetch_assoc($queryResult)) {
          echo "<option id=".$row['id'].">";
            echo $row['inspection_status'];
          echo "</option>";
        }
        ?>
      </select>
      </div>
      <div style="clear: both;"></div>
      <br>
      <div class="form-group">
      <h4>Compliance Date</h4>
      <?php
        echo '<input type="text" class="form-control" id="ComplianceDate" style="width: 35%" value="'.date('Y-m-d').'">';
      ?>
      <div style="clear: both;"></div>
      <br>
      <div>
      <h4 >Attachment</h4>
      <h4 id="label"></h4>
      <label class="btn btn-default" >
      Browse <input type="file" id="fileInput" hidden>
      </label>
      </div>
      <script type="text/javascript">
        document.getElementById('fileInput').onchange = function () {
          var f =  this.value;
          f = f.replace(/.*[\/\\]/, '');
          document.getElementById("label").innerHTML = f;
        };
      </script>
      <br>
      <button type="button" class="btn btn-primary btn-lg" onclick="sendData();">Create Notice</button>
  </div>
  </form>
</html>