<?php

require '../config/function.php';

$paraResult = checkParamId('id');
if (is_numeric($paraResult)) {
        $servicesId = validate($paraResult);

        $services = getById('services',$servicesId);
     if ($services['status'] == 200) {
        $servicesDeleteRes = deleteQuery('services',$servicesId);
        if ($servicesDeleteRes) {

            $deleteImage = "../".$path.$services['data']['image'];
            if (file_exists( $deleteImage)) {
              unlink($deleteImage);
            }
            
            redirect('services.php','Services Deleted Sucessfully');

        }else{
            redirect('services.php','Something Went Wrong');
        }
    } else {
        redirect('services.php',$services['message']);
    }
    
} else {
    redirect('services.php',$paraResult);
}
