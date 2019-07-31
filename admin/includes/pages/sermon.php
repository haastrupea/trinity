<?php
if(!isset($fromindex)){
    header("Location: ../../index.php?page=sermon");
    exit;
  }
$datef         = date("Y-m-d");
$timestartf    = date("H:i");
$timeendf      = date("H") + 1;
$enddate       = mktime(date("H") + 1);
$endtime       = date("H:i", (time() + (60 * 60)));
$manage_action = "manage-sermon";
$add_action    = "add-sermon";
$via_y         = "y"; //via youtube
$via_f         = "f"; //via file upload
isset($_GET['via']) ? ($via = strtolower($_GET['via'])) : "do nothing";

$max_file_poster = $_SESSION['image_size'];
$max_file_sermon = $_SESSION['sermon_size'];

?>
<section id="sermon" class="sermon fullHeight">
      <div class="container-wrp">
          <div class="container-fluid">

              <div class="row add-n-manage-row">
                  <div class="col-md-12">
                      <div class="tab-control d-flex justify-content-around">
                          <button class="control-tab btn  col-6 <?php if (isset($action) && $action === $add_action) {
 echo "active";
}
?>"><a href="index.php?page=sermon&action=add-sermon">Add new sermon</a></button>
     <button class="control-tab btn col-6 <?php if (!isset($action) || $action !== $add_action) {
 echo "active";
}?> "><a href="index.php?page=sermon&action=manage-sermon">Manage sermon</a></button>
     </div>
    </div>
<div class="col-md-12">
    <div id="add-sermon" class="add-sermon <?php if (!isset($action) || $action !== $add_action) {
 echo "d-none";
}
?>">
        <div class="form-wrp p-4">
                <?php if (isset($_SESSION['message'])):
 foreach ($_SESSION['message'] as $key => $value):
 ?>
		                <div id="msg-alert" class="alert fs-animated
		                <?php if (strpos(strtolower($value), "successfully")) {
  echo 'alert-success  rubberBand';
 } else {
  echo 'alert-danger shake';
 }
 ?>  offset-md-2 col-md-8 text-center">
		                    <div class="d-flex align-items-center justify-content-between">
		                            <span class="fa fa-info-circle  mr-md-2"></span>
		                            <span>
		                                    <?php echo $value ?>
		                            </span>
		                            <div class="dismiss fa fa-times " onclick="cleared()">

		                            </div>
		                    </div>


		                </div>

		                    <?php
