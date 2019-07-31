<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Section</title>
<?php include_once("includes/css.import.php"); ?>
<link rel="styelsheet" type="text/css" media="screen" href="css/cssa/font-awesome.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/carousel.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/admin.css">

</head>
<body>
<section class="modal-section">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" >
            <div class="form-group">
                <label for="event-header">Event Header</label>
                <input type="text" class="form-control" placeholder="Enter Event Header">
            </div>
            <div class="form-group">
                <label for="event-header">Event Title</label>
                <input type="text" class="form-control" placeholder="Enter Event title">
            </div>
            <div class="form-group">
                <label for="event-header">Event Subtitle</label>
                <input type="text" class="form-control" placeholder="Enter Event subtitle">
            </div>
            <div class="form-group">
                <label for="event-header">Event Description</label>
                <textarea row="12" col="15" class="form-control"></textarea>
            </div>
            <div class="form-group">
            <label for="event-image">Upload Event Image </label>
                
            </div>
            <div class="form-group">
               <label for="date-time">Event Start time</label>
               <input type="datetime-local" class="form-control">
               <label for="date-time">Event Stop time</label>
               <input type="datetime-local" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
<section>
<section class="modal-section">
<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2lLabel">Add Church Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" >
            <div class="form-group">
                <label for="event-header">Event Header</label>
                <input type="text" class="form-control" placeholder="Enter Event Header">
            </div>
            <div class="form-group">
                <label for="event-header">Event Title</label>
                <input type="text" class="form-control" placeholder="Enter Event title">
            </div>
            <div class="form-group">
                <label for="event-header">Event Subtitle</label>
                <input type="text" class="form-control" placeholder="Enter Event subtitle">
            </div>
            <div class="form-group">
                <label for="event-header">Event Description</label>
                <textarea row="12" col="15" class="form-control"></textarea>
            </div>
            <div class="form-group">
               <label for="date-time">Event Start time</label>
               <input type="datetime-local" class="form-control">
               <label for="date-time">Event Stop time</label>
               <input type="datetime-local" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
<section>
<section class="modal-section">
<!-- Modal -->
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" >
            <div class="form-group">
                <label for="event-header">Event Header</label>
                <input type="text" class="form-control" placeholder="Enter Event Header">
            </div>
            <div class="form-group">
                <label for="event-header">Event Title</label>
                <input type="text" class="form-control" placeholder="Enter Event title">
            </div>
            <div class="form-group">
                <label for="event-header">Event Subtitle</label>
                <input type="text" class="form-control" placeholder="Enter Event subtitle">
            </div>
            <div class="form-group">
                <label for="event-header">Event Description</label>
                <textarea row="12" col="15" class="form-control"></textarea>
                <div class="form-group"> 
                   <br/>
                  <label for="Event-image">Upload Event Image</label>
                  <input type="file" class="form-control btn btn-primary">
                  </div>
            </div>
            <div class="form-group">
               <label for="date-time">Event Start time</label>
               <input type="datetime-local" class="form-control">
               <label for="date-time">Event Stop time</label>
               <input type="datetime-local" class="form-control">
            </div>
        </form>
        <form method="POST" action="">
                                                           
                                                           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
<section>
<section class="modal-section">
<!-- Modal -->
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event 4</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" >
            <div class="form-group">
                <label for="event-header">Event Header</label>
                <input type="text" class="form-control" placeholder="Enter Event Header">
            </div>
            <div class="form-group">
                <label for="event-header">Event Title</label>
                <input type="text" class="form-control" placeholder="Enter Event title">
            </div>
            <div class="form-group">
                <label for="event-header">Event Subtitle</label>
                <input type="text" class="form-control" placeholder="Enter Event subtitle">
            </div>
            <div class="form-group">
                <label for="event-header">Event Description</label>
                <textarea row="12" col="15" class="form-control"></textarea>
            </div>
            <div class="form-group">
               <label for="date-time">Event Start time</label>
               <input type="datetime-local" class="form-control">
               <label for="date-time">Event Stop time</label>
               <input type="datetime-local" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
