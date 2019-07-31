<?php
session_start();
use uploadHelperClass\UploadFile;
$message     = [];
$basefolder  = dirname(__DIR__, 3) . '/assets/uploads/sermons/';
if(isset($_SESSION['logged_in'])){
    $createdby = $_SESSION['logged_in'];
}
$action_fail = true;
try {
    include_once "../dbcons.php";
    if (!file_exists('../../vendor/autoload.php')) {
        // throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
        $err = sprintf('Composer: Missing dependencies ');
        array_push($message, $err);

    } else {
        require_once '../../vendor/autoload.php';
    }

    require_once '../fn.php';
} catch (Exception $e) {
    // $message=$e->getMessage();
    $erred = $e->getMessage();
}
if (!$db) {
    $message[] = "Database error:try again later";
}

if (empty($message) && isset($_POST['add_sermon'])) {
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    //via_y second visit || via_f first visit
    if ((isset($_SESSION['y_res']) || $_POST['add_sermon'] === "via_file")) {
        //via_y second visit || via_f first visit
        $col_names    = [];
        $placeholders = [];
        $values       = [];

        $sermon_title = trim($_POST['sermon_topic']);
        if ($sermon_title === "") {
            array_push($message, "Sermon topic cannot be blank");
        }

        $sermon_desc = trim($_POST['sermon_description']);
        if ($sermon_desc === "") {
            array_push($message, "Sermon description cannot be blank");
        }
        $sermon_keywords = trim($_POST['keyword']);
        if ($sermon_keywords === "") {
            array_push($message, "Please provide minimum of one keyword");
        }
        $date_preached = $_POST['sermon_date'];

        $sermon_preacher = trim($_POST['preacher']);
        if ($sermon_preacher === "") {
            array_push($message, "Preacher name cannot be blank");
        }
            //Transaction begin
            $db->beginTransaction();
        if (empty($message)) {
            array_push($col_names, "sermon_topic", "preached_on", "sermon_description", "sermon_keywords","created_by");
            array_push($placeholders, ":topic", ":date_preached", ":description", ":keywords",":user");
            array_push($values, $sermon_title, $date_preached, $sermon_desc, $sermon_keywords,$createdby);
            //build preacher insert query;
            $sql_preacher_exist    = 'SELECT COUNT(*) as row FROM `preachers` WHERE  preacher_name=?';
            $q_preacher_exist=$db->prepare($sql_preacher_exist);
            if($q_preacher_exist->execute([$sermon_preacher])){
                if(!$q_preacher_exist->fetchColumn()){
                    $sql_new_preacher   = 'INSERT INTO preachers (preacher_name)  VALUE(?)';
                    $new_preacher=$db->prepare($sql_new_preacher);

                    if(!$new_preacher->execute([$sermon_preacher])){
                        array_push($message,"Database error, please try again later");
                    }
                }
            }

         if(empty($message)){
                //no error uptil now
            //let fetch the id of the preacher of the sermon
            $sql_preacher     = 'SELECT preachers_id as p_id FROM `preachers` WHERE  preacher_name=?';
            $p_query_preacher = $db->prepare($sql_preacher);
            if (!($p_query_preacher->execute([$sermon_preacher]))) {
                $db->rollBack();
                array_push($message, "Database error, Please try again");
            } else {
                $preacher_id = $p_query_preacher->fetch(PDO::FETCH_ASSOC)['p_id'];
                // add to query chain
                array_push($col_names, "sermon_preacher_id");
                array_push($placeholders, ":preacher_id");
                array_push($values, $preacher_id);
            }
         }

        } //fetch and set $preacher_id

        $publish = trim($_POST['publish']);

        switch ($publish) {
            case 'now':
                $publish_on = date('Y-m-d');
                array_push($col_names, "sermon_publish_date");
                array_push($placeholders, ":publish_date");
                array_push($values, $publish_on);
                break;
            case 'until':

                $publish_on = trim($_POST['until']);
                if (empty($publish_on)) {
                    array_push($message, "Please provide a publishing date");
                } else {
                    array_push($col_names, "sermon_publish_status", "sermon_publish_date");
                    array_push($placeholders, ":publish_status", ":publish_date");
                    array_push($values, $publish, $publish_on);
                }
                break;
            case 'later':
                array_push($col_names, "sermon_publish_status");
                array_push($placeholders, ":publish_status");
                array_push($values, $publish);
                break;
        }

        //for via_f
        if (empty($message) && $_POST['add_sermon'] === "via_file") {
            $hashFolder = UploadFile::hash($sermon_title); //hashed folder name that house both sermon audio or poster
            $structure  = $basefolder . $hashFolder; //directory to upload sermon audio or poster image
            if (!file_exists($structure)) {
                if (!mkdir($structure, 0777, true)) {
                    array_push($message, "Permission error:trinity could not create a new folder");
                }
            } //create folder sermons/$hashFolder

            if (empty($message)) {
                //add to query chain the foldername
                array_push($col_names, "folder_hash_key");
                array_push($placeholders, ":folder_hash_key");
                array_push($values, $hashFolder);

                //move uploaded file to their location;
                $fileNewname =$sermon_preacher . "_" . $sermon_title;
                $hashNewname = true;
                $getID3      = new getID3; // Initialize getID3 engine
                $have_poster = false;
                $poster_file = $_FILES['sermon_poster'];
                $sermon_file = $_FILES['sermon_audio'];
                if (is_uploaded_file($poster_file['tmp_name']) && empty($message)) {
                    $have_poster     = true;
                    $max_sermon_size = UploadFile::convertToBytes("512k");
                    $sermon_filetype = "image";
                    $format          = $getID3->analyze($poster_file['tmp_name'])['fileformat'];
                    $allowImg        = UploadFile::gethAllowfileType($sermon_filetype);
                    if (in_array($format, $allowImg)) {
                        $res = uploadFile($poster_file, $structure, $fileNewname, $hashNewname, ['fileType' => $sermon_filetype, 'fileSize' => $max_sermon_size]);
                        $msg = $res['message'];
                        if (empty($msg)) {
                            array_push($col_names, "sermon_cover_image");
                            array_push($placeholders, ":cover_image");
                            array_push($values, $res['hash']);
                        } else {
                            if (is_array($msg) && !empty($msg)) {
                                foreach ($msg as $key => $value) {
                                    array_push($message, $value);
                                }
                            }
                        }
                    } else {
                        array_push($message, "Sermon Poster Image must be " . implode(",", $format) . " file");
                    }
                } //handle sermon poster image upload/ it is optional field

                if (is_uploaded_file($sermon_file['tmp_name'])) {
                    $max_sermon_size = UploadFile::convertToBytes("50M");
                    $sermon_filetype = "audio";
                    $format          = $getID3->analyze($sermon_file['tmp_name'])['fileformat']; //format of the uploaded file
                    $allowAudio      = UploadFile::gethAllowfileType($sermon_filetype);

                    if (in_array($format, $allowAudio)) {
                    //file must be mp3
                        $getID3->setOption(array('encoding' => 'UTF-8'));
                        $tagwriter                 = new getid3_writetags;
                        $tagwriter->tagformats     = array('id3v1', 'id3v2.4');
                        $tagwriter->filename       = $sermon_file['tmp_name']; //file to add tag to
                        $tagwriter->overwrite_tags = true; //overide exiating tag

                        //two dimentional array for id3data
                        $TagData['title'][]   = $sermon_title;
                        $TagData['artist'][]  = $sermon_preacher;
                        $TagData['album'][]   = $sermon_title;
                        $TagData['year'][]    = empty($publish_on) ? date('Y') : date('Y', strtotime($publish_on));
                        $TagData['comment'][] = $sermon_desc;
                        $TagData['genre'][]   = "sermon";
                        if ($have_poster) {
                            $cover = $poster_file['tmp_name'];

                            if (in_array('id3v2.4', $tagwriter->tagformats) || in_array('id3v2.3', $tagwriter->tagformats) || in_array('id3v2.2', $tagwriter->tagformats)) {

                                if (is_uploaded_file($cover)) {
                                    if ($APICdata = file_get_contents($cover)) {

                                        if ($exif_imagetype = exif_imagetype($cover)) {
                                            $TagData['attached_picture'][0]['data']          = $APICdata;
                                            $TagData['attached_picture'][0]['picturetypeid'] = "cover";
                                            $TagData['attached_picture'][0]['description']   = $sermon_keywords;
                                            $TagData['attached_picture'][0]['mime']          = image_type_to_mime_type($exif_imagetype);
                                        }
                                    }
                                }
                            }
                        } //add tag picture to the id3tag

                        $tagwriter->tag_data = $TagData;
                        $tagwriter->WriteTags(); //write id3 info to file
                        $res = uploadFile($sermon_file, $structure, $fileNewname, $hashNewname, ['fileType' => $sermon_filetype, 'fileSize' => $max_sermon_size]);
                        $msg = $res['message'];
                        if (empty($msg)) {
                            array_push($col_names, "sermon_audio_file");
                            array_push($placeholders, ":audio_file");
                            array_push($values, $res['hash']);
                        } else {
                            if (is_array($msg) && !empty($msg)) {
                                foreach ($msg as $key => $value) {
                                    array_push($message, $value);
                                }
                            }
                        }
                    } else {
                        array_push($message, "Sermon must be " . implode(",", $format) . " file");
                    }
                } else {
                    array_push($message, "Please specify the Sermon audio");
                } //handle sermon audio upload with id3tag addition

            } // run when user need to upload sermon audio or poster image

        } //handle sermon files upload

        //for via_y
        if (empty($message) && $_POST['add_sermon'] === "via_youtube") {
            if (isset($_SESSION['y_res'])) {
                //add youtube video id
                array_push($col_names, "sermon_youtube_vld");
                array_push($placeholders, ":youtube_vld");
                array_push($values, $_SESSION['y_res']['id']);
            }
        }

        $inserted= false;
        $sql_sermon_count = "SELECT count(*) as row FROM sermons WHERE sermon_topic=:sermon_title AND sermon_description=:sermon_desc";
        $q_sermon_count   = $db->prepare($sql_sermon_count);
        $q_sermon_count->execute([':sermon_title' => $sermon_title, ':sermon_desc' => $sermon_desc]);
        $result_row = $q_sermon_count->fetch(PDO::FETCH_ASSOC)['row'];
        $s_values   = array_combine($placeholders, $values); //sermon bind_value array for execute();

        if ($result_row >= 1) {
            array_push($message, "Sermon already exist");
            $action_fail = false;
            if (isset($_SESSION['y_res'])) {
                unset($_SESSION['y_res']);
            }
         } else {
            $sermon_sql = "INSERT INTO sermons (" . implode(',', $col_names) . ") ";
            $sermon_sql .= "VALUE (";
            $sermon_sql .= implode(',', $placeholders);
            $sermon_sql .= " )";
            
            $s_q = $db->prepare($sermon_sql);
          
            if (!($s_q->execute($s_values))) {
                array_push($message, "Unable to add sermon, please try again");
            } else {
                $inserted = true;
            }
        }

        $trans = trim($_POST['sermon_transcription']);
        if (($inserted && empty($message)) && $trans !== "") {
            $wordcount = wordCount($trans);
            if (is_int($wordcount) && $wordcount < 50) {
                array_push($message, "Sermon transcription Should be above 50 words");
            } else {
                $sql_sermon = "SELECT sermon_id as id FROM sermons WHERE sermon_topic=:sermon_title AND sermon_description=:sermon_desc";

                $q_sermon = $db->prepare($sql_sermon);
                $q_sermon->execute([':sermon_title' => $sermon_title, ':sermon_desc' => $sermon_desc]);

                $sermon_id = $q_sermon->fetch(PDO::FETCH_ASSOC)['id']; //get id of current sermon

                $sql_trans = "INSERT INTO sermon_transcription (transcription,sermon_id) VALUE(:transc,:sermon_id)";
                if ($sermon_id !== null) {
                    $qry_trans = $db->prepare($sql_trans);
                    if (!$qry_trans->execute([':transc' => $trans, ':sermon_id' => $sermon_id])) {
                        array_push($message, "Transcription couldn't be added, add Sermon again");
                    }
                    ; // add transcription for the sermon
                }

            }
        }

        if ($inserted && empty($message)) {
            if (isset($_SESSION['y_res'])) {
                unset($_SESSION['y_res']);
            }
            $db->commit();
            $action_fail = false;
            array_push($message, "Sermon added successfully");
         } else {
            $db->rollBack();
        }
    }

    //for via_y
    if (empty($message) && !isset($_SESSION['y_res']) && $_POST['add_sermon'] === "via_youtube") {
        //via_y first visit
        $sermon = [];
        $url   = parse_url($_POST['youtube_link'], PHP_URL_QUERY);
        parse_str($url, $qr);
        if (isset($qr['v']) === false) {
            array_push($message, "Invalid Link provided");
        } else {

            $sql_sermon_count = "SELECT count(*) as row FROM sermons WHERE sermon_youtube_vld=?";
            $q_sermon_count   = $db->prepare($sql_sermon_count);
            $q_sermon_count->execute([$qr['v']]);
            $result_row = $q_sermon_count->fetch(PDO::FETCH_ASSOC)['row'];

            if ($result_row >= 1) {
                array_push($message, "Sermon already exist");
            } else {

                try {
                    $res = fetch_video($qr['v']);

                } catch (Exception $th) {
                    $error = $th->getMessage();
                }

                if (isset($error)) {
                    $parsed_err = json_decode($error, true)['error']['message'];
                    if (!empty($parsed_err)) {
                        array_push($message, $parsed_err);
                    } else {
                        array_push($message, "Error while accessing youtube,Check your internet connection");
                    }

                } else {
                    if (!empty($res->items)) {
                        $item                    = $res->items[0];
                        $sermon['id']            = $item['id'];
                        $sermon['title']         = trim($item['snippet']['title']);
                        $uniq                    = array_unique(explode(" ", trim(implode(" ", $item['snippet']['tags']))));
                        $filters                 = ['and', 'of', 'a', "with", "an", "the", "you", "me", "this", "are","where","when","would","could"];
                        $result                  = array_diff($uniq, $filters);
                        $sermon['keywords']      = implode(",", $result);
                        $sermon['desc']          = trim($item['snippet']['description']);
                        $sermon['date_preached'] = trim($item['snippet']['publishedAt']);

                        $_SESSION['y_res'] = $sermon;

                    } else {
                        array_push($message, "No Video found, make sure your link is directly copied from youtube");
                    }
                } //via_y first visit
            } //video has not existed before

        }
    } //via_y first visit

    if ($action_fail && $_POST['add_sermon'] === "via_file") {
        //delete any file that has been uploaded for the sermon that fail to get into db
        $dir_folder = $basefolder . $hashFolder;
        // chmod($dir_folder,0777);
        if (!empty($sermon_file['tmp_name'])) {
            $aud_file = $dir_folder . "/" . $s_values[':audio_file'];

            // chmod($aud_file,0777);
            if (is_readable($aud_file) && is_writable($aud_file)) {
                unlink($aud_file); //delete audio file         
            }

        }

        if (!empty($poster_file['tmp_name'])) {
            $pic_file = $dir_folder . "/" . $s_values[':cover_image'];
            // chmod( $pic_file,0777);
            // print_r($poster_file['tmp_name']);

            if (is_readable($pic_file) && is_writable($pic_file)) {
                unlink($pic_file); //delete cover pic        
            }

        }

        if (is_dir($dir_folder) && is_writable($dir_folder)) {
            rmdir($dir_folder); //delete hashfolder
        }
    }

    // print_r($have_poster);

    if (!empty($message)) {
        $_SESSION['message'] = $message;
    }


    if (isset($_POST['add_sermon']) && $_POST['add_sermon'] === "via_youtube") {
        header("Location: ../../index.php?page=sermon&action=add-sermon&via=y");
        exit;
    }

    if (isset($_POST['add_sermon']) && $_POST['add_sermon'] === "via_file") {
        header("Location: ../../index.php?page=sermon&action=add-sermon&via=f");
        exit;
    }

}

if (isset($_POST['sermon_search'])) {
    $srcq = trim($_POST['sermon_search']);
    if (!empty($srcq)) {
        header("Location: ../../index.php?page=sermon&q=" . urlencode($srcq));
        exit();
    }
}

header("Location: ../../index.php?page=sermon");
exit;
