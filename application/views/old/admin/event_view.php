<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    if($this->session->userdata('user_type')!="")
         {
             $user_type = $this->session->userdata('user_type'); 
         } 

      if($this->session->flashdata('msg')){ 
           echo ' <div class="alert alert-success row error_msgs"><b>

            <a href="#" class="close" data-dismiss="alert">&times;</a>';
            echo $this->session->flashdata('msg');
           echo '</b></div>';
       }
    

?>
<div class="body container">
<?php
if(isset($breadcrumb_array) && !empty($breadcrumb_array) && is_array($breadcrumb_array)) {
echo '<ul class="breadcrumb row custom-breadcrumb">';
 $count = count($breadcrumb_array);
 foreach ($breadcrumb_array as $key => $value) {
   if (--$count <= 0) {
     echo "<li class='active'>".$key."</li>";
       break;
   }
   echo '<li><a href='.$value.'>'.$key.'</a></li>';
 }
echo "</ul>";
}

$saved_recomanded = array();
foreach ($recomanded['event'] as $key => $value) {
    $saved_recomanded[] = $value->event_id;
}
?>
<legend class="text-right"><label><a href="<?php echo base_url().'events/add'; ?>" class='btn hoverable_btn'>Add New Events and Exhibition</a></label></legend>
    <div class="nav nav-tabs nav-justified">
        <ul class="nav nav-tabs  main-navs" id="navID">
                <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
                New</a></li>
                <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
                <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
        </ul>
        <div class="panel-body">
            <div class="tab-content">
               <section  class="tab-pane fade in active" id="newPanel">
                    <?php
                    if(!empty($events['new'])) {
                        foreach ($events['new'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>

                            <label><a href=".base_url()."events/show/".$events['new'][$key]->event_id.">".$events['new'][$key]->event_name." -E".$events['new'][$key]->event_id."</a></label>
                        
                                <span class='pull-right'><a  class='btn btn-info' href='".base_url()."events/edit/".$events['new'][$key]->event_id."'>Edit</a></span>";

                               if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."events/change_events_status/".$events['new'][$key]->event_id."/1'>Activate</a></span>";

                                  }

                              echo "</legend>";


                        echo "<p>".$events['new'][$key]->event_desc."</p>";
                        echo "</div>";
                        }
                        
                    }
                    else {
                        echo "<label class='no_result'>No New events found here.</label>";
                    }
                    ?>
                </section>
                <section  class="tab-pane fade in" id="actviePanel">
                    <?php
                    if(!empty($events['active'])) {
                        foreach ($events['active'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend><label><a href=".base_url()."events/show/".$events['active'][$key]->event_id.">".$events['active'][$key]->event_name." -E".$events['active'][$key]->event_id."</a></label>
                                
                                <span class='pull-right'><a  class='btn btn-warning' href='".base_url()."events/change_events_status/".$events['active'][$key]->event_id."/2'>Block</a></span>

                               <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."events/delete_events/".$events['active'][$key]->event_id."/3'>Delete</a></span>";

                                if(in_array($events['active'][$key]->event_id, $saved_recomanded)) {
                                    echo "<span class='pull-right'><a class='btn btn-success center-block'  href='#'> Recommended </a></span>";
                                }
                                else {
                                    $url_str = base_url()."recommend/save_rec_media/event/".$events['active'][$key]->event_id;
                                    echo "<span class='pull-right'><a class='btn btn-warning center-block'  href=".$url_str."> Recommend </a></span class='pull-right'>";
                                }

                               echo "<span class='pull-right'><a  class='btn btn-success' href='".base_url()."events/view/".$events['active'][$key]->event_id."'>View options</a></span>

                                <span class='pull-right'><a  class='btn btn-success' href='".base_url()."event_ads/add/".$events['active'][$key]->event_id."'>Add options</a></span>
                                
                                <span class='pull-right'><a  class='btn btn-info' href='".base_url()."events/edit/".$events['active'][$key]->event_id."'>Edit</a></span>



                                </legend>";

                        

                        echo "<p>".$events['active'][$key]->event_desc."</p>";
                        echo "</div>";
                        }
                        
                    }
                    else {
                        echo "<label class='no_result'>No Active events found here.</label>";
                    }
                    ?>
                </section>
                <section  class="tab-pane fade in" id="blockedPanel">
                    <?php
                    if(!empty($events['blocked'])) {
                        foreach ($events['blocked'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>
                            <label><a href=".base_url()."events/show/".$events['blocked'][$key]->event_id.">".$events['blocked'][$key]->event_name." -E".$events['blocked'][$key]->event_id."</a></label>
                                
                               <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."events/delete_events/".$events['blocked'][$key]->event_id."/3'>Delete</a></span>";

                                if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."events/change_events_status/".$events['blocked'][$key]->event_id."/1'>Reactivate</a></span>";

                                  }
                          echo "</legend>";
                      
                        echo "<p>".$events['blocked'][$key]->event_desc."</p>";
                        echo "</div>";
                        }
                        
                    }
                    else {
                        echo "<label class='no_result'>No Blocked events found here.</label>";
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</div>