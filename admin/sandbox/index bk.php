<?php 
$datef=date("Y-m-d");
$timestartf=date("H:i");
$timeendf=date("H")+1;
$enddate=mktime(date("H")+1);
$date=getdate($enddate);
$endtime=$date["hours"].":".$date["minutes"];


$action_data=$_GET;

echo "<pre>";
echo print_r($action_data);
echo "</pre>"
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>welcome-admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="vendor/fontawesome-free-5.3.1-web/css/all.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/font/admin-icon.css">

        <link rel="stylesheet" type="text/css" media="screen" href="css/admin-index.css">
    </head>

    <body>
        <section>
            <div id="side-collapse" class="admin-wrp d-flex vh side-collapsed">
                <aside class="side-bar fullHeight">
                    <div class="icon-menu bg-dark">
                        <div class="actions-wrp row no-spacing">
                            <ul class="action-list col-12">
                                <li class="list-title">
                                    <p class="title d-flex">
                                        <span>Action&nbsp;panel</span>
                                        <span>MENU</span>
                                    </p>
                                </li>
                                <li class="action active">
                                    <a href="index.html" title="Admin Home">
                                        <span class="wk wk-user-avatar-with-check-mark"></span></a></li>
                                <li class="action">
                                    <a title="Event" href="Event.html">
                                        <span class="wk wk-eye"></span></a></li>
                                <li class="action"><a title="Sermon" href="Sermon.html"><span
                                            class="fa fa-tachometer-alt"></span></a></li>
                                <li class="action"><a title="Bulletin" href="Bulletin.html"><span
                                            class="fa fa-tachometer-alt"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-closed">
                        <ul class="action-content-list">
                            <li class="action-brand">
                                <div class="branded d-flex align-items-center justify-content-start">
                                    <span class="logo"></span>
                                    <span class="brand-text">God's <br><span>Church</span></span>
                                    <div class="menu-collapse">
                                        <span class="fa"></span>
                                    </div>
                                </div>
                            </li>
                            <li class="action-content">
                                <a href="index.html">
                                    <div class="action-manage d-flex  justify-content-start align-items-center active">
                                        <span class="icon fa fa-tachometer-alt"></span>
                                        <span>Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="Event.html">
                                    <div class="action-manage d-flex  justify-content-start align-items-center">
                                        <span class="icon fa fa-tachometer-alt"></span>
                                        <span>Event</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="Sermon.html">
                                    <div class="action-manage d-flex  justify-content-start align-items-center">
                                        <span class="icon fa fa-tachometer-alt"></span>
                                        <span>Sermon</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="Bulletin.html">
                                    <div class="action-manage d-flex  justify-content-start align-items-center">
                                        <span class="icon fa fa-tachometer-alt"></span>
                                        <span>Bulletin</span>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="developer">Developed By <a href="#">Wikytek</a>
                        </div>
                    </div>

                </aside>
                <article class="admin-canvas fullHeight">
                    <section id="index" class="index fullHeight">
                        index
                    </section>
                    <section id="event" class="event fullHeight active">
                        <div class="event-wrp">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        statistic row
                                    </div>
                                    <div class="col-sm-6 col-md-2">total events</div>
                                    <div class="col-sm-6 col-md-2">total event this week</div>
                                    <div class="col-sm-6 col-md-2">

                                        total event this month
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        total event this year
                                    </div>
                                    <div class="col-sm-6 col-md-2">current time</div>
                                    <div class="col-sm-6 col-md-2">count down to next event</div>
                                </div>


                                <div class="row add-n-manage-event-row">
                                    <div class="col-md-12">
                                        <div class="tab-control d-flex justify-content-around">
                                            <button class="control-tab btn  col-6 active">Add new Event</button>
                                            <button class="control-tab btn col-6  ">
                                                Manage event
                                            </button>
                                        </div>
                                    </div>
