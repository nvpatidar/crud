<?php
// session_start();
include("connect.php");

// $user_profile = $_SESSION['userdata'];

// if($user_profile== true){
//   // header('location:registration.php');
// }
// else{
//   header ('location:admin.php');
// }


if(isset($_POST['readrecord'])){

    $data = '<table class="table table-bordered  table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Sr no </th>
        <th scope="col">Name</th>
        <th scope="col">Number</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Country</th>
        <th scope="col">Image</th>
        <th scope="col">City</th>
        <th scope="col">Edit Action</th>
        <th scope="col">Delete Action</th>


      </tr>
    </thead>';
    $display_sql = "select * from crud_table";
    $result = mysqli_query($con, $display_sql);
    if(mysqli_num_rows($result) > 0){
        $number = 1;
        while($row = mysqli_fetch_array($result)){

            $data .= '<tr>
                 <th scope="row">'.$number.'</th>
                <td>'.$row['name'].'</td>
                <td>'.$row['number'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['address'].'</td>
                <td>'.$row['country'].'</td>
                <td>'.$row['image'].'</td>
                <td>'.$row['city'] .'</td>
            <td>
            <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
            </td>
            <td>
            <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
            </td>
            </tr>';
            $number++;
            
        }
    }
    $data .= '</table>';
    echo $data;
}

extract($_POST);

if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['email']) &&
     isset($_POST['address']) && isset($_POST['country']) && isset($_POST['city']))
     {
    $sql = "insert into `crud_table`(name,number,email,address,country,city)values
                 ('$name','$number','$email','$address','$country','$city')";

    $result = mysqli_query($con, $sql);
     
     }

     // delete user record
 if(isset($_POST['deleteid'])){
    $userid = $_POST['deleteid'];
    $deletesql = "delete from crud_table where id = '$userid'";
    $result = mysqli_query($con, $deletesql);
 }




// data_updated;

if(isset($_POST['id'])){
  
  $user_id = $_POST['id']; 

  $sql = "select * from crud_table where id ='$user_id'";
  if(!$result = mysqli_query($con,$sql)){
    exit(mysqli_error());
  }

  $response = array();

  if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
      $response = $row;
    }
  }
  else{
    $response['status'] = 200;
    $response['message'] = "data not found"; 

  }

  echo json_encode($response);
}
else{
  $response['status'] = 200;
  $response['message'] = "invalid request";
}

//update table....

if(isset($_POST['hidden_user_id_update'])){

  $hidden_user_id_update = $_POST['hidden_user_id_update'];
  $name_update = $_POST['name_update'];
  $number_update = $_POST['number_update'];
  $email_update = $_POST['email_update'];
  $address_update = $_POST['address_update'];
  $country_update = $_POST['country_update'];
  $city_update = $_POST['city_update'];

  $sql_update = "update crud_table set name = '$name_update',number = '$number_update',email = '$email_update',address = '$address_update',
                  country = '$country_update',city = '$city_update' where id = '$hidden_user_id_update'";

  $result = mysqli_query($con, $sql_update);

}

?>