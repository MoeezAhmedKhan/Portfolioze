<?php
include('../connection.php');

if($_POST['token'] == 'as23rlkjadsnlkcj23qkjnfsDKJcnzdfb3353ads54vd3favaeveavgbqaerbVEWDSC')
{
    
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $profile = $_FILES["profilepic"]["name"];
                
    $target_dir = "../Uploads/";
    $target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 
    $check_if_dataisin_db = "SELECT * FROM `users` WHERE `id` = ".$user_id;
    $execute = mysqli_query($conn,$check_if_dataisin_db);
    
    if(mysqli_num_rows($execute) > 0)
    {
        
       $filewithnewname =  rand()."_".date("Ymdis")."_DP.".$imageFileType;  
       if(move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_dir.$filewithnewname))
       {
           
           $fetch_user_data = mysqli_fetch_array($execute);
           $user_id = $fetch_user_data['id'];
           $update_data = "UPDATE `users` SET `full_name`= '$fullname',`img`= '$filewithnewname' WHERE `id` = '$user_id'";
           $execute_update = mysqli_query($conn,$update_data);
           
           if($execute_update)
           {
               
                $temp = [
                           "user_id"=>$fetch_user_data['id'],
                           "full_name"=>$fetch_user_data['full_name'],
                           "profile_pic"=>$filewithnewname,
                        ];
                        
               $data = [
                            "status"=>true,
                            "message"=>"Profile updated successfully.",
                            "data"=>$temp
                        ];
               echo json_encode($data); 
               
           }
        }
       else
       {
           $data = [
                       "status"=>false,
                        "message"=>"data update failed beacuse image is not upload on the database folder"
                   ];
            echo json_encode($data);
       }
    }
    else
    {
           
            $data = ["status"=>false,
                "message"=>"User does'nt exist"];
            echo json_encode($data); 
     }
       
}
else
{
  $data = ["status"=>false,
            "Response_code"=>403,
            "Message"=>"Access denied"];
  echo json_encode($data);          
}
?>