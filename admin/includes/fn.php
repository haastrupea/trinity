<?php
use uploadHelperClass\UploadFile;
require_once 'classes/UploadFile.php'; 

//function

//repeated definition in event to be consolidated later

function uploadFile(Array $file,String $destination,String $fileName,bool $hashname=true,Array $option=['fileType'=>'image','fileSize'=>524288]){
    $message=[];
    $filetype=$option['fileType'];
    $max_file_size= $option['fileSize'];
    

    try {
        $upload = new UploadFile($destination, $filetype);
        $upload->setMaxSize($max_file_size);
        if($fileName){
            $upload->setfileName($fileName,$hashname);
        }

        $upload->upload($file,false);
        $result = $upload->getMessages();

    if(is_array($result)){
        $message=array_merge($message,$result); 
    }
    unset($result);

    } catch (Exception $e) {
    array_push($message,$e->getMessage());
    }
if(empty($message)){

    return ['hash'=>$upload->gethashfilename(),'message'=>$message];
}else{
    return ['message'=>$message];
}
}

function fetch_video(String $Vid){
    $client = new Google_Client();
    $client->setApplicationName('fetching Sermon video from youtube');
    $api_key="google API key goes here";
    $client->setDeveloperKey($api_key);
    // Define service object for making API requests.
    $service = new Google_Service_YouTube($client);

    $queryParams = [
            'id' => $Vid,
            'fields' => 'items(id,snippet(publishedAt,tags,title,description))'
            ];
        // $response = $service->videos->listVideos('id,snippet', $queryParams);
        return $service->videos->listVideos('id,snippet', $queryParams);
}
function get_video_thumbnail(String $Vid,String $quality=''){
    $url='https://i.ytimg.com/vi/';
    $url.=$Vid.'/';
    switch (strtolower($quality)) {
        case 'mq':
        $url.='mq';

            break;
        case 'hq':
        $url.='hq';
           
            break;
        case 'sd':
        $url.='sd';
          
            break;
    }
    $url.='default.jpg';

    return $url;
}

function wordCount(String $str){
    if($str===""){
        return false;
    }else{
        return count(explode(" ", $str));
    }
}