endforeach;
unset($_SESSION['message']);
endif;?>

            <?php if (!isset($via)): ?>
            <div class="sermon-form-header p-2 text-md-left text-center">
                <span class="wk wk-sermon fa-2x"> via </span>
            </div>
            <div class="upload-via text-center text-white">
                <a href="index.php?page=sermon&action=add-sermon&via=y" class="btn btn-danger"><span class="fab fa-youtube-square"></span><span> Youtube Video</span> </a>
                <span class="btn col text-dark">OR</span>
                <a href="index.php?page=sermon&action=add-sermon&via=f" class="btn btn-info"><span class="fa fa-cloud-upload-alt"></span><span> Upload Audio File</span> </a>
            </div>
            <?php endif;?>
            <form action="includes/crud/sermon.php" method="POST" class="new-sermon-form container-fluid">
            <?php if ((isset($via) && $via === $via_f) || (isset($via) && $via === $via_y && isset($_SESSION['y_res']))): ?>
            <?php if (isset($_SESSION['y_res']) && $via === $via_y) {
 $s_title       = $_SESSION['y_res']['title'];
 $s_keywords    = $_SESSION['y_res']['keywords'];
 $s_desc        = $_SESSION['y_res']['desc'];
 $date_preached = date('Y-m-d', strtotime($_SESSION['y_res']['date_preached']));
}
if ($via === $via_f && isset($_SESSION['y_res'])) {
 unset($_SESSION['y_res']);
}
?>
            <div class="whole-f">
                <div class="form-row align-items-center">
                <div class="form-group col-md-2 text-center">
  <label for="sermon-topic"> Sermon Topic:</label>
                </div>
                <div class="form-group col-md-7">
  <input type="text" name="sermon_topic" id="sermon-topic" class="form-control" required value="<?php echo isset($s_title) ? $s_title : "" ?>" >
                </div>
            </div>
            <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="preacher"> Preacher: </label>
  </div>
                <div class="form-group col-md-5">
  <input type="text" name="preacher" id="preacher" class="form-control" required>
                </div>
            </div>
                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="sermon-date">Date preached: </label>
  </div>

     <div class="form-group col-md-3">
      <input type="date" name="sermon_date" id="sermon-date" class="form-control" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" required value="<?php echo isset($date_preached) ? $date_preached : $datef; ?>" required>

     </div>
            </div>

                <div class="form-row mt-3">
  <div class="form-group col-md-2 text-center">
         <label for="publish">Publish:</label>
  </div>
                <div class="form-group col-md-3">
      <select id="publish" name="publish" class="form-control">
              <option value="now" selected>Immediately</option>
              <option value="later">Later</option>
              <option value="until">On</option>
          </select>
                </div>
                <div class="form-group col-md-4 publish">
                <input class="form-control input" type="date" name="until" id="until" min="<?php echo $datef; ?>" >
            </div>
   </div>

                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="sermon-description"> Description: </label>
  </div>
                <div class="form-group col-md-7">
  <input type="text" name="sermon_description" id="sermon-description" class="form-control" value="<?php echo isset($s_desc) ? $s_desc : "" ?>">
                </div>
            </div>
                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="keyword"> Keyword: </label>
  </div>
                <div class="form-group col-md-7">
  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="e.g Holiness,marriage,Doctrine, healing, Easter etc." value="<?php echo isset($s_keywords) ? $s_keywords : "" ?>">
                </div>
            </div>
                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="sermon-transcription"> Transcription: </label>
  </div>
                <div class="form-group col-md-7">
 <textarea name="sermon_transcription" id="sermon-transcription" rows="5" class="form-control" placeholder="Transcription will be treated as english..."></textarea>
                </div>
            </div>
            <?php if ($via === $via_y && isset($_SESSION['y_res'])): ?>
            <div class="form-row align-items-end justify-content-around">
            <div class="form-group col-9">
          <Button class="btn btn-success fa-pull-right" name="add_sermon" value="via_youtube"><span class="wk wk-add"></span> <span>Add Sermon</span></Button>
            </div>
        </div>
        <?php elseif ($via === $via_f): ?>
                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="sermon-audio">Sermon Audio (mp3):</label>
  </div>
                <div class="form-group col-md-4">

 <input type="file" name="sermon_audio" id="sermon-audio" class="form-control" accept=".mp3" required>

                </div>
                <div class="form-text col-md-3 text-info">
                    * Max file allowed is <?php echo ceil($max_file_sermon / (1024 * 1024)) ?>Mb
                </div>
            </div>
                <div class="form-row">
  <div class="form-group col-md-2 text-center">
         <label for="sermon-poster">Cover/poster (image):</label>
  </div>
                <div class="form-group col-md-4">
 <input type="file" name="sermon_poster" id="sermon-poster" class="form-control" accept=".jpg, .jpeg, .png">
                </div>
                <div class="form-text col-md-3 text-info">
                    * Max file allowed is <?php echo $max_file_poster / 1024 ?>kb
                </div>
            </div>

            <div class="form-row align-items-end justify-content-around">
                <div class="form-group col-9">
              <Button class="btn btn-success fa-pull-right" name="add_sermon" value="via_file" formenctype="multipart/form-data" ><span class="wk wk-add"></span> <span>Add Sermon</span></Button>
                </div>
            </div>
            <?php endif; // end of if for button display  ?>
             </div>

            <?php endif; //end of if for whole form?>

    <?php if ((isset($via) && $via === $via_y) && !isset($_SESSION['y_res'])): ?>
            <div class="y-form">
                <div class="form-row align-items-center justify-content-center text-left">
                    <div class="form-group col-md-7"><input type="url" name="youtube_link" id="youtube-link" class="form-control" placeholder="https://www.youtube.com/watch?v=fgjgsfjhgjaj" required>
                    </div>
                <div class="form-group col-md-4 text-center">
              <Button class="btn btn-success" name="add_sermon" value="via_youtube"><span>Fetch Sermon</span></Button>
                </div>
                <div class="form-text text-info border">
                    <span class="px-2 py-1 bg-warning">Note:</span> <span class="px-2 py-1" >If you are publishing sermon from another preacher, do seek due permission from them.</span>
                </div>
            </div>
             </div>
                    <?php endif;?>

            </form>
        </div>


    </div>



<div id="manage-sermon" class="manage-sermon pt-5 <?php
//this is the default action when no action or any invalid action is provided
if (isset($action) && $action === $add_action) {
 echo "d-none";
}
?>">
  <?php
