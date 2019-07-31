<?php
if(!isset($fromindex)){
        header("Location: ../../index.php");
        exit;
}
?>
<section id="index" class="index fullHeight">
<div class="my-auto fullHeight p-relative">
                    <div class="section text-center">
                     <div class="section-item">
                         
                             <a href="index.php?page=sermon" class="btn btn-success">Sermon</a>
                     </div>
                     <div class="section-item">
                             <a href="index.php?page=bulletin" class="btn btn-success">Bulletin</a>
                        
                 
                     </div>
                     <div class="section-item">
                             <a href="index.php?page=event" class="btn btn-success">Events</a>
                         </div>
                    </div>
    </div>
</section>