<div class="col-md-12">
    <div id="add-event" class="add-event ">
        <div class="new-event-form-wrp">
            <form action="#" method="POST" class="new-event-form container-fluid">
                <div class="form-row align-items-center">
                <div class="form-group col-md-2 text-center">
                    <label for="event-name"> Event Name:</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" name="event-name" id="event-name" class="form-control">
                </div>
            </div>

                <div class="form-row">
                    <div class="form-group col-md-2 text-center">
         <label for="Event-date"> Event Date: </label>
                    </div>
                <div class="col-md-7">
                   <div class="row justify-content-between">
                       <div class="form-group col-md-6">
                            <span> Start</span>
                        <input type="date" class="form-control" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" required value="<?php echo $datef;?>">
                                
                       
                       </div>
                       <div class="form-group col-md-6">
                            <span>End</span>
                            <input type="date"  class="form-control" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" required value="<?php echo $datef;?>">
                       </div>
                     
                   </div>
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-2 text-center">
         <label for="Event-time"> Event Time: </label>
                    </div>
                    
                <div class="col-md-7">
                   <div class="row justify-content-around">
                       <div class="form-group">
                            <span> Start</span>
                        <input type="time" class="form-control" required name="start-time"
                        value="<?php echo $timestartf;?>">
                                
                       
                       </div>
                       <div class="form-group">
                            <span>End</span>
                            <input type="time" class="form-control" required name="end-time"
                            value="<?php echo $endtime ?>"
                            >
                            
                       </div>
                       <div class="form-group">
                        <label>All day</label>
                        <input type="checkbox" class="form-control"  name="end-time"
                        >
                </div>
                   </div>
                   
                </div>
              
                
            </div>


                <div class="form-row">
                    <div class="form-group col-2 text-center">
         <label for="Event-name">Repeat:</label>
                    </div>
                <div class="form-group col-md-2">
                        <select name="filter-event" class="form-control">
                                <option value="0" selected>No-repeat</option>
                                <option value="1">Daily</option>
                                <option value="2">Weekly</option>
                                <option value="3">Monthly</option>
                                <option value="4">Yearly</option>
                            </select>
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-2 text-center">
         <label for="Event-name"> Event venue: </label>
                    </div>
                <div class="form-group col-md-7">
                    <input type="text" name="venue" id="venue" class="form-control">
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-2 text-center">
         <label for="Event-name"> Description: </label>
                    </div>
                <div class="form-group col-md-7">
                   <textarea name="event-desc" id="event-desc" rows="5" class="form-control"></textarea>
                </div>
            </div>
               
                <div class="form-row">
                    <div class="form-group col-md-2 text-center">
         <label for="Event-name"> Event Flyer:</label>
                    </div>
                <div class="form-group col-md-5">
                   <input type="file" name="event-flyer" id="event-flyer" class="form-control">
                </div>
                <div class="form-group align-self-center">
                        <label>Use Event Name</label>
                        <input type="checkbox" name="event-name-as-flyer" id="event-name-as-flyer" class="form-control">
                </div>
            </div>
                <div class="form-row align-items-end justify-content-around">
                   
                <div class="form-group col-9">
              <Button class="btn btn-success fa-pull-right"><span class="wk wk-add"></span> <span>Add Event</span></Button>
                </div>
            </div>
            </form>
        </div>
    </div>
                                        
                                        
                                        
                                        <div id="manage-event" class="manage-event pt-5 d-none">
                                            <div class="form-area">
                                                <div class="d-flex">
                                                    <div class="filterform col-md-6">
                                                        <form class="form-row justify-content-center align-items-center"
                                                            action="#" method="post">
                                                            <div class="form-group col-4">
                                                                <h5 class="mb-0 text-right">Filter:</h5>
                                                            </div>

                                                            <div class="form-group col-3">
                                                                <select name="filter-event" class="form-control">
                                                                    <option value="all" selected>All</option>
                                                                    <option value="0">Once</option>
                                                                    <option value="1">Daily</option>
                                                                    <option value="2">Weekly</option>
                                                                    <option value="3">Monthly</option>
                                                                    <option value="4">Yearly</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <button class="btn btn-info" name="submit-btn"><span
                                                                        class="fa fa-filter"></span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="search-form col-md-6">
                                                        <form class="form-row justify-content-center align-items-center"
                                                            action="#" method="post">
                                                            <div class="form-group col-4">
                                                                <h5 class="mb-0 text-right">Search:</h5>
                                                            </div>

                                                            <div class="form-group col-6 text-center">
                                                                <input type="search" class="form-control text-center"
                                                                    placeholder="Search by title,description">
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <button class="btn btn-info" name="submit-btn"><span
                                                                        class="fa fa-search"></span></button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
    <div class="col-md-12 text-center">
        <h5 id="event-result" class="alert alert-success fa fa-info-circle">
            Found <span id="total-result">25 </span>events that match</h5>
    </div>

                                            </div>
                                            <div class="event-table d-flex justify-content-center pt-2">
