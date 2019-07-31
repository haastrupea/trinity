<?php
if(!isset($fromindex)){
  header("Location: ../../index.php?page=bulletin");
  exit;
}
$datef         = date("Y-m-d");
$timestartf    = date("H:i");
$timeendf      = date("H") + 1;
$enddate       = mktime(date("H") + 1);
$date          = getdate($enddate);
$endtime       = date("H:i", (time() + (60 * 60)));
$manage_action = "manage-bulletin";
$add_action    = "add-bulletin";
// $max_file_upload=$_SESSION['upload_size'];

try {
    require_once 'includes/dbcons.php';
    require_once 'includes/classes/Pagination.php';
} catch (Exception $e) {
    // $e->getMessage();
    $error = true;
}
?>
<section id="bulletin" class="bulletin fullHeight">
    <div class="container-wrp">
        <div class="container-fluid">
            <div class="row add-n-manage-row">
                <div class="col-md-12">
                    <div class="tab-control d-flex justify-content-around">
                        <button class="control-tab btn  col-6 <?php if (isset($action) && $action === $add_action) {
    echo "active";
}
?>">
                            <a class="d-block" href="index.php?page=bulletin&action=add-bulletin">Update bulletin</a></button>

                        <button class="control-tab btn col-6 <?php if (!isset($action) || $action !== $add_action) {
    echo "active";
}
?>"><a class="d-block" href="index.php?page=bulletin&action=manage-bulletin">Manage bulletin</a></button>
                    </div>
                </div>
                <noscript class="form-group col-sm-12 text-center btn btn-warning mt-2 ">
                    <i class="fa fa-info-circle fa-1x mr-md-2">
                        Enable Javacript in Your browser </i>

                </noscript>

                <?php if (isset($_SESSION['message'])):
                foreach ($_SESSION['message'] as $key => $value):
                ?>
                                            <div id="msg-alert" class="mt-2 alert fs-animated <?php if (strpos(strtolower($value), "successfully")) {
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
            endif;
            ?>
            <div class="col-md-12">
                    <div id="add-bulletin"
                        class="add-bulletin <?php if (!isset($action) || $action !== $add_action) {
    echo "d-none";
}
?>">

                        <div class="form-wrp">

<?php
$sql       = "SELECT title_id as id,title,publish,`description`,publish_status FROM `bulletin_title`";
$result    = $db->query($sql);
$bulletins = $result->fetchAll(PDO::FETCH_ASSOC);

if(!empty($bulletins)){
    $buid = isset($_SESSION['buid']) ? $_SESSION['buid'] : $bulletins[0]['id'];
  
    $active_bulletin=$bulletins[0];

    foreach ($bulletins as $bulletin) {
        if($bulletin['id']==$buid){
    $active_bulletin=$bulletin;
        }
    }
    $_SESSION['buid']=$buid;//init buid session here because of first time load
}






if (empty($bulletins) || isset($_GET['newbulletin'])):

    if (empty($bulletins)):
    ?>
	                            <div class="btn btn-info d-flex mb-2 align-items-center justify-content-center">
	                                <span class="fa fa-info-circle "></span><span> Please Add your first bulletin to
	                                    publish into</span>
	                            </div>
	                            <?php endif;?>
                            <form action="includes/crud/bulletin.php" method="post" class="container-fluid">
                                <div class="form-row align-items-center justify-content-center">
                                    <div class="form-group col-md-2 text-md-right text-sm-center">
                                        <label for="bulletin-title"> Bulletin Title: </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input type="text" name="bulletin_title" id="bulletin-title"
                                            class="form-control" required>
                                    </div>

                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-5 offset-md-2">
                                        <div class="form-row justify-content-between align-items-center row p-2">
                                            <div class="form-group col-sm-6">
                                                <label for="">Publishing frequency:</label>
                                                <input type="number" min="1" name="pub_freq" id="pub_freq"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="">Publishing</label> </label>
                                                <select name="publish" id="publish" class="form-control" required>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly" selected>Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-2 text-md-right text-sm-center">
                                        <label for="bulletin-description"> Bulletin description: </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <textarea name="bulletin_description" id="bulletin-description" rows="5"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group offset-md-5 col-md-2 text-md-right"><button
                                            name="bulletin_setup" value="setup" class="btn btn-success wk wk-add"> Add
                                            bulletin</button></div>
                                </div>
                            </form>
                            <?php else:
?>
                            <form action="includes/crud/bulletin.php" method="POST" enctype="multipart/form-data"
                                class="new-bulletin-form container-fluid">
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-2 text-center">
                                        <label for="bulletin-title"> Bulletin:</label>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <select name="bulletin_title" id="bulletin-title" class="form-control" required>
                                            <option value="">Select Bulletin</option>
                                            <?php foreach ($bulletins as $bulletin): ?>
                                            <option value="<?php echo $bulletin['id'] ?>"
                                                <?php if ($buid == $bulletin['id']) {echo "selected";}?>>
                                                <?php echo $bulletin['title'] . "--" . $bulletin['publish'] ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group offset-md-7 col-md-2">
                                        <a href="index.php?page=bulletin&action=add-bulletin&newbulletin"
                                            class="btn btn-info">
                                            Add new bulletin
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-sm-2"></div>
                                    <div class="form-row justify-content-between align-items-center row p-2 col-sm-7">

                                        <div class="form-group col-sm-6">
                                            <label for="">Volume:</label>
                                            <input type="number" min="1" name="volume" id="volume" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="">Issue:</label>
                                            <input type="number" min="1" name="issue" id="issue" class="form-control">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-row">
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
                                        <input class="form-control input" type="date" name="until" id="until"
                                            min="<?php echo $datef; ?>">
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-2 text-center">
                                        <label for="keyword"> Keyword: </label>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <input type="text" name="keyword" id="keyword" class="form-control"
                                            placeholder="e.g Holiness,marriage,Doctrine, healing, Easter etc.">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2 text-center">
                                        <label for="keyword"> Bulletin file: </label>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 52488000 ?>">
                                        <input type="file" name="bulletin_file" id="bulletin-file" class="form-control"
                                            accept=".pdf,.docx,.doc">
                                        <div class="form-text text-info">
                                            * Max file allowed is <?php echo ceil((52488000 / 1024) / 1024) ?>Mb
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-end justify-content-around">

                                    <div class="form-group col-6">
                                        <Button class="btn btn-success fa-pull-right" name="add_to_bulletin"
                                            value="bulletin"><span class="wk wk-add"></span>
                                            <span>Update bulletin</span></Button>
                                    </div>
                                </div>
                            </form>
                            <?php endif;?>


                        </div>
                    </div>


                    <div id="manage-bulletin" class="manage-bulletin pt-1 pt-md-5 <?php
//this is the default action when no action or any invalid action is provided
if (isset($action) && $action === $add_action) {
    echo "d-none";
}
?>">
                        <div class="form-area">
                            <div class="form-row">
                                <?php if (empty($bulletins)):?>
                                <div class="col-md-12 mb-2">
                                    <div class="d-flex align-items-center justify-content-center alert alert-info">
                                        <h5 class="fa fa-info-circle "></h5>
                                        <h5> Please publish your first bulletin</h5>
                                    </div>
                                    <div class="text-center my-3">

                                        <a href="index.php?page=bulletin&action=add-bulletin" class="btn btn-info">Add
                                            Bulletin</a>
                                    </div>
                                    <h3 class="text-center">
                                        Nothing to manage yet
                                    </h3>
                                </div>

                                <?php else: ?>
                                <?php
$dbfail  = true;
$sql_pub = "SELECT * FROM `bulletin` WHERE bulletin_title_id=?";

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = (String) $_GET['q'];
    $sql_pub .= ' AND keyword LIKE ?';

    if (isset($_SESSION['bulletin']['sort'])) {
        unset($_SESSION['bulletin']['sort']);
    }
}

if (!isset($_GET['pg'])) {
    unset($_SESSION['bulletin']['sort_by']);
    unset($_SESSION['bulletin']['sort_direction']);
}

if (isset($_POST['sort_btn'])) {
    $sort = "";
    $sort .= ' ORDER BY ';
    $sort_by = strtolower(trim($_POST['sort_by']));
    switch ($sort_by) {
        case 'date':
            $sort .= 'added_on';
            break;
        case 'vol':
            $sort .= 'volume';
            break;
        case 'download':
        default:
            $sort .= 'dl_counter';
            break;
    }
    $sort_direction = (int) trim($_POST['sort_direction']);
    if ($sort_direction === 1) {
        $sort .= ' ASC';
    } else {
        $sort .= ' DESC';
    }

    $_SESSION['bulletin']['sort']           = $sort;
    $_SESSION['bulletin']['sort_by']        = $sort_by;
    $_SESSION['bulletin']['sort_direction'] = $sort_direction;
    $pg_sort                                = 1; //reset pagination when sorting order changes
}

