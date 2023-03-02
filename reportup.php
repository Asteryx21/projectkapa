<?php 
// Include the database config file 
@include 'dbconnection.php';
// File upload folder 
$uploadDir = 'uploads/'; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 

function compressImage($source, $destination, $quality){
    $info = getimagesize($source);

    if ($info['mime']=='image/jpeg')  $image=imagecreatefromjpeg($source);
    else if($info['mime']=='image/jpg')   $image=imagecreatefromjpeg($source);
    else if ($info['mime']=='image/png')  $image=imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;

}
// If form is submitted 
if(isset($_POST['coords']) || isset($_POST['image'])){ 
    // Get the submitted form data 
    $cords = $_POST['coords']; 
    $poluted_descrition = $_POST['subject'];
    // Check whether submitted data is not empty 
    
    if(!empty($cords)){ 
        
        $uploadStatus = 1; 
             
        $stringParts = explode(", ", $cords);

        $lat_up  = $stringParts[0]; // 855
        $longt_up = $stringParts[1]; // 21
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($_FILES["image"]["name"])){ 
            // File path config 
            $fileName = basename($_FILES["image"]["name"]); 
            $final_image = rand(1000,1000000).$fileName;
            $targetFilePath = $uploadDir . $final_image;      
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

            // Allow certain file formats to upload 
            if(in_array($fileType, $allowTypes)){ 
               
                // Upload file to the server 
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                    $uploadedFile = $final_image; 
                        // Compress uploaded image
                        // $compressedFilePath = $uploadDir . 'compressed_' . $final_image;
                        $compressedFilePath = compressImage($targetFilePath, $targetFilePath, 60);
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, there was an error uploading your file.'; 
                } 
            }else{ 
                $uploadStatus = 0; 
                $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
            } 
        }/* else{
            $uploadStatus = 0; 
            $response['message'] = 'Please select an image'; 
        }*/
    
        if($uploadStatus == 1){ 

                
            // Insert form data in the database 
            $insert = $conn->query("INSERT reports (lat,longt,descr,file_name) VALUES ('".$lat_up."','".$longt_up."','".$poluted_descrition."','".$uploadedFile."')");
                
            if($insert){ 
                $response['status'] = 1; 
                $response['message'] = 'Form data submitted successfully!'; 
            } 
        }  
    }else{ 
         $response['message'] = 'Please fill all the mandatory fields (place and file).'; 
    } 
} 
 
// Return response 
echo json_encode($response);