<section>
    <nav class="fixed-top">
            <a href="#"><img src="images/churchlook.jpg" height="100" width="100">Hello, Michael</a>
            <ul>
           <li>
            <a href="#">Lorem</a>
           </li>
           <li>
            <a href="#">ipsum</a>
           </li>
           <li>
            <a href="#">Geni</a>
           </li>
           <li>
            <a href="#"> cotava</a>
           </li>
       </ul>
       <ul class="nav-icons">
       <li><span class="text-white fas fa-envelope-square fa-2x"></span><span class="badge-danger">5</span></span></li>
       <li><span class="text-white fas fa-outdent fa-2x"></span><span class="badge-danger">10</span></li>
       <li><span class="text-white fa fa-bell fa-2x"></span><span class="badge-danger">10</span></li>
</ul>
</nav>
</section>
</section>
    <section class="admin-Dashboard">
    <div class="admin-container">
        <div class="side-bar">
        <div class="title-sidenav"><p> Admin Area</p></div>
        <div class="action-menu">
        <ul>
                        <li><a href="admin.php">Home page</a></li>
                        <li><a href="admin-event.php">Event Page</a></li>
                        <li><a href="admin-bulletin.php">Bulletin Page</a></li>
                        <li><a href="admin-contact.php">Contact Us</a></li>
                        <li><a href="admin-sermon.php">Sermon Page</a></li>
                        <li><a href="admin-about.php">About Us</a></li>