$sortq = isset($_SESSION['bulletin']['sort']) ? $_SESSION['bulletin']['sort'] : "";
$sql_pub .= $sortq; //made sort query available after page reload
$per_page     = 5; //number of event listed per page
$pg           = isset($_GET['pg']) ? (int) $_GET['pg'] : 1;
$pg_s         = isset($pg_sort) ? $pg_sort : $pg;
$current_page = $pg_s <= 0 ? 1 : $pg_s;

$lib = $db->prepare($sql_pub);
if (!isset($q)) {
    $lib->execute([$buid]);
} else {
    $lib->execute(array($buid, '%' . trim($q) . '%'));
}
$res_lib       = $lib->fetchAll(PDO::FETCH_ASSOC);
$total_records = count($res_lib);
$pagination    = new Pagination($current_page, $per_page, $total_records);
$total_pages   = $pagination->total_pages();
$prev          = $pagination->previous_page();
$next          = $pagination->next_page();
$has_prev      = $pagination->has_previous_page();
$has_next      = $pagination->has_next_page();
$offset        = $pagination->offset();

$sql_pub .= " LIMIT $per_page ";
$sql_pub .= " OFFSET $offset ";

$qry_pub = $db->prepare($sql_pub);
if (isset($q)) {
    if ($qry_pub->execute([$buid, '%' . trim($q) . '%'])) {
        $dbfail = false;
    }
} else {
    if ($qry_pub->execute([$buid])) {
        $dbfail = false;
    }
}

$sql_vol_count="SELECT MAX(volume) as vol from bulletin WHERE bulletin_title_id=?";
$qry_vol_count=$db->prepare($sql_vol_count);
if($qry_vol_count->execute([$buid])){
    $vol_count=$qry_vol_count->fetch(PDO::FETCH_ASSOC)['vol'];
}
if (!$dbfail) {
    $res = $qry_pub->fetchAll(PDO::FETCH_ASSOC);
}
$sort_bi  = isset($_SESSION['bulletin']['sort_by']) ? $_SESSION['bulletin']['sort_by'] : "";
$sort_dir = isset($_SESSION['bulletin']['sort_direction']) ? $_SESSION['bulletin']['sort_direction'] : "";

?>
                                
