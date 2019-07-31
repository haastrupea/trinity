<?php
if(!isset($fromindex)){
  header("Location: ../../index.php?page=event");
  exit;
}
$max_file_upload=$_SESSION['image_size'];
$datef=date("Y-m-d");
$timestartf=date("H:i");
$timeendf=date("H")+1;
$endtime=date("H:i",(time() + (60 * 60)));
$manage_action="manage-event";
$add_action="add-event";
?>
<section id="event" class="event fullHeight">
      <div class="container-wrp">
          <div class="container-fluid">

              <div class="row add-n-manage-row">
                  <div class="col-md-12">
                      <div class="tab-control d-flex justify-content-around">
                          <button class="control-tab btn  col-6 <?php if(isset($action) && $action===$add_action){
        echo "active";
    }
     ?>"><a href="index.php?page=event&action=add-event">Add new event</a></button>
      <button class="control-tab btn col-6 <?php if(!isset($action) || $action!==$add_action){
        echo "active";
    }
     ?>"><a href="index.php?page=event&action=manage-event">Manage event</a></button>
     </div>
    </div>
<div class="col-md-12">
    <div id="add-event" class="add-event <?php if(!isset($action) || $action!==$add_action)echo "d-none" ?>">
        <div class="form-wrp">
        <?php if(isset($_SESSION['message'])): 
            foreach ($_SESSION['message'] as $key => $value):
            ?>
            <div id="msg-alert" class="alert fs-animated 
            <?php if(strpos(strtolower($value),"successfully")){ 
                echo 'alert-success  rubberBand';
            }else{
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
             endif; ?>
            <form action="includes/crud/event.php" method="POST" class="new-event-form container-fluid" enctype="multipart/form-data">
                <div class="form-row align-items-center">
                <div class="form-group col-md-2 text-md-right text-sm-center">
  <label for="event-topic"> Event name:</label>
                </div>
                <div class="form-group col-md-7">
  <input type="text" name="event_name" id="event-name" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
  <div class="form-group col-md-2 text-md-right text-sm-center">
         <label for="event-date"> Event date: </label>
  </div>
                <div class="form-group col-md-7">
                    <div class="form-row justify-content-between align-items-center row p-2">

                        <div class="form-group col-md-6">
                                <label for="">Start </label>
                                <input type="date" name="event_date_start" id="event-date-start" class="form-control" required min="<?php echo $datef; ?>" value="<?php echo $datef; ?>">
                        </div>
                        <div class="form-group col-md-6">
                                <label for="">End</label> </label>
                                <input type="date" name="event_date_end" id="event-date-end" class="form-control" min="<?php echo $datef; ?>" value="<?php echo $datef; ?>">
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="form-row">
  <div class="form-group col-md-2 text-md-right text-sm-center">
         <label for="event-time"> Event time: </label>
  </div>
  
        <div class="form-group col-md-7">
                <div class="form-row justify-content-between align-items-center row p-2">
                    
                    <div class="form-group col-sm-6">
                    <label for="">Start </label>
                    <input type="time" name="start_time" id="start-time" class="form-control" value="<?php echo $timestartf ?>" disabled>
                    </div>
                    <div class="form-group col-sm-6">
                    <label for="">End</label> </label>
                    <input type="time" name="end_time" id="end-time" class="form-control" value="<?php echo $endtime ?>" disabled>
                    </div>
                   <div class="form-group offset-8 col-md-4 text-right">
                   <input type="checkbox" name="all_day" id="all-day" checked value=true class="allday">
                   <label for="">All day</label>  
                   </div>
                </div>
                </div>
            </div>

                <div class="form-row mt-3 align-items-center">
  <div class="form-group col-md-2 text-md-right text-sm-center">
         <label for="publish">Repeat:</label>
  </div>
                <div class="form-group col-md-3">
      <select id="repeat-event" name="repeat_event" class="form-control">
              <option value="no_repeat" selected>No Repeat</option>
              <option value="daily">Daily</option>
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
              <option value="yearly">Yearly</option>
          </select>
                </div>
                <div class="form-group col-md-4 repeat-for">
      <select id="repeat-for" name="repeat_for" class="form-control input">
              <option value="0" selected>Forever</option>
              <option value="occurencies">No of occurencies</option>
              <option value="until">Until</option>
          </select>
                </div>
                
   </div>
                <!-- <div class="form-row"> -->
               <div class="form-group offset-md-5 col-md-4">
                   <div class="form-group occurency">
                        <input id="occurencies" name="occurencies" class="form-control input" type="number" min="2" max="100">
                     </div>
                     <div class="form-group until">
                         <input id="until" name="until" class="form-control input" type="date" min="<?php echo $datef; ?>" 
                         value="<?php echo $datef; ?>">
                        </div>
              
                   <div class="form-group every-label">
                   <label for="every">Every</label>
                     </div>
                     <div class="form-group interval">
                       <input title="hint:interval, set how often this event takes place" type="number" name="interval" id="interval" min="1" max="31" class="form-control col-md-3 col-sm-4 d-inline-block text-center" value="1">
                       <label for="interval" class="daily">Day(s)</label>
                       <label for="interval" class="weekly">Week(s)</label>
                       <label for="interval" class="monthly">Month(s)</label>
                       <label for="interval" class="yearly">Year(s)</label>
                     </div>
                   <div class="form-group weekofmonth">
                        <select id="weekofmonth" name="weekofmonth[]" class="form-control input" multiple size='4' title="Hint:you can select multiple week">
                            <option value="1">First week</option>
                            <option value="2">Second week</option>
                            <option value="3">Third week</option>
                            <option value="4">Last week</option>
                        </select>
                     </div>
                   <div class="form-group weekdays">
                        <select id="weekdays" name="weekdays[]" class="form-control input" multiple size='7' title="Hint:you can select multiple days">
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                        </select>
                     </div>
               </div>
            <!-- </div> -->

                <div class="form-row align-items-center">
  <div class="form-group col-md-2 text-md-right text-sm-center">
         <label for="event-venue"> Venue/Location: </label>
  </div>
                <div class="form-group col-md-7">
  <input type="text" name="event_venue" id="event-venue" class="form-control" required>
                </div>
            </div>
              
                <div class="form-row ">
  <div class="form-group col-md-2 text-md-right text-sm-center">
         <label for="event-description"> Event description: </label>
  </div>
                <div class="form-group col-md-7">
 <textarea name="event_description" id="event-description" rows="5" class="form-control" required></textarea>
                </div>
            </div>
               
              
            <div class="form-row align-items-center">
                    <div class="form-group col-md-2 text-sm-center text-md-right">
                            <label for="event-audio">Flyer/poster:</label>
                     </div>
                     <div class="form-group col-md-7">
                         <div class="form-row justify-content-between align-items-center row p-2">
                              <div class="form-group col-sm-9">
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_upload ?>">

                        <input type="file" name="event_flyer_file" id="event-flyer-file" class="form-control"disabled accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="form-group col-sm-3 text-right"><input type="checkbox" name="use_event_name" id="use_event_name" checked value=true class="allday" checked title="check to Use Event name as event flyer">
                                        <label for="" title="check to Use Event name as event flyer">event name</label>  
                                     </div>
                                    <div class="form-text text-center text-info">
                                        * Max file allowed is <?php echo $max_file_upload/1024 ?>kb
                                    </div>
                                  </div>
                                  </div>
                              </div>
            
                <div class="form-row align-items-end justify-content-around">
                   
                <div class="form-group col-4 py-3">
              <Button class="btn btn-success fa-pull-right" value="add_event" name="add_event_btn"><span class="wk wk-add"></span> <span>Add event</span></Button>
                </div>
            </div>
            </form>
        </div>
    </div>
                                        
                                        
                                        
<div id="manage-event" class="manage-event pt-5 <?php 
//this is the default action when no action or any invalid action is provided
if(isset($action) && $action===$add_action)echo "d-none" ?>">
  <?php
try{
  require_once('includes/dbcons.php');
  require_once 'includes/classes/Pagination.php';

   $sql='SELECT Ev_events.id,`start_date`,event_name,venue,event_description,Ev_repeat_type.repeat_type 
   FROM `Ev_events` 
   LEFT JOIN Ev_repeat_pattern ON Ev_events.id=Ev_repeat_pattern.event_id 
   LEFT JOIN Ev_repeat_type ON Ev_repeat_type.id=Ev_repeat_pattern.repeat_type';

    if(isset($_GET['q']) && !empty($_GET['q'])){
      $q=(String) $_GET['q'];
      $sql.=' WHERE event_name LIKE :searched OR venue LIKE :searched OR event_description LIKE :searched OR Ev_repeat_type.repeat_type LIKE :searched';

      if(isset($_SESSION['sort'])){
        unset($_SESSION['sort']);
      }
    }
    if(!isset($_GET['pg'])){
      unset($_SESSION['sort_by']);
      unset($_SESSION['sort_direction']);
    }

  
        if(isset($_POST['sort_btn'])){
          $sort="";
          $sort.=' ORDER BY ';
          $sort_by=strtolower(trim($_POST['sort_by']));
          $sort_direction=strtolower( trim($_POST['sort_direction']));
          switch ($sort_by) {
            case 'date':
            $sort.='start_date';
              break;
            case 'name':
            $sort.='event_name';
              break;
            case 'venue':
            $sort.='venue';
              break;
            case 'repeat':
            $sort.='Ev_repeat_type.repeat_type';
              break;
            default:
              # code...
              break;
          }
  
        if($sort_direction==='1'){
          $sort.=' ASC';   
        }else{
          $sort.=' DESC';
        }

      $_SESSION['sort']=$sort;
      $_SESSION['sort_by']=$sort_by;
      $_SESSION['sort_direction']=$sort_direction;
      $pg_sort=1;//reset pagination when sorting order changes
      }

      $sortq=isset($_SESSION['sort'])?$_SESSION['sort']:"";
      $sql.=$sortq;//made sort query available after page reload
      $per_page=10;//number of event listed per page
      $pg=isset($_GET['pg'])? (int)$_GET['pg']:1;
      $pg_s=isset($pg_sort)? $pg_sort:$pg;
      $current_page=$pg_s<=0?1:$pg_s;
      $lib=$db->prepare($sql);
      if(!isset($q)){
        $lib->execute();
      }else{
        $lib->execute(array(':searched'=>'%'.trim($q).'%'));
      }
      $res=$lib->fetchAll(PDO::FETCH_ASSOC);
      $total_records=count($res);
      $pagination= new Pagination($current_page,$per_page,$total_records);
      $total_pages=$pagination->total_pages();
      $prev=$pagination->previous_page();
      $next=$pagination->next_page();
      $has_prev=$pagination->has_previous_page();
      $has_next=$pagination->has_next_page();
      $offset=$pagination->offset();

      $sql.=" LIMIT $per_page ";
      $sql.=" OFFSET $offset ";
      $search=$db->prepare($sql);

      if(!isset($q)){
        $search->execute();
      }else{
          $search->execute(array(':searched'=>'%'.trim($q).'%'));
      }

  $results=$search->fetchAll(PDO::FETCH_ASSOC);
      $sort_bi=isset($_SESSION['sort_by'])?$_SESSION['sort_by']:"";
      $sort_dir=isset($_SESSION['sort_direction'])?$_SESSION['sort_direction']:"";
} catch(Exception $e){
    $error=$e->error_message();
   //log to a secure location on server
}  
?>
<div class="form-area">
  <div class="form-row">
  <div class="search-form col-md-12">
          <form class="form-row justify-content-center align-items-center" action="includes/crud/event.php" method="POST">
              <div class="form-group col-md-2">
                  <h5 class="mb-0 text-sm-center text-md-right">Search:</h5>
              </div>

              <div class="form-group col-md-5 text-center">
                  <input type="search" id="event-search" name="event_search" class="form-control text-center" placeholder="search Event name, venue, description or repeat" required min="2">
              </div>
              <div class="form-group col-md-2 text-sm-center text-md-left">
                  <button class="btn btn-info"><span class="fa fa-search"></span></button>
              </div>
          </form>
          
      </div>

      <?php if(isset($q)): ?>
      <div class="col-md-12 text-center">
        <h5 id="event-result" class="alert alert-success fa fa-info-circle event-result">
            Found <span id="total-result"><?php echo $total_records>1? $total_records." events ":$total_records." event " ; ?> </span> that match
          </h5>
    </div>
<?php endif; ?>

<?php if($total_records>1): ?>
  <div class="filterform col-md-12">
        <!--sort-->
          <form class="form-row justify-content-center align-items-center" action="" method="post">
              <div class="form-group">
                  <h5 class="mb-0 text-sm-center text-md-right">Sort by:</h5>
              </div>

              <div class="form-group col-md-2">
                  <select name="sort_by" class="form-control">
                    <option value="date" <?php echo $sort_bi==="date"? "selected":"" ?>>Start Date</option>
                    <option value="name" <?php echo $sort_bi==="name"? "selected":"" ?>>Event name</option>
                    <option value="venue" <?php echo $sort_bi==="venue"? "selected":"" ?>>Event venue</option>
                    <option value="repeat" <?php echo $sort_bi==="repeat"? "selected":"" ?>>Event Repeat</option>
                  </select>
                  
              </div>
              <div class="form-group col-md-2">
                  <select name="sort_direction" id="sort" class="form-control">
                      <option value="1" <?php echo $sort_dir=="1"? "selected":"" ?>>Ascending</option>
                      <option value="0" <?php echo $sort_dir=="0"? "selected":"" ?>>Descending</option>
                  </select>
                  
              </div>
              <div class="form-group col-md-2 text-sm-center text-md-left">
                  <button class="btn btn-info" name="sort_btn" id="sort-btn"><span class="fa fa-sort"></span></button>
              </div>
          </form>
      </div>
  <?php endif; ?>   
  <div class="offset-md-10 col-md-2 col-sm-4">
    <a href="index.php?page=event" class="btn btn-info text-white">All event</a>
  </div>   
  </div>

  </div>


  <?php if($total_records>0): ?>
  <div class="church-table d-flex justify-content-center pt-2">
<table class="table table-bordered table-striped table-hover table-responsive-sm table-responsive-md">
    <thead>
        <tr>
          <th> </th>
            <th class="name-col" > 
            <i class="<?php if($sort_bi=="name"){
              echo ($sort_direction==="1")?"fas fa-sort-amount-up":"fas fa-sort-amount-down";
              echo " fa-1x text-white";
            }
            ?>"> Name</i> 
            </th>
            <th class="venue-col">
            <i class="<?php if($sort_bi=="venue"){echo ($sort_dir==="1")?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Venue</i>  
            </th>
            <th class="desc-col"> Description</th>
            <th class="repeat-col">
            <i class="<?php if($sort_bi=="repeat"){echo ($sort_dir==="1")?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> Repeat</i>
            </th>
            <th class="date-col"> 
              <i class="<?php if($sort_bi=="date"){echo ($sort_dir==="1")?"fas fa-sort-amount-up":"fas fa-sort-amount-down"; echo " fa-1x text-white";} ?>"> start date</i></th>
            <th class="action-col"> Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result):
        ?>      
        <tr id="<?php echo $result['id'] ?>">
        <td><input type="checkbox" value="<?php echo $result['id'] ?>"  name="event_id[]" id="select_events"></td>
            <td class="name-col">
              <?php echo $result['event_name'] ?>
            </td>
            <td class="venue-col" title="<?php echo $result['venue'] ?> ">
              <?php echo substr($result['venue'],0,20)."..." ?>                
            </td>
            <td class="desc-col" title="<?php echo $result['event_description']?>">
              <?php echo substr($result['event_description'],0,50)."..."?>
            </td>
            <td class="repeat-col" ><?php echo $result['repeat_type']!==null? $result['repeat_type']:"-" ?></td>
            <td class="date-col"><?php echo $result['start_date'] ?></td>
            
            <td class="action-col">
                <div class="crud">
                <span class="wk wk-eye " title="View event full details"></span>
                <span class="wk wk-edit" title="Edit event"></span>
                <span class="wk wk-garbage  " title="Delete event"></span>
        </div>
            </td>
        </tr>
        <?php endforeach; ?>
           </tbody>
          </table>
        </div>
