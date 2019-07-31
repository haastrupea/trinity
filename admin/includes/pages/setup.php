<?php
if(!isset($fromindex)){
  header("Location: ../../index.php?page=setting");
  exit;
}
$manage_action = "setting";
$all_action    = ['ch_info','ch_history','ch_pst','ch_mission_vision','ch_logo_pic'];
$action=(string) isset($_GET['action'])? trim($_GET['action']):"";
$image_dir ='../assets/uploads/images/';
try {
    require_once 'includes/dbcons.php';
    // require_once 'includes/classes/Pagination.php';
} catch (Exception $e) {
    // $e->getMessage();
    $error = true;
}

if(!isset($error)){
    $sql_chk="SELECT * FROM church_info LIMIT 1 OFFSET 0";

    $qry_chk=$db->query($sql_chk);
    $church_info=$qry_chk->fetch(PDO::FETCH_ASSOC);


    $sql_his="SELECT * FROM church_history";
    if(isset($church_info['id'])){
        $sql_his.=" where church_id=".$church_info['id'];
    }
    $sql_his.=" LIMIT 1 OFFSET 0";
    $qry_his=$db->query($sql_his);
    $church_history=$qry_his->fetch(PDO::FETCH_ASSOC);

    $sql_pst="SELECT * FROM church_pastor";
 $qry_pst=$db->query($sql_pst);
 $church_pst=$qry_pst->fetch(PDO::FETCH_ASSOC);

 $sql_picture="SELECT * FROM picture_gallery LIMIT 1 OFFSET 0";
    $qry_picture=$db->query($sql_picture);
    $picture=$qry_picture->fetch(PDO::FETCH_ASSOC);
}
?>
<section id="bulletin" class="setting fullHeight">
    <div class="container-wrp">
        <div class="container-fluid">
            <div class="row relative">
                <div class="abs col-md-12">
                    <?php if (isset($_SESSION['message'])):
                    foreach ($_SESSION['message'] as $key => $value):
                    ?>
                <div id="msg-alert" class="mt-2 alert fs-animated <?php if (strpos(strtolower($value), "successfully")) { echo 'alert-success  rubberBand';
                } else {echo 'alert-danger shake';}
                    ?>  offset-md-2 col-md-8 text-center">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fa fa-info-circle mr-md-2"></span>
                        <span class="">
                            <?php echo $value ?>
                        </span>
                        <div class="dismiss fa fa-times" onclick="cleared()">
                        </div>
                    </div>
                </div>
                <?php endforeach;
                unset($_SESSION['message']);
                endif;
                ?>
            </div>

                <div class="col-md-6 py-2 setup <?php if($action===$all_action[0]){
                    echo "show";
                } ?>">
                    <a href="index.php?page=setting&action=ch_info"
                        class="btn btn-block setting-title d-flex align-items-center justify-content-between btn-success"
                        id="about-church-setup">
                        <h5 class="text-left"> <span class="fa fa-church"></span> Church information
                        </h5>
                        <span id="form-stat1" class="fa fa-check-circle btn fs-animated rubberBand"
                            title="All information has been filled"></span>

                        <div class="fa fa-times "></div>
                    </a>
                    <div class="setting-body border p-3">
                        <div class="container-fuild">
                            
                            <form data-id="form-stat1" action="includes/crud/setup.php" method="post" name="church_info" id="church-info">
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">
                                        Church Name</div>
                                    <div class="form-group col-md-9">
                                        <input type="text" class="form-control input " autocomplete="organization"
                                            name="church_name"
                                            value="<?php echo isset($church_info['ch_name'])? $church_info['ch_name']:"" ?>" required>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">
                                        Church Address</div>
                                    <div class="form-group col-md-9">
                                        <input type="text" class="form-control input " autocomplete="street-address"
                                            name="church_addr"
                                            value="<?php echo isset($church_info['ch_address'])? $church_info['ch_address']:"" ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">
                                        Church Email</div>
                                    <div class="form-group col-md-9">
                                        <input type="email" class="form-control input " autocomplete="email" inputmode="email"
                                            name="church_email"
                                            value="<?php echo isset($church_info['ch_email'])? $church_info['ch_email']:"" ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row align-items-center" id="church-phone">
                                    <div class="form-group col-md-3">Church Phone</div>
                                    <div class="tel form-group col-8 col-sm-10 col-md-7">
                                        <input type="tel" class="form-control input " autocomplete="tel"
                                            placeholder="Phone Number 1" inputmode="tel" name="ch_phone_1"
                                            value="<?php echo isset($church_info['ch_phone_1'])? $church_info['ch_phone_1']:"" ?>"
                                            required>
                                    </div>
                                    <div class="form-group col-2 text-center text-md-right">
                                        <span class="btn btn-success" id="add-church-phone">
                                            <span class="fa fa-phone"><span class="fa fa-plus"></span></span>
                                        </span>
                                    </div>
                                    <?php
                                    if(!empty($church_info['ch_phone_2'])): ?>
                                    <div class="tel form-group offset-md-3 col-8 col-sm-10 col-md-7" id="phone-2"><input
                                            type="tel" autocomplete="tel" class="form-control input "
                                            placeholder="Phone Number 2" name="ch_phone_2"
                                            value="<?php echo $church_info['ch_phone_2']; ?>"></div>
                                    <div class="rm-btn form-group col-2 text-center text-md-right" id="2"><span
                                            class="btn btn-danger disabled"><span class="fa fa-phone"><span
                                                    class="fa fa-minus"></span></span></span></div>
                                    <?php endif;//if(!empty($church_info['ch_phone_2'])): ?>
                                    <?php
                                    if(!empty($church_info['ch_phone_3'])): ?>
                                    <div class="tel form-group offset-md-3 col-8 col-sm-10 col-md-7" id="phone-3"><input
                                            type="tel" autocomplete="tel" class="form-control input "
                                            placeholder="Phone Number 3" name="ch_phone_3"
                                            value="<?php echo $church_info['ch_phone_3']; ?>"></div>
                                    <div class="rm-btn form-group col-2 text-center text-md-right" id="3"><span
                                            class="btn btn-danger disabled"><span class="fa fa-phone"><span
                                                    class="fa fa-minus"></span></span></span></div>
                                    <?php endif;//if(!empty($church_info['ch_phone_2'])): ?>
                                    <?php
                                    if(!empty($church_info['ch_phone_4'])): ?>
                                    <div class="tel form-group offset-md-3 col-8 col-sm-10 col-md-7" id="phone-4"><input
                                            type="tel" autocomplete="tel" class="form-control input "
                                            placeholder="Phone Number 4" name="ch_phone_4"
                                            value="<?php echo $church_info['ch_phone_4']; ?>"></div>
                                    <div class="rm-btn form-group col-2 text-center text-md-right" id="4"><span
                                            class="btn btn-danger disabled"><span class="fa fa-phone"><span
                                                    class="fa fa-minus"></span></span></span></div>
                                    <?php endif;//if(!empty($church_info['ch_phone_2'])): ?>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">Post Office Box</div>
                                    <div class="form-group col-md-4">
                                        <input type="number" class="form-control input " placeholder="Box number"
                                            name="church_box_number"
                                            value="<?php echo isset($church_info['ch_box_number'])? $church_info['ch_box_number']:"" ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input type="text" class="form-control input  " autocomplete="email" inputmode="text"
                                            placeholder="Post Office" name="church_post_office"
                                            value="<?php echo isset($church_info['ch_post_office'])? $church_info['ch_post_office']:"" ?>">
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">Fax Number</div>
                                    <div class="form-group col-md-9">
                                        <input type="text" class="form-control input " placeholder="Fax number"
                                            name="church_fax"
                                            value="<?php echo !empty($church_info['ch_fax'])? $church_info['ch_fax']:"" ?>">
                                    </div>

                                </div>

                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-3">
                                        Social media</div>
                                    <div class="form-group col-md-3 ">
                                        <input type="text" class="form-control input  text-center" autocomplete="off"
                                            placeholder="Facebook" name="church_fb_page"
                                            value="<?php echo isset($church_info['ch_fb_pg'])? $church_info['ch_fb_pg']:"" ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control input  text-center" autocomplete="off"
                                            placeholder="Twitter" name="church_tw_handle"
                                            value="<?php echo isset($church_info['ch_twitter'])? $church_info['ch_twitter']:"" ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control input " autocomplete="off"
                                            placeholder="Instagram" name="church_ig_handle"
                                            value="<?php echo isset($church_info['ch_instagram'])? $church_info['ch_instagram']:"" ?>">
                                    </div>
                                </div>
                                <div class="form-row align-items-center justify-content-end">
                                    <div class="form-group ">
                                        <button class="btn btn-success" name="save_ch_info"><span
                                                class="fa fa-paper-plane"> Save</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 py-2 setup <?php if($action===$all_action[1]){
                    echo "show";
                } ?>">
                    <a href="index.php?page=setting&action=ch_history"
                        class="btn btn-block btn-success d-flex align-items-center justify-content-between  setting-title">
                        <h5 class="text-left">
                            <span class="fa fa-history"></span> Church History
                        </h5>
                        <span id="form-stat2" class="fa fa-check-circle btn fs-animated rubberBand"
                            title="All information has been filled"></span>

                        <div class="fa fa-times "></div>
                    </a>
                    <div class="setting-body border p-3">
                        <form data-id="form-stat2" id="ch_history" action="includes/crud/setup.php" method="post" >
                            <div class="form-row align-items-center">
                                <input type="hidden" name="church" value="<?php echo $church_info['id'] ?>">
                                <div class="form-group col-md-3">
                                    Date Established</div>
                                <div class="form-group col-md-9">
                                    <input type="date" class="form-control input " name="founding_date" value="<?php echo isset($church_history['founding_date'])? date('Y-m-d',strtotime($church_history['founding_date'])):""; ?>" required>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church History </div>
                                <div class="form-group col-md-9 text-center text-md-right">
                                    <textarea class="form-control input " name="about_church" id="about-church"
                                        rows="5" class="church_history" required><?php echo isset($church_history['church_History'])?$church_history['church_History']:"";?></textarea>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Documentary Video (optional)</div>
                                    <div class="form-group col-md-3">
                                            <span class="btn btn-danger"><span class="fab fa-youtube"></span> Youtube</span>
                                    </div>
                                <div class="form-group col-md-6">
                                    <input type="url" class="form-control input " placeholder="Youtube link to documentary video" name="y_link" value="<?php
                                        echo isset($church_history['video_doc'])?$church_history['video_doc']:"";
                                        
                                        ?>">
                                </div>
                            </div>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="form-group ">
                                    <button class="btn btn-success" name="save_history"><span class="fa fa-paper-plane">
                                            Save</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 py-2 setup <?php if($action===$all_action[2]){
                    echo "show";
                } ?>">
                    <a href="index.php?page=setting&action=ch_pst"
                        class="btn btn-block btn-success d-flex align-items-center justify-content-between  setting-title">
                        <h5 class="text-left">
                            <span class="fa fa-user-tie"></span> Pastor In Charge
                        </h5>
                        <span id="form-stat3" class="fa fa-check-circle btn fs-animated rubberBand"
                        title="All information has been filled"></span>
                        <div class="fa fa-times "></div>
                    </a>
                    <div class="setting-body border p-3">
                        <form data-id="form-stat3"  id="pst_in_chrg" action="includes/crud/setup.php" method="post" enctype="multipart/form-data">
                            <div class="alert alert-info border border-danger">
                                <input type="checkbox" name="pst_is_founder" id="pic-is-founder" value=true <?php echo !empty($church_pst['is_founder'])? "checked":"" ?>>
                                <label for="pic-is-founder" class="m-0"> Is the Pastor in Charge founder of the
                                    church?</label>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Name </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control input  text-center"
                                        autocomplete="organization-title" placeholder="Title" name="title" value="<?php
                                        echo isset($church_pst['title'])?$church_pst['title']:"";
                                        
                                        ?>">
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control input " autocomplete="name" placeholder="Firstname" name="firstname" value="<?php
                                        echo isset($church_pst['firstname'])?$church_pst['firstname']:"";
                                        
                                        ?>">
                                </div>
                                <div class="form-group offset-md-3 col-md-4 ">
                                    <input type="text" class="form-control input " autocomplete="name" placeholder="Middlename" name="middlename" value="<?php
                                        echo isset($church_pst['middlename'])?$church_pst['middlename']:"";
                                        
                                        ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="text" class="form-control input " autocomplete="name" placeholder="Lastname" name="lastname" value="<?php
                                        echo isset($church_pst['lastname'])?$church_pst['lastname']:"";
                                        
                                        ?>">
                                </div>
                                <div class="form-group offset-md-3 col-md-5">
                                    <select name="pst_gender" class="form-control input ">
                                        <option>
                                            Gender
                                        </option>
                                        <option value="female" <?php echo $church_pst['gender']=="female"?"selected":"" ?>>
                                          Female
                                        </option>
                                        <option value="male" <?php echo $church_pst['gender']=="male"?"selected":"" ?>>
                                            Male
                                        </option>
                                        </select>

                                </div>
                            </div>

                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Picture </div>
                                <div class="form-group col-md-5">
                                    <input type="file" class="form-control input " name="pst_picture" id="pst_picture">
                                    <input type="hidden" value="<?php echo $church_pst['picture'] ?>" class="input">
                                </div>
                                <label for="pst_picture" class="form-group col-md-4 text-center text-md-right">
                                    <?php if(!isset($church_pst['picture'])): ?>
                                    <img class="img-thumbnail" src="images/person_1.jpg" alt="Pastor picture"
                                        width="150" height="150">
                                <?php else: ?>
                                <img class="img-thumbnail" src="<?php echo $image_dir.$church_pst['picture']; ?>" alt="Pastor picture"
                                        width="150" height="150">
                                <?php endif; ?>
                                    
                                </label>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    About Pastor </div>
                                <div class="form-group col-md-9 text-center text-md-right">
                                    <textarea class="form-control input " name="about_Pastor" id="about-Pastor"
                                        rows="3" name="about_pst" ><?php echo isset($church_pst['about'])?$church_pst['about']:"";?></textarea>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Welcome Address </div>
                                <div class="form-group col-md-9 text-center text-md-right">
                                    <textarea class="form-control input " id="about-pastor"
                                        rows="3" name="pst_wlcm_address"><?php echo isset($church_pst['welcome_address'])?$church_pst['welcome_address']:"";?></textarea>
                                </div>
                            </div>
                           
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Social media</div>
                                <div class="form-group col-md-3 ">
                                    <input type="text" class="form-control input  text-center" autocomplete="off"
                                        placeholder="Facebook" name="fb" value="<?php echo isset($church_pst['fb_page'])?$church_pst['fb_page']:"";?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control input  text-center" autocomplete="off"
                                        placeholder="Twitter" name="twitter" value="<?php echo isset($church_pst['twitter_page'])?$church_pst['twitter_page']:"";?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control input " autocomplete="off" placeholder="Instagram" name="ig" value="<?php echo isset($church_pst['ig_page'])?$church_pst['ig_page']:"";?>">
                                </div>
                            </div>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="form-group ">
                                    <button class="btn btn-success" name="save_pst_ic"><span class="fa fa-paper-plane">
                                            Save</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 py-2 setup <?php if($action===$all_action[4]){
                    echo "show";
                } ?>">
                    <a href="index.php?page=setting&action=ch_logo_pic"
                        class="btn btn-block btn-success d-flex align-items-center justify-content-between  setting-title">
                        <h5 class="text-left">
                            <span class="fa fa-images"></span> Logo and Pictures
                        </h5>
                        <span id="form-stat4" class="fa fa-check-circle btn fs-animated rubberBand"
                            title="All information has been filled"></span>

                        <div class="fa fa-times "></div>
                    </a>
                    <div class="setting-body border p-3">
                        <form data-id="form-stat4" action="includes/crud/setup.php" method="post" enctype="multipart/form-data" >
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church Logo</div>
                                <div class="form-group col-md-5">
                                    <input type="file" class="form-control input " name="ch_logo" id="ch_logo">

                                    <input type="hidden" value="<?php echo $picture['logo'] ?>" class="input">
                                </div>
                                <label for="ch_logo" class="form-group col-md-4 text-center text-md-right">
                                    <?php if(!isset($picture['logo'])): ?>
                                    <img class="img-thumbnail" src="images/person_1.jpg" alt="Pastor picture"
                                        width="150" height="150">
                                <?php else: ?>
                                <img class="img-thumbnail" src="<?php echo $image_dir.$picture['logo']; ?>" alt="Pastor picture"
                                        width="150" height="150">
                                <?php endif; ?>
                                    
                                </label>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church Inside View</div>
                                <div class="form-group col-md-5">
                                    <input type="file" class="form-control input " name="ch_in_view" id="ch_in_view">

                                    <input type="hidden" value="<?php echo $picture['inside_view'] ?>" class="input">
                                </div>
                                <label for="ch_in_view" class="form-group col-md-4 text-center text-md-right">
                                    <?php if(!isset($picture['inside_view'])): ?>
                                    <img class="img-thumbnail" src="images/person_1.jpg" alt="Pastor picture"
                                        width="150" height="150">
                                <?php else: ?>
                                <img class="img-thumbnail" src="<?php echo $image_dir.$picture['inside_view']; ?>" alt="Pastor picture"
                                        width="150" height="150">
                                <?php endif; ?>
                                    
                                </label>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church outside view</div>
                                <div class="form-group col-md-5">
                                    <input type="file" class="form-control input "  name="ch_out_view" id="ch_out_view">

                                    <input type="hidden" value="<?php echo $picture['outside_view'] ?>" class="input">
                                </div>
                                <label for="ch_out_view" class="form-group col-md-4 text-center text-md-right">
                                    <?php if(!isset($picture['outside_view'])): ?>
                                    <img class="img-thumbnail" src="images/person_1.jpg" alt="Pastor picture"
                                        width="150" height="150">
                                <?php else: ?>
                                <img class="img-thumbnail" src="<?php echo $image_dir.$picture['outside_view']; ?>" alt="Pastor picture"
                                        width="150" height="150">
                                <?php endif; ?>
                                    
                                </label>
                            </div>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="form-group ">
                                    <button class="btn btn-success" name="save_logo_pic"><span
                                            class="fa fa-paper-plane"> Save</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 py-2 setup <?php if($action===$all_action[3]){
                    echo "show";
                } ?>">
                    <a href="index.php?page=setting&action=ch_mission_vision"
                        class="btn btn-block btn-success d-flex align-items-center justify-content-between  setting-title">
                        <h5 class="text-left">
                            <span class="fa fa-binoculars"></span> Mission and Vision
                        </h5>
                        <span id="form-stat5" class="fa fa-check-circle btn fs-animated rubberBand"
                            title="All information has been filled"></span>
                        <div class="fa fa-times "></div>
                    </a>
                    <div class="setting-body border p-3">
                        <form data-id="form-stat5" action="includes/crud/setup.php" method="post">
                            <input type="hidden" name="church" value="<?php echo $church_info['id'] ?>">
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church Mission Statement</div>
                                <div class="form-group col-md-9">
                                    <textarea class="form-control input " autocomplete="email" rows="5" name="ch_mission" required><?php echo isset($church_history['mission'])?$church_history['mission']:"";?></textarea>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Church vision Statement</div>
                                <div class="form-group col-md-9">
                                    <textarea class="form-control input " autocomplete="email" rows="5" name="ch_vision" required><?php echo isset($church_history['vision'])?$church_history['vision']:"";?></textarea>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-3">
                                    Video Clip(Optional)</div>
                                    <div class="form-group col-md-3 text-center text-md-right">
                                        <span class="btn btn-danger"><span class="fab fa-youtube"></span> Youtube</span>
                                    </div>
                                <div class="form-group col-md-6">
                                    <input placeholder="Link" type="url" name="ch_vs_ms_video" class="form-control input " value="<?php echo isset($church_history['vs_ms_youtube_link'])?$church_history['vs_ms_youtube_link']:"";?>">
                                </div>
                            </div>
                            <div class="form-row align-items-center justify-content-end">
                                <div class="form-group ">
                                    <button class="btn btn-success" name="save_m_v"><span class="fa fa-paper-plane">
                                            Save</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let rm_phone = (e) => {
        let phn_id = e.currentTarget.id;
        let rm_phn = document.getElementById("phone-" + phn_id);
        rm_phn.parentNode.removeChild(rm_phn);
        e.currentTarget.parentNode.removeChild(e.currentTarget);
        e.currentTarget.removeEventListener('click', rm_phone, false);
        //renumber the extra phone no
        let rm_btn = document.querySelectorAll(".rm-btn");
        rm_btn.forEach((elm, i) => {

            if (elm.id !== "") {
                elm.id = (i + 2);
            }
        })

        let tel = document.querySelectorAll('.tel');
        tel.forEach((elm, i) => {

            if (elm.id !== "") {
                elm.id = "phone-" + (i + 1);
                let inp = elm.querySelector("input");
                inp.placeholder = "Phone Number " + (i + 1);
                inp.name = "ch_phone_" + (i + 1);
            }
        })


    }

    let add_phone = () => {
        let tel = document.querySelectorAll(".tel").length + 1;
        if (tel > 4) {
            return;
        }

        let phn_div = document.createElement('div');
        phn_div.className = "tel form-group offset-md-3 col-8 col-sm-10 col-md-7";
        phn_div.id = "phone-" + tel;

        let phn_in = document.createElement('input');
        phn_in.type = "tel";
        phn_in.autocomplete = "tel";
        phn_in.className = "form-control input";
        phn_in.placeholder = "Phone Number " + tel;
        phn_in.name = "ch_phone_" + tel;
        phn_div.appendChild(phn_in);
        phn.appendChild(phn_div);


        let phn_div_btn = document.createElement('div');
        phn_div_btn.className = "rm-btn form-group col-2 text-center text-md-right";
        phn_div_btn.id = tel;
        phn_div_btn.addEventListener('click', rm_phone, false)

        let phn_spn_btn = document.createElement('span');
        phn_spn_btn.className = "btn btn-danger";
        phn_div_btn.appendChild(phn_spn_btn);

        let phn_spn2_btn = document.createElement('span');
        phn_spn2_btn.className = "fa fa-phone";
        phn_spn_btn.appendChild(phn_spn2_btn);

        let phn_spn3_btn = document.createElement('span');
        phn_spn3_btn.className = "fa fa-minus";
        phn_spn2_btn.appendChild(phn_spn3_btn);
        phn.appendChild(phn_div_btn);


    }

    let phn = document.getElementById('church-phone');
    let add_phn = document.getElementById('add-church-phone');
    add_phn.addEventListener('click', add_phone, false);

    //use js to defaultly hide all settings details
    let set_body = document.querySelectorAll('.setting-body');
    set_body.forEach(elm => {
        elm.classList.add('hide');
    })

    let all_setup = document.querySelectorAll(".setup .setting-title");
    let toggle_setup = (e) => {
        //get active setup and deactive it
        let cur_setup = document.querySelector(".setup.show");
        if (cur_setup !== null && cur_setup !== e.currentTarget.parentNode) {
            cur_setup.classList.remove('show');
        }
        //make the current item clicked on the active
        e.currentTarget.parentNode.classList.toggle("show");
        e.preventDefault();
    }

    //add click event to all setup
    all_setup.forEach(elm => {
        elm.addEventListener('click', toggle_setup, false);
    });

    //form filled status
    let formFillStatus = (form) => {
        let form_elm=form;
        let form_stat = document.getElementById(form_elm.getAttribute('data-id'));
        let form_in = form_elm.querySelectorAll(".input");
            if (form_in === null || form_stat === null) {
                return;
            }
            form_in.forEach(elm => {
            if (elm.value === "" && elm.type!="file") {
                form_stat.className = "fa fa-exclamation-triangle text-danger btn";
                form_stat.title = 'Some information are yet to be filled';
            }

           
        })
}


    let forms=document.querySelectorAll("form");
        forms.forEach(elm => {
            formFillStatus(elm)
        });

</script>