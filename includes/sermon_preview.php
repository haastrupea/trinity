<?php
require_once "admin/includes/dbcons.php";
require_once "admin/includes/fn.php";
$image_dir ='assets/uploads/images/';
$upd_dir ='assets/uploads/';
if(!$db){
    return;
}
function fetchsermon ($sort_by="",$limit=0,$offset=0){
    global $db;
    $qry_s='SELECT *,sermons.sermon_id FROM sermons LEFT JOIN preachers ON preachers.preachers_id=sermons.sermon_preacher_id LEFT JOIN sermon_transcription ON sermons.sermon_id=sermon_transcription.sermon_id WHERE sermons.sermon_publish_status is not null AND sermons.sermon_publish_date<=CURRENT_DATE()';
    if($sort_by){
        $qry_s.= ' ORDER BY ';
    
  switch ($sort_by) {
   case 'date':
   $qry_s .= 'preached_on';
   $qry_s .= ' DESC';
    break;
   case 'topic':
   $qry_s .= 'sermon_topic';
    break;
   case 'preacher':
   default:
   $qry_s .= 'preachers.preacher_name';
}

}
    if($limit!==0){
        $qry_s.=" LIMIT {$limit}";
        $qry_s.=" OFFSET {$offset}";
    }

    $ask=$db->query($qry_s);
    return $ask->fetchAll(PDO::FETCH_ASSOC);
}
$s=fetchsermon('date',6);

?>

<?php if(!empty($s)): ?>
<?php foreach ($s as $key => $sermon):
    $s_topic=$sermon['sermon_topic'];
    $s_preacher=$sermon['preacher_name'];
    $s_id=$sermon['sermon_id'];
    $s_ytube=$sermon['sermon_youtube_vld'];
    if(empty($s_ytube)){
        $s_folder=$sermon['folder_hash_key'];
        $s_img=$sermon['sermon_cover_image'];
        if(!empty($s_img)){
            $s_poster=$upd_dir."sermons/".$s_folder."/".$s_img;
        }else{
            $s_poster="images/sermons-2.jpg";
        }
    }else{
        $s_poster=get_video_thumbnail($s_ytube,"mq");
    }
    ?>
    <div class="col-md-4 animate">
    <div class="sermons">
    <a href="sermon.php?s_id=<?php echo $s_id ?>" class="img mb-3 d-flex justify-content-center align-items-center" style="background-image: url(<?php echo $s_poster ?>);">
            <div class="icon d-flex justify-content-center align-items-center">
                <span class="fas fa-play"></span>
            </div>
        </a>
        <div class="text">
            <h3 class="text-capitalize"><a href="sermon.php?s_id=<?php echo $s_id ?>"><?php echo $s_topic ?></a></h3>
            <span class="position"><?php echo $s_preacher ?></span>
        </div>
    </div>
</div>

<?php endforeach ?>
<div class="col-12 my-5 justify-content-center">
                            <div class="col-md-2 animate offset-5">
                                 <a href="sermons.php" class="btn btn-primary rounded">All Sermons</a>            
                            </div>
                        </div>
<?php else: ?>
<div class="col-md-12 mb-2">
    <div class="d-flex align-items-center justify-content-center alert alert-info">
        <h3 class="fa fa-database  pr-1"></h3>
         <h3> No Sermon has been published yet</h3>
        </div>
        <h5 class="fa fa-exclamation-triangle bg-warning py-3 px-2"> Please do check back soon</h5>
     </div>
<?php endif ?>