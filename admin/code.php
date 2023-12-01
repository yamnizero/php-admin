><?php

require '../config/function.php';

if (isset($_POST['saveUser'])) {
  $name = validate($_POST['name']);
  $phone = validate($_POST['phone']);
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);
  $is_ban = validate($_POST['is_ban']) == true ? 1 :0;
  $role = validate($_POST['role']);


  if ($name != '' || $email !='' || $phone != '' || $password != '') {
    $query= "INSERT INTO users (name,phone,email,password,is_ban,role)
     VALUES ('$name','$phone','$email','$password','$is_ban','$role')";
     
     $reuslt = mysqli_query($conn,$query);
     if ($reuslt) {
      redirect('users.php','User\Admin Added Sucessfully');
     } else {
      redirect('users-create.php','Something Went Wrong');
     }
     
  }else{
    redirect('users-create.php','Please Fill All Input Fields');
  }
}

if (isset($_POST['updateUser'])) {
  $name = validate($_POST['name']);
  $phone = validate($_POST['phone']);
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);
  $is_ban = validate($_POST['is_ban']) == true ? 1 :0;
  $role = validate($_POST['role']);

  $userId = validate($_POST['userId']);
  $user = getById('users',$userId);
  if ($user['status'] != 200) {
    redirect('users-edit.php?id='.$userId,'No Such Id Found');
  } 


  if($name != '' || $email !='' || $phone != '' || $password != '') {
    $query= "UPDATE users SET 
    name ='$name',
    phone ='$phone',
    email ='$email',
    password ='$password',
    is_ban ='$is_ban',
    role ='$role'
    WHERE id='$userId'";
     
     $reuslt = mysqli_query($conn,$query);
     if ($reuslt) {
      redirect('users.php','User\Admin Updated Sucessfully');
     } else {
      redirect('users-create.php','Something Went Wrong');
     }
     
  }else{
    redirect('users-create.php','Please Fill All Input Fields');
  }
}