<div class="bulletin-list-form col-md-12 border-bottom border-warning mb-2 pb-2">
                                       <?php if($active_bulletin['publish_status']==="published"): ?>
                                            <form action="includes/crud/bulletin.php" method="post" class="form-row justify-content-end justify-content-md-start align-items-center col-md-4 ">
                                                <input type="hidden" name="publish_bulletin" value='unpublish'>
                                                <button class="btn btn-danger btn-sm" name="pub_bulletin-btn">Unpublish?</button>
                                                </form>
                                        <?php endif;//if($active_bulletin['publish_status']==="published"): ?>
                                    
                                    <form class="form-row justify-content-center align-items-center"
                                        action="includes/crud/bulletin.php" method="post">
                                        <div class="form-group col-md-2">
                                            <h5 class="mb-0 text-sm-center text-md-right">Bulletin:</h5>
                                        </div>

                                        <div class="form-group col-md-4 text-center">
                                            <select name="bulletin_list" id="bulletin-list" class="form-control"
                                                required>
                                                <option value="">Select Bulletin</option>
                                                <?php foreach ($bulletins as $bulletin): ?>
                                                 <option value="<?php echo $bulletin['id'] ?>"
                                                    <?php if ($buid == $bulletin['id']) {echo "selected";}?>>
                                                    <?php echo $bulletin['title'] . "--" . $bulletin['publish'] ?></option>
                                                <?php endforeach;//foreach ($bulletins as $bulletin) ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 text-sm-center text-md-left">
                                            <button class="btn btn-info" name="manage_bulletin">Manage</button>
                                        </div>

                                    </form>
                                    <div class="form-row">
                                        <?php if($active_bulletin['publish_status']==="published"): ?>
                                            <div class="card col-4 col-md-2">
                                                <div class="card-header">
                                                    <div class="card-header-pills">

                                                        Publish
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                        <div class="card-text">

                                                            <?php echo $active_bulletin['publish'];   ?>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="card col-4 col-md-2">
                                                <div class="card-header">
                                                        <div class="card-header-pills">

                                                                Volumes
                                                            </div>
                                                    
                                                </div>
                                                <div class="card-body">
                                                        <div class="card-text">
                                                            <?php echo is_null($vol_count)? 0:$vol_count; ?>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="card col-4 col-md-2">
                                                <div class="card-header">
                                                        <div class="card-header-pills">
                                                                Issues
                                                            </div>
                                                </div>
                                                <div class="card-body">
                                                        <div class="card-text">

                                                           <?php
                                                           echo $total_records;
                                                           ?>
                                                        </div>

                                                </div>
                                            </div>
                                            <div class="card col-12 col-md-6">
                                                <div class="card-header">
                                                    <div class="card-header-pills">
                                                            Description
                                                        </div>
                                              </div>
                                              <div class="card-body">
                                            <div id="bulletin-desc" class="card-text">

                                                <?php echo
                                                $active_bulletin['description'];   ?>
                                            </div>
                                            </div>
                                            </div>

                                            <?php else: ?>
                                            <div class="alert alert-warning col-12 text-center">
                                               <h5>
                                                   This bulletin has not been published yet
                                               </h5>
                                               <?php if(is_null($vol_count)): ?>
                                                <h6 class="text-danger">
                                                    Nothing has been published to <?php echo $active_bulletin['title']  ?> yet
                                                </h6>
                                                <div class="d-md-flex align-items-center justify-content-center">

                                               
                                                <form action="includes/crud/bulletin.php" method="post">
                                                    <input type="hidden" name="publish_bulletin" value='yes'>
                                                    <button class="btn btn-danger" name="pub_bulletin-btn">Publish anyway?</button>
                                                    </form>
                                                    <h4 class="px-2">
                                                    or
                                                    </h4>
                                                    <a href="index.php?page=bulletin&action=add-bulletin"
                                            class="btn btn-success">Update <?php echo $active_bulletin['title']; ?></a>
                                            </div>
                                               <?php else: ?>
                                               <form action="includes/crud/bulletin.php" method="post">
                                            <input type="hidden" name="publish_bulletin" value='yes'>
                                            <button class="btn btn-success" name="pub_bulletin-btn">Publish now?</button>
                                            </form>
                                            <?php endif; //if(is_null($vol_count))?>
                                            </div>
                                            <?php endif;//if($resut['publish_status']==="published"): ?>
                                      
                                    </div>
                                    
                                </div>

                                <?php if (isset($res) && (!empty($res) || isset($q))): ?>
                                <div class="search-form col-md-12">
                                    <form class="form-row justify-content-end align-items-center"
                                        action="includes/crud/bulletin.php" method="post">

                                        <div class="form-group Search-io col-md-3 text-center">
                                            <input type="search" id="bulletin-search" name="bulletin_search"
                                                class="form-control text-center" placeholder="Search by keyword">
                                        </div>
                                        <div
                                            class="form-group search-btn <?php echo isset($q) ? "col-md-2" : "col-md-1" ?> text-sm-center text-md-left">
                                            <button class="btn btn-info" name="add-bulletin"><span
                                                    class="fa fa-search"></span></button>
                                            <?php if (isset($q)): ?>
                                            <a class="btn btn-info float-right" name="add-bulletin"
                                                href="index.php?page=bulletin&action=manage-bulletin">View all </a>
                                            <?php endif;//if (isset($q)):?>

                                        </div>
                                    </form>

                                </div>


                                <?php if (isset($q)): ?>
                                <div class="col-md-12 text-center">

                                    <h5 id="bulletin-result"
                                        class="alert alert-success fa fa-info-circle bulletin-result">
                                        Found <span id="total-result"><?php echo $total_records; ?> </span> that match for  <?php echo $q; ?></h5>
                                </div>
                                <?php endif;//if (isset($q))
                                if ($total_records > 1): ?>
                                <div class="filterform col-md-12">
                                    <form class="form-row justify-content-center align-items-center" action=""
                                        method="post">
                                        <div class="form-group">
                                            <h5 class="mb-0 text-sm-center text-md-right">Sort by:</h5>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <select name="sort_by" class="form-control">
                                                <option value="date" <?php echo $sort_bi==="date"? "selected":"" ?>>Date</option>
                                                <option value="vol" <?php echo $sort_bi==="vol"? "selected":"" ?>>Volume</option>
                                                <option value="download" <?php echo $sort_bi==="download"? "selected":"" ?>>Download</option>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <select name="sort_direction" id="sort-direction" class="form-control">
                                                <option value="1" <?php echo $sort_dir==1? "selected":"" ?> >Ascending</option>
                                                <option value="0" <?php echo $sort_dir==0? "selected":"" ?>>Descending</option>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2 text-sm-center text-md-left">
                                            <button class="btn btn-info" name="sort_btn" id="sort-btn"><span
                                                    class="fa fa-sort"></span></button>
                                        </div>
                                    </form>
                                </div>

                                <?php endif;//if ($total_records > 1):
                                    else: ?>
                                <div class="col-md-12 mb-2">
                                    <div class="d-flex align-items-center justify-content-center alert alert-info">
                                        <h5 class="fa fa-database  pr-1"></h5>
                                        <h5> No content has been published to <?php echo $active_bulletin['title']; ?></h5>
                                    </div>
                                    <div class="text-center my-3">

                                        <a href="index.php?page=bulletin&action=add-bulletin"
                                            class="btn btn-info">Update <?php echo $active_bulletin['title']; ?></a>
                                    </div>
                                    <h3 class="text-center">
                                        Nothing to manage here yet
                                    </h3>


                                </div>

                                <?php endif;//if (isset($res) && (!empty($res) || isset($q))):?>
                                <?php endif; //if (empty($bulletins)): ?>
                            </div>

                        </div>
                        <?php if (isset($res) && !empty($res)): ?>
                        <div class="church-table d-flex justify-content-center pt-2">
                            <table
                                class="table table-bordered table-striped table-hover table-responsive-sm table-responsive-md">
                                <thead>
                                    <tr>
                                            <th> </th>
                                        <th> <i class="<?php if($sort_bi=="vol"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Title</i></th>
                                        <th><i class="<?php if($sort_bi=="date"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Date added</i></th>
                                        <th>Keywords</th>
                                        <th><i class="<?php if($sort_bi=="download"){echo ($sort_dir===1)?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Downloads</i></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($res as $b_res): ?>
                                    <?php
                                    //merge volume and issue as the title
                                    $issue   = $b_res['Issue'];
                                    $vol     = $b_res['volume'];
                                    $b_title = "Volume " . $vol . " issue " . $issue;
