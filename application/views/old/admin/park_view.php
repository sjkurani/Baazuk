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
    foreach ($recomanded['park'] as $key => $value) {
        $saved_recomanded[] = $value->park_id;
    }
  ?>

<legend class="text-right"><label><a href="<?php echo base_url().'parks/add'; ?>" class='btn hoverable_btn'>Add New Business Park</a></label></legend>
    <div class="nav nav-tabs nav-justified">
        <ul class="nav nav-tabs  main-navs" id="navID">
                <li class="active" id="new"><a href="#newPanel" data-toggle="tab" aria-expanded="true">
                New</a></li>
                <li class="" id="active"><a href="#actviePanel" data-toggle="tab" aria-expanded="false">Active</a></li>
                <li class=""  id="blocked"><a href="#blockedPanel" data-toggle="tab"  aria-expanded="false">Blocked</a></li>
        </ul>
        <div class="panel-body threepanel">
            <div class="tab-content">
                <section  class="tab-pane fade in active" id="newPanel">
                    <?php
                    if(!empty($parks['new'])) {

                          foreach ($parks['new'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>

                               <label><a href=".base_url()."parks/show/".$parks['new'][$key]->park_id.">".$parks['new'][$key]->park_name." -BP".$parks['new'][$key]->park_id."</a></label>  

                                <span class='pull-right'><a  class='btn btn-info' href='".base_url()."parks/edit/".$parks['new'][$key]->park_id."'>Edit</a></span>";


                             if($user_type =='admin') 

                                  {
                                    echo "<span class='pull-right'><a  class='btn btn-success' href='".base_url()."parks/change_parks_status/".$parks['new'][$key]->park_id."/1'>Activate</a></span>";

                                  }

                        echo"</legend>";
                        echo "<p>".$parks['new'][$key]->park_desc."</p>";
                        echo "</div>";

                    }
                }
                    else {
                        echo "<label class='no_result' >No New parks found here.</label>";
                    }
                    ?>
                </section>
                <section  class="tab-pane fade in" id="actviePanel">
                    <?php
                    if(!empty($parks['active'])) {

                            foreach ($parks['active'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>


                            <label><a href=".base_url()."parks/show/".$parks['active'][$key]->park_id.">".$parks['active'][$key]->park_name." -BP".$parks['active'][$key]->park_id."</a></label>
                                
                                <span class='pull-right'><a  class='btn btn-warning' href='".base_url()."parks/change_parks_status/".$parks['active'][$key]->park_id."/2'>Block</a></span>

                                <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."parks/delete_parks/".$parks['active'][$key]->park_id."/3'>Delete</a></span>";

                                if(in_array($parks['active'][$key]->park_id, $saved_recomanded)) {
                                    echo "<span class='pull-right'><a class='btn btn-success center-block'  href='#'> Recommended </a></span>";
                                }
                                else {
                                    $url_str = base_url()."recommend/save_rec_media/park/".$parks['active'][$key]->park_id;
                                    echo "<span class='pull-right'><a class='btn btn-warning center-block'  href=".$url_str."> Recommend </a></span class='pull-right'>";
                                }
                                echo "<span class='pull-right'><a  class='btn btn-success' href='".base_url()."parks/view/".$parks['active'][$key]->park_id."'>View options</a></span>
                                 
                                <span class='pull-right'><a  class='btn btn-success' href='".base_url()."park_ads/add/".$parks['active'][$key]->park_id."'>Add options</a></span>
                                
                                <span class='pull-right'><a  class='btn btn-info' href='".base_url()."parks/edit/".$parks['active'][$key]->park_id."'>Edit</a></span>
                                
                                </legend>";
                        echo "<p>".$parks['active'][$key]->park_desc."</p>";
                        echo "</div>";
                        

                    }
                }
                    else {
                        echo "<label class='no_result' >No Active parks found here.</label>";
                    }
                    ?>
                </section>
                <section  class="tab-pane fade in" id="blockedPanel">
                    <?php
                    if(!empty($parks['blocked'])) {


                        foreach ($parks['blocked'] as $key => $value) {
                            echo "<div class='row thumbnail list_view'>";
                            echo "<legend>


                        <label><a href=".base_url()."parks/show/".$parks['blocked'][$key]->park_id.">".$parks['blocked'][$key]->park_name." -BP".$parks['blocked'][$key]->park_id."</a></label>

                                <span class='pull-right'><a  class='btn btn-danger' href='".base_url()."parks/delete_parks/".$parks['blocked'][$key]->park_id."/3'>Delete</a></span>";

                              if($user_type =='admin') 

                                  {
                                    echo " <span class='pull-right'><a  class='btn btn-success' href='".base_url()."parks/change_parks_status/".$parks['blocked'][$key]->park_id."/1'>Reactivate</a></span>";

                                  }

                        echo "</legend>";

                        echo "<p>".$parks['blocked'][$key]->park_desc."</p>";
                        echo "</div>";
                    }
                }
                    else {
                        echo "<label class='no_result' >No Blocked parks found here.</label>";
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</div>