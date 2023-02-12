<?php
// session_start();
// session_destroy();

include("connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Crud_opeation_new</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  
</head>

<body>
  <div class="container">
    <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION </h1>

    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Registration</button>
    </div>
  <a href="logout.php"><button type="submit" class="btn btn-danger" style="margin-left:80%;">Logout</button></a>
    


    <div>
      <h2 class="text-danger">All records</h2>
      <div id="records_contant"> </div>
    </div>

    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header text-dark">
            <h4 class="modal-title"> AJAX CRUD OPERATION </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body text-dark">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="" id="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label>Number</label>
              <input type="text" name="" id="number" class="form-control" placeholder="Number Name">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="" id="email" class="form-control" placeholder="Email Name">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="" id="address" class="form-control" placeholder="Enter Address">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" name="" id="country" class="form-control" placeholder="Country Name">
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" name="" id="city" class="form-control" placeholder="City Name">
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='addRecord()'>Register</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- update model  -->


    <div class="modal "id="update_user_modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header text-dark">
            <h4 class="modal-title"> AJAX CRUD OPERATION </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
 
          </div>

          <!-- Modal body -->
          <div class="modal-body text-dark">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="" id="update_name" class="form-control" placeholder="Update_Name">
            </div>
            <div class="form-group">
              <label>Number</label>
              <input type="text" name="" id="update_number" class="form-control" placeholder="Update_Number">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="" id="update_email" class="form-control" placeholder="Update_Email">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="" id="update_address" class="form-control" placeholder="Update_Address">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" name="" id="update_country" class="form-control" placeholder="Update_Country">
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" name="" id="update_city" class="form-control" placeholder="Update_City">
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal"
              onclick="updateuserdetail()">Update</button>

              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="hidden" name="" id="hidden_user_id">
          </div>

        </div>
      </div>
    </div>

  </div>

<!-- java script  -->


  <script>
    // show table
    $(document).ready(function () {              //refresh 
      readrecord();                           //karne par table show
    });                                        //hogi


    
    // fetch data from database
    function readrecord() {
      var readrecord = "readrecord";

      $.ajax({
        url: "backend.php",
        type: 'post',
        data: { readrecord: readrecord },
        success: function (data, status) {

          $('#records_contant').html(data);
        }
      });

    }


    // insert data in database 
    function addRecord() {
      var name = $('#name').val();
      var number = $('#number').val();
      var email = $('#email').val();
      var address = $('#address').val();
      var country = $('#country').val();
      var city = $('#city').val();

      $.ajax({
        url: "backend.php",
        type: 'post',
        data: {
          name: name,
          number: number,
          email: email,
          address: address,
          country: country,
          city: city
        },
        success: function (data, status) {
          readrecord();
        }

      });

    }


    // delete data

    function DeleteUser(deleteid) {
      var conf = confirm("Are you sure");
      if (conf == true) {
        $.ajax({
          url: "backend.php",
          type: 'post',
          data: { deleteid: deleteid },
          success: function (data, status) {
            readrecord();
          }
        });
      }
    }

    //update record data
    function GetUserDetails(id) {
      $('#hidden_user_id').val(id);

      $.post( "backend.php",{
               id:id
      }, function(data,status){
          var user = JSON.parse(data);
          $('#update_name').val(user.name);
          $('#update_number').val(user.number);
          $('#update_email').val(user.email);
          $('#update_address').val(user.address);
          $('#update_country').val(user.country);
          $('#update_city').val(user.city);

      }

      );
      
      $('#update_user_modal').show();

    }

    function updateuserdetail(){
      var name_update = $('#update_name').val();
      var number_update = $('#update_number').val();
      var email_update = $('#update_email').val();
      var address_update = $('#update_address').val();
      var country_update = $('#update_country').val();
      var city_update = $('#update_city').val();

      var hidden_user_id_update = $('#hidden_user_id').val();

      $.post("backend.php",{
             hidden_user_id_update : hidden_user_id_update,
             name_update : name_update,
             number_update : number_update,
             email_update : email_update,
             address_update : address_update,
             country_update : country_update,
             city_update : city_update,
      },

      function(data,status){
        $('#update_user_modal').hide();
        readrecord();
      }
      
      
      );

    }

  </script>
</body>

</html>