?>
                                    <tr title="<?php echo $b_title; ?>">
                                    <td><input type="checkbox" value="<?php echo $b_res['bulletin_id'] ?>"  name="bulletin_id[]" id="select_bulletin"></td>
                                        <td>
                                                <?php echo $b_title; ?>
                                        </td>

                                        <td><?php echo date("dS \of F, Y [h:mA]", strtotime($b_res['added_on'])) ?></td>
                                        <td><?php echo $b_res['keyword']; ?></td>
                                        <td><?php echo $b_res['dl_counter']; ?></td>
                                        <td class="crud">
                                            <span class="wk wk-eye " title="View bulletin full details"></span>
                                            <span class="wk wk-edit" title="Edit bulletin"></span>
                                            <span class="wk wk-garbage  " title="Delete bulletin"></span>
                                        </td>
                                    </tr>

                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($total_records>$per_page): ?>
                        <div class="paginated d-flex justify-content-center py-4">
                        <ul class="pagination pagination-sm">
                                          <li class="page-item">
                                        <?php if($has_prev): ?>
                                        <a href="index.php?page=bulletin&pg=<?php echo $prev; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-backward"></span></a>
                        
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
                                          <a href="index.php?page=bulletin&pg=<?php echo $i; echo isset($q)?"&q=".$q:""?>" class="page-link "><?php echo $i?></a>
                                        </li>
                                        <?php endif; //end of if for pages ?>
                                        <?php endfor; ?>
                                          <li class="page-item">
                        
                        
                                          <?php 
                                        if($has_next):
                                        ?>
                                              <a href="index.php?page=bulletin&pg=<?php echo $next; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-forward"></span></a>
                        
                                        <?php else: ?>
                                        <a class="page-link disabled"><span class="fa fa-step-forward"></span></a>
                                        <?php endif; ?>
                                          </li>
                                      </ul>
                                                  </div>
                                                  <?php endif; ?>

                        <?php endif; //if bulletin is not empty?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    let doc = document.getElementById("bulletin-title");
    let volume = document.getElementById('volume');
    let issue = document.getElementById('issue');

    let ajaxreq = () => {
        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.status == 200 && req.readyState === 4 && req.responseText !== "") {
                let resp = JSON.parse(req.responseText);
                volume.value = Number(resp.volume) === 0 ? 1 : resp.volume;
                issue.value = Number(resp.issue) + 1;
            }
        }
        req.open("POST", "./includes/crud/bulletin.php");
        req.setRequestHeader('X-Requested-With', 'ajax_req');
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send("req=" + doc.value);
    }
    if (issue !== null && volume !== null) {
        doc.onchange = () => {
            ajaxreq();
        }
        window.addEventListener("load",() => {
            ajaxreq();
        },false);
}

</script>