<table
    class="table table-bordered table-striped table-hover table-responsive-sm table-responsive-md">
    <thead>
        <tr>
            <th>Event name</th>
            <th>Description</th>
            <th>Repeat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                Easter
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Yearly</td>
            <td class="event-crud ">
                <span class="wk wk-eye " title="View Event"></span>
                <span class="wk wk-edit " title="Edit Event"></span>
                <span class="wk wk-garbage " title="Delete Event"></span>
            </td>
        </tr>
        <tr>
            <td>
                lent
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Yearly</td>
            <td class="event-crud ">
                <span class="wk wk-eye " title="View Event"></span>
                <span class="wk wk-edit " title="Edit Event"></span>
                <span class="wk wk-garbage " title="Delete Event"></span>
            </td>
        </tr>
        <tr>
            <td>
                Digging deep
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Weekly</td>
            <td class="event-crud ">
                <span class="wk wk-eye " title="View Event"></span>
                <span class="wk wk-edit " title="Edit Event"></span>
                <span class="wk wk-garbage " title="Delete Event"></span>
            </td>
        </tr>
        <tr>
            <td>
                Faith Clinic
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Weekly</td>
            <td class="event-crud ">
                <span class="wk wk-eye " title="View Event"></span>
                <span class="wk wk-edit " title="Edit Event"></span>
                <span class="wk wk-garbage " title="Delete Event"></span>
            </td>
        </tr>
        <tr>
            <td>
                Operation Push
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Monthly</td>
            <td class="event-crud">
                <span class="wk wk-eye " title="View Event"></span>
                <span class="wk wk-edit " title="Edit Event"></span>
                <span class="wk wk-garbage " title="Delete Event"></span>
            </td>
        </tr>
        <tr>
            <td>
                Bible Study
            </td>
            <td>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </td>
            <td>Weekly</td>
            <td class="event-crud ">
                <span class="wk wk-eye" title="View Event"></span>
                <span class="wk wk-edit" title="Edit Event"></span>
                <span class="wk wk-garbage" title="Delete Event"></span>
            </td>
        </tr>

    </tbody>
</table>
                                            </div>
                                            <div class="paginated d-flex justify-content-center py-4">
                                                <ul class="pagination pagination-sm">
                                                    <li class="page-item">
                                                        <a href="#" class="page-link disabled"><span
                                                                class="fa fa-step-backward"></span> Prev</a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="#" class="page-link ">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link ">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link ">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link ">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link ">5</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link "> Next <span
                                                                class="fa fa-step-forward"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="sermon" class="sermon fullHeight">
                        sermon
                    </section>
                    <section id="bulletin" class="bulletin fullHeight">
                        bulletin
                    </section>
                </article>
            </div>

        </section>
        <script src="js/main.js"></script>
    </body>

</html>