<?php if($total_records>$per_page): ?>
          <div class="paginated d-flex justify-content-center py-4">
              <ul class="pagination pagination-sm">
                  <li class="page-item">
                <?php if($has_prev): ?>
                <a href="index.php?page=event&pg=<?php echo $prev; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-backward"></span></a>

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
                  <a href="index.php?page=event&pg=<?php echo $i; echo isset($q)?"&q=".$q:""?>" class="page-link "><?php echo $i?></a>
                </li>
                <?php endif; //end of if for pages ?>
                <?php endfor; ?>
                  <li class="page-item">


                  <?php 
                if($has_next):
                ?>
                      <a href="index.php?page=event&pg=<?php echo $next; echo isset($q)?"&q=".$q:"" ?>" class="page-link"><span class="fa fa-step-forward"></span></a>

                <?php else: ?>
                <a class="page-link disabled"><span class="fa fa-step-forward"></span></a>
                <?php endif; ?>
                  </li>
              </ul>
          </div>
                <?php endif; ?>
        <?php elseif(!isset($q)): ?>
         <div class="text-center py-3">
           
       <h2 class="my-2"><span>No Event Created Yet</span></h2>

       <div class="my-5">
         <a href="index.php?page=event&action=add-event"><button class="btn btn-success"><span class="wk wk-add"></span> Add new event </button></a>
        </div>
    </div>
        <?php endif; ?>
      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>