try {
 require_once 'includes/dbcons.php';
 require_once 'includes/classes/Pagination.php';

 $sql = 'SELECT sermon_id,preachers.preacher_name,sermon_topic,preached_on,sermon_description,sermon_keywords
   FROM sermons
   LEFT JOIN preachers
   ON sermon_preacher_id=preachers.preachers_id';

 if (isset($_GET['q']) && !empty($_GET['q'])) {
  $q = (String) $_GET['q'];
  $sql .= ' WHERE preachers.preacher_name LIKE :searched OR sermon_description LIKE :searched OR sermon_topic LIKE :searched OR sermon_keywords LIKE :searched';

  if (isset($_SESSION['sermon']['sort'])) {
   unset($_SESSION['sermon']['sort']);
  }
 }
 if (!isset($_GET['pg'])) {
  unset($_SESSION['sermon']['sort_by']);
  unset($_SESSION['sermon']['sort_direction']);
 }

 if (isset($_POST['sort_btn'])) {
  $sort = "";
  $sort .= ' ORDER BY ';
  $sort_by = strtolower(trim($_POST['sort_by']));
  switch ($sort_by) {
   case 'date':
    $sort .= 'preached_on';
    break;
   case 'topic':
    $sort .= 'sermon_topic';
    break;
   case 'preacher':
   default:
    $sort .= 'preachers.preacher_name';
    break;
  }
  $sort_direction = (int) strtolower(trim($_POST['sort_direction']));
  if ($sort_direction === 1){
   $sort .= ' ASC';
  }else{
   $sort .= ' DESC';
  }

  $_SESSION['sermon']['sort']           = $sort;
  $_SESSION['sermon']['sort_by']        = $sort_by;
  $_SESSION['sermon']['sort_direction'] = $sort_direction;
  $pg_sort                              = 1; //reset pagination when sorting order changes
 }

 $sortq = isset($_SESSION['sermon']['sort']) ? $_SESSION['sermon']['sort'] : "";
 $sql .= $sortq; //made sort query available after page reload
 $per_page     = 3; //number of event listed per page
 $pg           = isset($_GET['pg']) ? (int) $_GET['pg'] : 1;
 $pg_s         = isset($pg_sort) ? $pg_sort : $pg;
 $current_page = $pg_s <= 0 ? 1 : $pg_s;
 $lib          = $db->prepare($sql);
 if (!isset($q)) {
  $lib->execute();
 } else {
  $lib->execute(array(':searched' => '%' . trim($q) . '%'));
 }
 $res           = $lib->fetchAll(PDO::FETCH_ASSOC);
 $total_records = count($res);
 $pagination    = new Pagination($current_page, $per_page, $total_records);
 $total_pages   = $pagination->total_pages();
 $prev          = $pagination->previous_page();
 $next          = $pagination->next_page();
 $has_prev      = $pagination->has_previous_page();
 $has_next      = $pagination->has_next_page();
 $offset        = $pagination->offset();

 $sql .= " LIMIT $per_page ";
 $sql .= " OFFSET $offset ";
 $search = $db->prepare($sql);

 if (!isset($q)) {
  $search->execute();
 } else {
  $search->execute(array(':searched' => '%' . trim($q) . '%'));
 }
 $results  = $search->fetchAll(PDO::FETCH_ASSOC);
 $sort_bi  = isset($_SESSION['sermon']['sort_by']) ? $_SESSION['sermon']['sort_by'] : "";
 $sort_dir = isset($_SESSION['sermon']['sort_direction']) ? $_SESSION['sermon']['sort_direction'] : "";

} catch (Exception $e) {
 $error = $e->error_message();
 //log to a secure location on server
}
// echo "<pre>";
// print_r($results);
// echo "</pre>";
?>
<div class="form-area">
  <div class="form-row">
  <div class="search-form col-md-12">
          <form class="form-row justify-content-center align-items-center" action="includes/crud/sermon.php" method="post">
              <div class="form-group col-md-2">
                  <h5 class="mb-0 text-sm-center text-md-right">Search:</h5>
              </div>
              
              <div class="form-group col-md-7 text-center">
                  <input type="search" id="sermon-search" name="sermon_search" class="form-control text-center" placeholder="Search by topic,keyword,preacher name, description etc.">
              </div>
              <div class="form-group col-md-2 text-sm-center text-md-left">
                  <button class="btn btn-info" name="sermon_btn"><span class="fa fa-search"></span></button>
              </div>
          </form>

      </div>

      <?php if(isset($q)): ?>
      <div class="col-md-12 text-center">
        <h5 id="sermon-result" class="alert alert-success fa fa-info-circle sermon-result">
            Found <span id="total-result"><?php echo $total_records>1? $total_records." sermons  ":$total_records." sermon " ; ?> </span>that match
            </h5>
    </div>
    <?php endif; ?>
    <?php if($total_records>1): ?>
      <div class="filterform col-md-12">
          <form class="form-row justify-content-center align-items-center" action="" method="post">
              <div class="form-group">
                  <h5 class="mb-0 text-sm-center text-md-right">Sort by:</h5>
              </div>

              <div class="form-group col-md-2">
                  <select name="sort_by" class="form-control">
                    <option value="date" <?php echo $sort_bi==="date"? "selected":"" ?>>Date preached</option>
                    <option value="preacher" <?php echo $sort_bi==="preacher"? "selected":"" ?>>Preacher</option>
                    <option value="topic" <?php echo $sort_bi==="topic"? "selected":"" ?>>Sermon topic</option>
                  </select>

              </div>
              <div class="form-group col-md-2">
                  <select name="sort_direction" id="sort" class="form-control">
                  <option value="1" <?php echo $sort_dir==1? "selected":"" ?>>Ascending</option>
                      <option value="0" <?php echo $sort_dir==0? "selected":"" ?>>Descending</option>
                  </select>

              </div>
              <div class="form-group col-md-2 text-sm-center text-md-left">
                  <button class="btn btn-info" name="sort_btn" id="sort-btn"><span class="fa fa-sort"></span></button>
              </div>
          </form>
      </div>
      <?php endif; ?>  
      <div class="offset-md-10 col-md-2 col-sm-4">
    <a href="index.php?page=sermon" class="btn btn-info text-white">All sermon</a>
  </div>   
  </div>

 </div>
 <?php if($total_records>0): ?>
     <form class="church-table d-flex justify-content-center pt-2" action="includes/crud/sermon.php" method="post">
