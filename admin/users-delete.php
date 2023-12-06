<?php

require '../config/function.php';

$paraResult = checkParamId('id');
if (is_numeric($paraResult)) {
        $userId = validate($paraResult);
        $user = getById('users',$userId);
    if ($user['status'] == 200) {
        $userDeleteRes = deleteQuery('users',$userId);
        if ($userDeleteRes) {
            redirect('users.php','User Deleted Sucessfully');

        }else{
            redirect('users.php','Something Went Wrong');
        }
    } else {
        redirect('users.php',$user['message']);
    }
    
} else {
    redirect('users.php',$paraResult);
}
