><?php

  require '../config/function.php';

  if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $is_ban = validate($_POST['is_ban']) == true ? 1 : 0;
    $role = validate($_POST['role']);


    if ($name != '' || $email != '' || $phone != '' || $password != '') {
      $query = "INSERT INTO users (name,phone,email,password,is_ban,role)
     VALUES ('$name','$phone','$email','$password','$is_ban','$role')";

      $reuslt = mysqli_query($conn, $query);
      if ($reuslt) {
        redirect('users.php', 'User\Admin Added Sucessfully');
      } else {
        redirect('users-create.php', 'Something Went Wrong');
      }
    } else {
      redirect('users-create.php', 'Please Fill All Input Fields');
    }
  }

  if (isset($_POST['updateUser'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $is_ban = validate($_POST['is_ban']) == true ? 1 : 0;
    $role = validate($_POST['role']);

    $userId = validate($_POST['userId']);
    $user = getById('users', $userId);
    if ($user['status'] != 200) {
      redirect('users-edit.php?id=' . $userId, 'No Such Id Found');
    }


    if ($name != '' || $email != '' || $phone != '' || $password != '') {
      $query = "UPDATE users SET 
    name ='$name',
    phone ='$phone',
    email ='$email',
    password ='$password',
    is_ban ='$is_ban',
    role ='$role'
    WHERE id='$userId'";

      $reuslt = mysqli_query($conn, $query);
      if ($reuslt) {
        redirect('users.php', 'User\Admin Updated Sucessfully');
      } else {
        redirect('users-create.php', 'Something Went Wrong');
      }
    } else {
      redirect('users-create.php', 'Please Fill All Input Fields');
    }
  }

  if (isset($_POST['saveSetting'])) {
    $title = validate($_POST['title']);
    $slug = validate($_POST['slug']);

    $small_description = validate($_POST['small_description']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);

    $email1 = validate($_POST['email1']);
    $email2 = validate($_POST['email2']);
    $phone1 = validate($_POST['phone1']);
    $phone2 = validate($_POST['phone2']);
    $address = validate($_POST['address']);

    $settingId = validate($_POST['settingId']);
    if ($settingId == 'insert') {
      $query = "INSERT INTO settings (title,slug,small_description,meta_description,meta_keyword,email1,email2,phone1,phone2,address)
            VALUE('$title','$slug','$small_description','$meta_description','$meta_keyword','$email1','$email2','$phone1','$phone2','$address')";

      $result = mysqli_query($conn, $query);
    }

    if (is_numeric($settingId)) {
      $query =  "UPDATE settings SET 
          title='$title',
          slug='$slug',
          small_description='$small_description',
          meta_description='$meta_description',
          meta_keyword='$meta_keyword',
          email1='$email1',
          email2='$email2',
          phone1='$phone1',
          phone2='$phone2',
          address='$address'
          WHERE id='$settingId'
           ";
      $result = mysqli_query($conn, $query);
    }

    if ($result) {
      redirect('settings.php', 'Settings Saved');
    } else {
      redirect('settings.php', 'Something Went Wrong!');
    }
  }


  if (isset($_POST['saveSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = validate($_POST['status']) == true ? 1 : 0;


    if ($name != '' || $url != '') {
      $query = "INSERT INTO social_medias (name,url,status) VALUES ('$name','$url','$status')";

      $reuslt = mysqli_query($conn, $query);
      if ($reuslt) {
        redirect('social-media.php', 'Social Media Added Sucessfully');
      } else {
        redirect('social-media-create.php', 'Something Went Wrong');
      }
    } else {
      redirect('social-media-create.php', 'Please Fill All Input Fields');
    }
  }

  if (isset($_POST['updateSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = validate($_POST['status']) == true ? 1 : 0;

    $socialMediaId = validate($_POST['socialMediaId']);


    if ($name != '' || $url != '') {
      $query = "UPDATE social_medias SET
       name='$name',
        url='$url',
        status='$status'
          WHERE id='$socialMediaId' LIMIT 1";

      $reuslt = mysqli_query($conn, $query);
      if ($reuslt) {
        redirect('social-media.php', 'Social Media Updated Sucessfully');
      } else {
        redirect('social-media-edit.php?id=' . $socialMediaId, 'Something Went Wrong');
      }
    } else {
      redirect('social-media-edit.php?id=' . $socialMediaId, 'Please Fill All Input Fields');
    }
  }

  if (isset($_POST['saveServices'])) {
    $name = validate($_POST['name']);
    $slug = str_replace(' ', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);

    if ($_FILES['image']['size'] > 0) {
      $image = $_FILES['image']['name'];

      $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {
        redirect('services.php', 'Sorry, Only JPG, JPEG, PNG images Only');
      }

      $path = "../assets/uploads/services/";
      $imgExt = pathinfo($image, PATHINFO_EXTENSION);
      $filename = time() . '.' . $imgExt;
      $fileImage = 'assets/uploads/services/' . $filename;
    } else {
      $finalImage = NULL;
    }



    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);
    $status = validate($_POST['status']) == true ? 1 : 0;



    $query = "INSERT INTO services (name,slug,small_description,long_description,image,meta_title,meta_description,meta_keyword,status) 
      VALUES ('$name','$slug','$small_description','$long_description','$fileImage','$meta_title','$meta_description','$meta_keyword','$status')";

    $reuslt = mysqli_query($conn, $query);
    if ($reuslt) {
      if ($_FILES['image']['size'] > 0) {

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
      }
      redirect('services.php', 'Services Added Sucessfully');
    } else {
      redirect('services-create.php', 'Something Went Wrong');
    }
  } 

  if (isset($_POST['updateServices'])) {
    $servicesId = validate($_POST['id']);
    $name = validate($_POST['name']);

    $slug = str_replace(' ', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);

    $services = getById('services',$servicesId);
   
    if ($_FILES['image']['size'] > 0) {
      $image = $_FILES['image']['name'];

      $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {
        redirect('services.php', 'Sorry, Only JPG, JPEG, PNG images Only');
      }

      $path = "../assets/uploads/services/";

      $deleteImage = "../".$path.$services['data']['image'];
      if (file_exists( $deleteImage)) {
        unlink($deleteImage);
      }

 
      $imgExt = pathinfo($image, PATHINFO_EXTENSION);
      $filename = time() . '.' . $imgExt;
      $fileImage = 'assets/uploads/services/' . $filename;
    } else {
      $finalImage =  $services['data']['image'];
    }



    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);
    $status = validate($_POST['status']) == true ? 1 : 0;

    $query = "UPDATE services SET 
        name ='$name',
        slug ='$slug',
        small_description ='$small_description',
        long_description ='$long_description',
        image='$fileImage',
        meta_title ='$meta_title',
        meta_description ='$meta_description',
        meta_keyword ='$meta_keyword',
        status ='$status'
        WHERE id='$servicesId'
        ";

    $result = mysqli_query($conn,$query);
    if ($result) {
      if ($_FILES['image']['size'] > 0) {

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
      }

      redirect('services-edit.php?'.$servicesId, 'Services Updated Sucessfully');
    } else {
      redirect('services-edit.php?id='.$servicesId, 'Something Went Wrong');
    }
  }