<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if($this->session->flashdata('msg')){ 
        echo ' <div class="alert alert-success row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('msg');
    echo '</b></div>';
}
if($this->session->flashdata('errormsg')){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $this->session->flashdata('errormsg'); 
    echo '</b></div>';

}

if(isset($err_msg)){ 
        echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $err_msg; 
    echo '</b></div>';

}
if (isset($msg)) {
        echo ' <div class="alert alert-success row"><b>
        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo $msg;
    echo '</b></div>';
}

 if (validation_errors()){
    echo ' <div class="alert alert-danger row error_msgs"><b>

        <a href="#" class="close" data-dismiss="alert">&times;</a>';
    echo validation_errors();
    echo '</b></div>';                                 
}
?>
<div class="container ">
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
?>
<div class="row well ">
    <legend class="text-center page-header"><label class="">Admin Dashboard</label> </legend>
    <!-- Centered Tabs -->
    <ul id="navID" class="nav nav-pills nav-justified default-pills underlined">              
      <li class="active"><a data-toggle="tab" href="#generalSection">General</a></li>
      <li><a data-toggle="tab" href="#mediaTypeSection">Media Types</a></li>
      <li><a data-toggle="tab" href="#reportSection">Reports</a></li>
      <li><a data-toggle="tab" href="#mediaOptionSection">Media Options</a></li>
    </ul>
    <legend></legend>
    <div class="dashboard_view tab-content">
        <div id="generalSection" class="tab-pane fade in active">
            <section class="col-md-12 tab-pane fade in">
            <div class="row">
                <ul class="">
                    <li class="text-center col-md-3">
                        <a href="<?php echo base_url().'users'; ?>">
                            <i class="fa fa-building fa-2" aria-hidden="true"></i>
                            <div>Manage Users</div>
                        </a>
                    </li>
                    <li class="text-center col-md-3">
                        <a href="<?php echo base_url().'enquiries'; ?>">
                            <i class="fa fa-calendar fa-2" aria-hidden="true"></i>
                            <div>Enquires</div>
                        </a>
                    </li>
                     <li class="text-center col-md-3">
                        <a href="<?php echo base_url().'terms'; ?>">
                            <i class="fa fa-book fa-2" aria-hidden="true"></i>
                            <div>Terms And Condition</div>
                        </a>
                    </li> 
                    <li class="text-center col-md-3">
                        <a href="<?php echo base_url().'cityarea'; ?>">
                            <i class="fa fa-globe fa-2" aria-hidden="true"></i>
                            <div>City And Area</div>
                        </a>
                    </li> 
                </ul>
                </div>
            </section>
        </div>
      <div id="mediaTypeSection" class="tab-pane fade in">
            <section class="col-md-12 tab-pane fade in">
            <div class="row">
                <ul>
                <!--    <li class="text-center">
                        <a href="<?php echo base_url().'apartments/admin'; ?>">
                            <i class="fa fa-building fa-2" aria-hidden="true"></i>
                            <div>Apartments</div>
                        </a>
                    </li>-->
                    <li class="text-center">
                        <a href="<?php echo base_url().'events/admin'; ?>">
                            <i class="fa fa-calendar fa-2" aria-hidden="true"></i>
                            <div>Events and Exhibition</div>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="<?php echo base_url().'malls/admin'; ?>">
                            <i class="fa fa-building-o fa-2" aria-hidden="true"></i>
                            <div>Malls</div>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="<?php echo base_url().'radio/admin'; ?>">
                            <i class="fa fa-bullhorn fa-2" aria-hidden="true"></i>
                            <div>Radio</div>
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="<?php echo base_url().'parks/admin'; ?>">
                            <i class="fa fa-map-marker fa-2" aria-hidden="true"></i>
                            <div>Business Parks</div>
                        </a>
                    </li>
                    

                   <!-- <li class="text-center">
                        <a href="<?php echo base_url().'hoarding_ads'; ?>">
                            <i class="fa fa-location-arrow fa-2" aria-hidden="true"></i>
                            <div>Hoardings</div>
                        </a>
                    </li>-->
                </ul>
                </div>
            </section>
      </div>
        <div id="reportSection" class="tab-pane fade in">
            <section class="col-md-12 tab-pane fade in" id="reportSection">
            <div class="row">
            <ul>
             <!--   <li class="text-center">
                    <a href="<?php echo base_url().'reports/apartments'; ?>">
                        <i class="fa fa-building fa-2" aria-hidden="true"></i>
                        <div>Apartments</div>
                    </a>
                </li>-->
                <li class="text-center">
                    <a href="<?php echo base_url().'reports/events'; ?>">
                        <i class="fa fa-calendar fa-2" aria-hidden="true"></i>
                        <div>Events and Exhibition</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'reports/malls'; ?>">
                        <i class="fa fa-building-o fa-2" aria-hidden="true"></i>
                        <div>Malls</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'reports/radios'; ?>">
                        <i class="fa fa-bullhorn fa-2" aria-hidden="true"></i>
                        <div>Radio</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'reports/parks'; ?>">
                        <i class="fa fa-map-marker fa-2" aria-hidden="true"></i>
                        <div>Business Parks</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'reports/hoardings'; ?>">
                        <i class="fa fa-location-arrow fa-2" aria-hidden="true"></i>
                        <div>Hoardings</div>
                    </a>
                </li>
            </ul>
            </div>
            </section>
        </div>    
        <div id="mediaOptionSection" class="tab-pane fade in">
            <section class="col-md-12 tab-pane fade in" id="mediaOptionSection">
            <div class="row">
            <ul>
              <!--  <li class="text-center">
                    <a href="<?php echo base_url().'apartment_ads'; ?>">
                        <i class="fa fa-building fa-2" aria-hidden="true"></i>
                        <div>Apartments</div>
                    </a>
                </li>-->
                <li class="text-center">
                    <a href="<?php echo base_url().'event_ads'; ?>">
                        <i class="fa fa-calendar fa-2" aria-hidden="true"></i>
                        <div>Events and Exhibition</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'mall_ads'; ?>">
                        <i class="fa fa-building-o fa-2" aria-hidden="true"></i>
                        <div>Malls</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'radio_ads'; ?>">
                        <i class="fa fa-bullhorn fa-2" aria-hidden="true"></i>
                        <div>Radio</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'park_ads'; ?>">
                        <i class="fa fa-map-marker fa-2" aria-hidden="true"></i>
                        <div>Business Parks</div>
                    </a>
                </li>
                <li class="text-center">
                    <a href="<?php echo base_url().'hoarding_ads/admin'; ?>">
                        <i class="fa fa-location-arrow fa-2" aria-hidden="true"></i>
                        <div>Hoardings</div>
                    </a>
                </li>
                <!--<li class="text-center">
                    <a href="<?php echo base_url().'hoarding_ads/admin'; ?>">
                        <i class="fa fa-location-arrow fa-2" aria-hidden="true"></i>
                        <div>Hoardings</div> 
                    </a>
                </li>-->
            </ul>
            </div>
            </section>
        </div>
    </div>

</div>
</div>