</ul> 

        </div>
        </div>
        <div class="admin-workspace">
            <div class="container-fluid">
                <div class="row">
                    <div class="admin-12 col-md-12">
                       <div class="row">
                           <div class="col-md-12">
                            <br/>
                            <br/>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-9">
                              <div class="container-fluid">
                                  <div class="col-md-12">
                                      <div class="card event-card-1">
                                          <div class="card-body">
                                              <div class="card-title">
                                                  <h5 class="font-weight-bolder mb-5">Event Section</h5>
                                              </div>
                                              <div class="fluid-container">
                                                 <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                                                     <div class="col-md-1 mr-5">
                                                         <img src="images/faces/face1.jpg" class="img-sm rounded-circle" alt="admin image">
                                                     </div>
                                                     <div class="ticket-details col-md-8">
                                                         <div class="d-flex">
                                                             <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Bible Study: </p>
                                                             <p class="text-primary mr-1 mb-0">[#1]</p>
                                                             <p class="mb-0 ellipsis">Lorem ipsum dolor sit amet consectetur adipisicing elitatus nulla</p>
                                                         </div>
                                                         <p class="text-gray ellipsis mb-2">Lorem ipsum dolor sit amet consectipisicing elit. Obcaecati distinctio laboreacere sequi doloribus.</p>
                                                     <div class="row text-gray d-md-flex d-none">
                                                         <div class="col-4 d-flex"> <small class="mb-0 mr-2 text-muted text-muted">Last responded :</small>
                                                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">3 hours ago</small></div>
                                                          <div class="col-4  d-flex">
                                                                <small class="mb-0 mr-2 text-muted text-muted">Due in :</small>
                                                                <small class="Last-responded mr-2 mb-0 text-muted text-muted">2 Days</small>
                                                          </div>
                                                     </div>
                                                     </div>
                                                     <div class="ticket-action col-md-2">
                                                        <div class="dropdown">
                                                            <button class="btn btn-success">Manage Event</button>
                                                            <div class="dropdown-content">
                                                                <a href="#"><span class="fa fa-reply"></span>Upload Event</a>
                                                                <a href="#"><span class="text-primary fa fa-plus-square"></span>Add Event</a>
                                                                <a data-toggle="modal" data-target="#modal2"><span class="fa fa-edit"></span>Edit Event</a>
                                                                <a href="#"><span class="text-danger fa fa-window-close"></span>Cancel Event</a>
                                                            </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card event-card-2">
                                          <div class="card-body">
                                              <div class="card-title">
                                                  <h5 class="font-weight-bolder mb-5">Event 2</h5>
                                              </div>
                                              <div class="fluid-container">
                                                 <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                                                     <div class="col-md-1 mr-5">
                                                         <img src="images/faces/face1.jpg" class="img-sm rounded-circle" alt="admin image">
                                                     </div>
                                                     <div class="ticket-details col-md-8">
                                                         <div class="d-flex">
                                                             <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Bible Study:</p>
                                                             <p class="text-primary mr-1 mb-0">[#1]</p>
                                                             <p class="mb-0 ellipsis">James Chapter 12 Vs 3</p>
                                                         </div>
                                                         <p class="text-gray ellipsis mb-2">Am the ligh of the world without me the whole world is blind
                                                         </p>
                                                     <div class="row text-gray d-md-flex d-none">
                                                         <div class="col-4 d-flex"> <small class="mb-0 mr-2 text-muted text-muted">Last Updated :</small>
                                                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">3 hours ago</small></div>
                                                          <div class="col-4  d-flex">
                                                                <small class="mb-0 mr-2 text-muted text-muted">Due in :</small>
                                                                <small class="Last-responded mr-2 mb-0 text-muted text-muted">2 Days</small>
                                                          </div>
                                                     </div>
                                                     </div>
                                                     <div class="ticket-action col-md-2">




                                                        <div class="dropdown">
                                                            <button class="btn btn-success">Manage Event</button>
                                                            <div class="dropdown-content">
                                                                <a href="#"><span class="fa fa-reply"></span>Upload Event</a>
                                                                <a href="#"><span class="text-primary fa fa-plus-square"></span>Add Event</a>
                                                                <a data-toggle="modal" data-target="#modal3"><span class="fa fa-edit"></span>Edit Event</a>
                                                                <a href="#"><span class="text-danger fa fa-window-close"></span>Cancel Event</a>
                                                            </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card event-card-3">
                                          <div class="card-body">
                                              <div class="card-title">
                                                  <h5 class="font-weight-bolder mb-5">Event Section</h5>
                                              </div>
                                              <div class="fluid-container">
                                                 <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                                                     <div class="col-md-1 mr-5">
                                                         <img src="images/faces/face1.jpg" class="img-sm rounded-circle" alt="admin image">
                                                     </div>
                                                     <div class="ticket-details col-md-8">
                                                         <div class="d-flex">
                                                             <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Bible Study: </p>
                                                             <p class="text-primary mr-1 mb-0">[#1]</p>
                                                             <p class="mb-0 ellipsis">Lorem ipsum dolor sit amet consectetur adipisicing elitatus nulla</p>
                                                         </div>
                                                         <p class="text-gray ellipsis mb-2">Lorem ipsum dolor sit amet consectipisicing elit. Obcaecati distinctio laboreacere sequi doloribus.</p>
                                                     <div class="row text-gray d-md-flex d-none">
                                                         <div class="col-4 d-flex"> <small class="mb-0 mr-2 text-muted text-muted">Last responded :</small>
                                                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">3 hours ago</small></div>
                                                          <div class="col-4  d-flex">
                                                                <small class="mb-0 mr-2 text-muted text-muted">Due in :</small>
                                                                <small class="Last-responded mr-2 mb-0 text-muted text-muted">2 Days</small>
                                                          </div>
                                                     </div>
                                                     </div>
                                                     <div class="ticket-action col-md-2">
                                                        <div class="dropdown">
                                                            <button class="btn btn-success">Manage Event</button>
                                                            <div class="dropdown-content">
                                                                <a href="#"><span class="fa fa-reply"></span>Upload Event</a>
                                                                <a href="#"><span class="text-primary fa fa-plus-square"></span>Add Event</a>
                                                                <a data-toggle="modal" data-target="#modal4"><span class="fa fa-edit"></span>Edit Event</a>
                                                                <a href="#"><span class="text-danger fa fa-window-close"></span>Cancel Event</a>
                                                            </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae architecto vel tenetur vitae deserunt? Temporibus, porro. Magni nemo officia neque deserunt doloribus quibusdam necessitatibus sit minus consectetur, enim tenetur, ea nihil rerum mollitia odio sint quae explicabo porro cumque saepe quisquam. Earum, numquam. Recusandae at totam praesentium iure eum dolorum ipsa nisi vitae. Ducimus, esse maiores. Magni, quo! Numquam aspernatur aliquid, nobis natus iusto eveniet aliquam? Dicta non, nostrum eum recusandae ab numquam quidem nam delectus officia vel earum neque id et tempora atque, unde consectetur? Porro enim quasi eligendi assumenda consequatur ipsum rerum numquam soluta a, dolor itaque sint hic maxime, qui est minus. Eos ad, itaque earum ut nulla deleniti voluptate voluptatibus voluptates placeat dignissimos ab non beatae ea est exercitationem quidem! Ex consectetur itaque, cupiditate sint laboriosam officiis ipsa unde eius sunt esse qui voluptate? Cumque tempora nulla tenetur ipsam, aliquam atque eum iste eaque error! Optio accusamus sit esse magni dolore quia vel animi numquam nulla nihil, soluta iure aliquid rem atque voluptates, cupiditate nam et fugit sint unde veniam eveniet ratione placeat! Iste sunt tempora, laborum quibusdam ut possimus molestiae ratione quasi, odio, dicta accusantium atque a incidunt dolorem. Omnis aut praesentium, animi asperiores corrupti atque laborum, libero totam voluptas fuga, corporis in consectetur illum architecto perspiciatis natus minima eligendi id excepturi eveniet. Ratione laboriosam deleniti tempora est necessitatibus eius accusantium dolore magni. Earum ex dolores culpa amet non alias sit cum harum debitis totam, itaque odit tempora doloribus quas laudantium fugit tenetur, aliquid sint officia? Nisi maxime, eaque deleniti excepturi provident voluptate delectus? Aspernatur natus molestiae magnam assumenda impedit autem voluptate obcaecati tempore reprehenderit delectus, laborum voluptatum. Molestiae asperiores repellendus provident at necessitatibus, quod animi unde facilis quos cum optio magni eligendi sit qui modi fugiat laudantium? Natus officiis architecto excepturi fugit, suscipit harum ex, distinctio hic nam quia nihil. Unde dicta, molestias qui, laudantium hic veniam, autem tempora facilis voluptas vel dolor pariatur animi optio voluptatem. Saepe ratione quam corporis. Neque fuga expedita quidem, dicta error illo veniam hic corrupti illum a. Explicabo magni quaerat, fugit magnam porro aliquid harum reiciendis perferendis veritatis nobis. Sunt voluptas, earum est itaque esse iste, placeat hic accusantium dolor odio nostrum explicabo temporibus cum, saepe aliquid tempore vero repellat dicta deleniti impedit? Voluptates at dolorem consequuntur molestiae magnam illo perferendis pariatur non necessitatibus. A voluptatem molestiae perferendis? Vero eligendi sint voluptatem maiores rerum sapiente corrupti natus sequi.</p>
                                </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <footer class="fixed-bottom">
        <div class="bg-dark row">
            <div class="col-md-12 text-center">

                <p class="text-white">Copyright &copy;
                    <?php echo date("Y") ?> All rights reserved | Gods Church <i class="icon-heart"
                        aria-hidden="true"></i>
                    by <a href="#" target="_blank">wikytek</a> </p>
            </div>
        </div>
    </footer>
</body>
<script src="js/jquery-3.3.1.js"></script>
<script src="vendor/js/bootstrap.js"></script>
</html>