<table
    class="table table-bordered table-striped table-hover table-responsive-sm table-responsive-md">
    <thead>
        <tr>
            <th> </th>
            <th><i class="<?php if($sort_bi=="preacher"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Preacher</i></th>
            <th><i class="<?php if($sort_bi=="topic"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Sermon Topic</i></th>
            <th><i class="<?php if($sort_bi=="date"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Date Preached </i></th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result):
        ?> 
        <tr >
            <td><input type="checkbox" value="<?php echo $result['sermon_id'] ?>"  name="sermon_id[]" id="select_sermon"></td>
            <td class="name-col">
              <?php echo $result['preacher_name'] ?>
            </td>
            <td class="venue-col" title="Keywords:<?php echo $result['sermon_keywords'] ?> ">
              <?php echo $result['sermon_topic'] ?>                
            </td>
            <td class="venue-col" title="<?php echo $result['preached_on'] ?> ">
              <?php echo $result['preached_on'] ?>                
            </td>
            <td class="desc-col" title="<?php echo $result['sermon_description']?>">
              <?php echo substr($result['sermon_description'],0,50)."..."?>
            </td>
            
            <td class="action-col">
            <div class="crud">
                <a href="index.php?page=sermon&action=v"><span class="wk wk-eye " title="View sermon full details"></span></a>
                <a href="index.php?page=sermon&action=e"><span class="wk wk-edit" title="Edit sermon"></span></a>
                <a href="index.php?page=sermon&action=d"><span class="wk wk-garbage  " title="Delete Sermon"></span></a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</form>


<?php if($total_records>$per_page): ?>
<div class="paginated d-flex justify-content-center py-4">
<ul class="pagination pagination-sm">
                  <li class="page-item">
                <?php if($has_prev): ?>
                <a href="index.php?page=sermon&pg=<?php echo $prev; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-backward"></span></a>

                <?php else: ?>
                <a class="page-link disabled"><span class="fa fa-step-backward"></span></a>
                      <?php endif // end of if for prev?>
                    </li>
                <?php for ($i=1; $i <=$total_pages; $i++): ?>
                <?php if($current_page===$i): ?>
                <li class="page-item active">
                  <a class="page-link "><?php echo $i?></a>
                </li>
                <?php else: ?>
                <li class="page-item">
                  <a href="index.php?page=sermon&pg=<?php echo $i; echo isset($q)?"&q=".$q:""?>" class="page-link "><?php echo $i?></a>
                </li>
                <?php endif; //end of if for pages ?>
                <?php endfor; ?>
                  <li class="page-item">


                  <?php 
                if($has_next):
                ?>
                      <a href="index.php?page=sermon&pg=<?php echo $next; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-forward"></span></a>

                <?php else: ?>
                <a class="page-link disabled"><span class="fa fa-step-forward"></span></a>
                <?php endif; ?>
                  </li>
              </ul>
                          </div>
                          <?php endif; ?>

<?php elseif(!isset($q)): ?>
<div class="text-center py-3">  
           <h2 class="my-2"><span>No Sermon uploaded Yet</span></h2>
            <div class="my-5">
             <a href="index.php?page=sermon&action=add-sermon"><button class="btn btn-success"><span class="wk wk-add"></span> Add new sermon </button></a>
            </div>
        </div>
            <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>