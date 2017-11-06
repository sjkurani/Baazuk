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
 // print_r($apartments_area_list);
?>

<script type="text/javascript">var base_url = "<?php print base_url(); ?>";</script> 
<script>
/*function check() {
    var e=document.getElementById('yesCheck').value;
    //alert(e);

if(e=="radios") {
    //alert(e);
   document.getElementById('ifYes').style.display = 'none';
   document.getElementById('area').value = "";
   document.getElementById('area').required = false;
  
} else {
   //alert(e);
   document.getElementById('ifYes').style.display = 'block';
   document.getElementById('area').required = true;
}
}*/
</script>
<div class="section large transparent dark text-center" style="background-image: url('images/background01.jpg');">
    <div class="inner">
        <div class="container">

            <h1>MediaBasket </h1>
            <p class="lead col-lg-12 col-sm-12">Media simplified</p>

            <div class="nav nav-tabs nav-justified">

               
                <!-- new ul class design for new style start here-->
                

                <!-- new ul class design for new style end here-->
                <div class="panel-body custom-padding">
                    <div class="tab-content">
                      <!--  <section class="tab-pane fade in active" id="apartmentSection">
                            <form action="search/show" id="apartmentForm">
                                <div class="row">
                                        <input type="hidden" name="media_type" value="apartments">
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12 purple_text">City</label>
                                        <select class="col-md-12 form-control city_name" name="city_val" id="apartment_city">
                                        <option value="0">--Select City--</option>
                                        <?php
                                        foreach ($apartments_city_list as $key => $value) {
                                            echo "<option value=".$value->city_id." />".$value->city_name."</option>";
                                        print_r($value);
                                        }
                                        ?>
                                        </select>
                                        <input type="hidden" name="city" id="apartment_city_name">
                                    </div>
                                    
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12 purple_text">Area</label>
                                        <select id="apartment_area" class="col-md-12 form-control" name="area" >
                                         <option value="0">--Select area--</option>
                                        <?php
                                        
                                         foreach ($apartments_area_list as $key => $value) {
                                            echo "<option value=".$value->area_id." />".$value->area_name."</option>";
                                        }
                                        ?>
                                        </select>     
                                    </div> 
                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i>  Search Apartments</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>-->

                        <section class="tab-pane fade in " id="eventSection">
                            <form action="search/show" id="eventForm">
                                <div class="row">
                                        <input type="hidden" name="media_type" value="events">
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">City</label>
                                        <select class="col-md-12 form-control city_name" name="city_val" id="event_city">
                                        <option value="0">--Select City--</option>

                                        <?php
                                        foreach ($events_city_list as $key => $value) {
                                            echo "<option value=".$value->city_id." />".$value->city_name."</option>";
                                        }
                                        ?>
                                        </select>
                                        <input type="hidden" name="city" id="event_city_name">
                                    </div>
                                    
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">Area</label>
                                        <select id="event_area" class="col-md-12 form-control" name="area" ></select>     
                                    </div> 
                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i>  Search Exhibitions</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="tab-pane fade in" id="mallSection">
                            <form action="search/show" id="mallForm">
                                <div class="row">
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">City</label>
                                        <select class="col-md-12 form-control city_name" name="city_val" id="mall_city">
                                        <option value="0">--Select City--</option>
                                        <?php
                                        foreach ($malls_city_list as $key => $value) {
                                            echo "<option value=".$value->city_id." />".$value->city_name."</option>";
                                        }
                                        ?>
                                        </select>
                                        <input type="hidden" name="city" id="mall_city_name">
                                    </div>
                                    
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">Area</label>
                                        <select id="mall_area" class="col-md-12 form-control" name="area" ></select>     
                                    </div> 
                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                        <input type="hidden" name="media_type" value="malls">
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i>  Search Malls</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="tab-pane fade in" id="radioSection">
                            <form action="search/show" id="radioForm">
                                <div class="row">
                                    <div class="col-md-2 text-left">
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <label class="col-md-12">City</label>
                                        <select class="col-md-12 form-control city_name" name="city" id="city">
                                        <option value="0">--Select City--</option>
                                        <?php
                                        foreach ($radios_city_list as $key => $value) {
                                            echo "<option value=".$value->city_name." />".$value->city_name."</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                        <input type="hidden" name="media_type" value="radios">
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i>  Search Radio</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="tab-pane fade in" id="parkSection">
                            <form action="search/show" id="parkForm">
                                <div class="row">
                                    <input type="hidden" name="media_type" value="parks">
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">City</label>
                                        <select class="col-md-12 form-control city_name" name="city_val" id="park_city">
                                        <option value="0">--Select City--</option>
                                        <?php
                                        foreach ($parks_city_list as $key => $value) {
                                            echo "<option value=".$value->city_id." />".$value->city_name."</option>";
                                        }
                                        ?>
                                        </select>
                                        <input type="hidden" name="city" id="park_city_name">
                                    </div>
                                    
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">Area</label>
                                        <select id="park_area" class="col-md-12 form-control" name="area" ></select>     
                                    </div> 
                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i>  Search Business Parks</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="tab-pane fade in active" id="hoardingSection">
                            <form action="search/show" id="hoardingForm">
                                <div class="row">
                                    <input type="hidden" name="media_type" value="hoardings">
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">City</label>
                                        <select class="col-md-12 form-control city_name" name="city_val" id="hoarding_city">
                                        <option value="0">--Select City--</option>
                                        <?php
                                        foreach ($hoardings_city_list as $key => $value) {
                                            echo "<option value=".$value->city_id." />".$value->city_name."</option>";
                                        }
                                        ?>
                                        </select>
                                        <input type="hidden" name="city" id="hoarding_city_name">
                                    </div>
                                    
                                    <div class="col-md-4 text-left">
                                        <label class="col-md-12">Area</label>
                                        <select id="hoarding_area" class="col-md-12 form-control" name="area" ></select>     
                                    </div> 
                                    <div class="col-md-4">
                                        <label> &nbsp</label>
                                       <center class='center_search'><button class="button"><i class="fa fa-search fa-2" aria-hidden="true"></i> Search Hoardings</button></center>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-1 custom-padding">
                    <div class=" highlight-slider owl-carousel owl-theme owl-loaded" id="navID">
                        <div class="owl-stage-outer">
                          <!--  <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">                   
                                <div class="item active" id="apartment">                        
                                    <a href="#apartmentSection" class="icon" data-toggle="tab" aria-expanded="true">
                                    <img src="images/highlight-lodging.png">
                                    <div class="overlay">Apartments</div>
                                    </a>                  
                                </div>
                            </div>-->
                            <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">
                                <div class="item active" id="hoarding">                        
                                    <a href="#hoardingSection" class="icon" data-toggle="tab" aria-expanded="true">
                                   <img src="images/ireland.png">
                                    <div class="overlay">Hoardings</div>
                                     </a>                  
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">
                                <div class="item" id="park">
                        
                                    <a href="#parkSection" class="icon" data-toggle="tab" aria-expanded="true">
                                   <img src="images/garage.png">
                                    <div class="overlay text-center">Business Parks</div>
                                    </a>                  
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">
                                <div class="item" id="events">                        
                                          <a href="#eventSection" class="icon" data-toggle="tab" aria-expanded="true">
                                        <img src="images/calendar.png">
                                        <div class="overlay">Events & Exhibition</div>
                                        </a>                  
                                </div>
                            </div>    
                            <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">
                                <div class="item" id="malls">                        
                                    <a href="#mallSection" class="icon" data-toggle="tab" aria-expanded="true">
                                    <img src="images/category-icon07.png">
                                    <div class="overlay">Malls</div>
                                    </a>                  
                                </div>
                            </div> 
                            <div class="owl-item cloned" style="width: 150px; margin-right: 0px;">
                                <div class="item" id="radio">                        
                                    <a href="#radioSection" class="icon" data-toggle="tab" aria-expanded="true">
                                   <img src="images/radio-antenna.png">
                                    <div class="overlay">Radio</div>
                                    </a>                  
                                </div>
                            </div> 
                                             
                                                          
                            
                        </div>               
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
    <!-- /.container -->
</div>
 <!-- /.new slide page start -->



<div class="section light">
    <div class="inner">
        <div class="container">
            <h2 class="text-center">What are you interested in?</h2>
            <div class="row">                    
               <!--  <div class="col-md-4 col-sm-6">                         
                    <a href="<?php echo base_url().'search/show?media_type=apartments';?>" class="category-box"  style="background-image: url('images/apartment.png');">
                        <div class="inner">                                    
                           
                            <span class="number"><?php echo $options['active_apartments'];?></span>
                            <span class="title">Apartments</span>                                   
                        </div> 
                    </a>
                </div> -->   
                 <div class="col-md-4 col-sm-6">
                    <a href="<?php echo base_url().'search/show?media_type=hoardings';?>" class="category-box" style="background-image: url('images/hoarding.jpg');">
                        <div class="inner">
                           
                            <span class="number"><?php echo $options['active_hoarding'];?></span>
                            <span class="title">Hoarding</span>
                        </div> <!-- end .inner -->
                    </a> <!-- end .category-box -->
                </div> <!-- end .col-md-3 -->  
                <div class="col-md-4 col-sm-6">
                    <a href="<?php echo base_url().'search/show?media_type=parks';?>" class="category-box" style="background-image: url('images/park.jpg');">
                        <div class="inner">
                           
                            <span class="number"><?php echo $options['active_parks'];?></span>
                            <span class="title">Business park</span>
                        </div> <!-- end .inner -->
                    </a> <!-- end .category-box -->
                </div> <!-- end .col-md-3 -->
                        
                <div class="col-md-4 col-sm-6"> 
                    <a href="<?php echo base_url().'search/show?media_type=events';?>" class="category-box" style="background-image: url('images/event.jpg');">
                        <div class="inner">
                            
                            <span class="number"><?php echo $options['active_events'] ?></span>
                            <span class="title">Events & Exhibitions</span>
                        </div> <!-- end .inner -->
                    </a> <!-- end .category-box -->
                </div> <!-- end .col-md-3 -->
                 
            </div> <!-- end .row -->

            <div class="row col-md-12 col-md-offset-1 custom-padding">
           
                 <div class="col-md-5 col-sm-6">
                    <a href="<?php echo base_url().'search/show?media_type=malls';?>" class="category-box" style="background-image: url('images/background01.jpg');">
                        <div class="inner">
                            
                            <span class="number"><?php echo $options['active_mall']; ?></span>
                            <span class="title">Malls</span>
                        </div> <!-- end .inner -->
                    </a> <!-- end .category-box -->
                </div> <!-- end .col-md-3 -->
                 <div class="col-md-5 col-sm-6">
                    <a href="<?php echo base_url().'search/show?media_type=radios';?>" class="category-box" style="background-image: url('images/radio.jpg');">
                        <div class="inner">
                           
                            <span class="number"><?php echo $options['active_radio'];?></span>
                            <span class="title">Radio</span>
                        </div> <!-- end .inner -->
                    </a> <!-- end .category-box -->
                </div> <!-- end .col-sm-6 --> 
                <!-- end .text-center -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</div>
<div class="section light">
    <div class="inner">
        <div class="container">
            <h3 class="text-center" id="whatsmediabasket">About Us</h3>
            <p> We help advertisement buyers (marketing managers or agencies) in finding the right advertisement. Our aim is to bring new and innovative advertisement option along with the traditional offline and online options. This site is simplified as much as possible with accurate information on advertisement options. Also the availability and price of the options is mostly accurately as we update our system regularly by coordinating with the sellers
            We help advertisement owners (owners of the advertisement space or who got right to sell the space) in consolidating and showcasing their advertisement options to the right buyers in a structured manner. This will help any buyer to choose and decide on option faster. Media (advertisement) owners get access to manage their inventories on real time basis and that will be reflected on the site as per the updates. Advertisement owners can reach to more clients with the platform along with other benefits like managing orders, invoices etc.</p>
        </div>
    </div>
</div>
<div class="section light">
    <div class="inner">
        <div class="container">
           <h2 class="text-center">Recommended</h2>
                <legend>
                <ul id="navID" class="nav nav-pills nav-justified default-pills underlined">
              
                <!--    <li class="active1" id="apartment"  data-target="#myCarousel" data-slide-to="0" >
                        <a href="#apartmentSection" data-toggle="tab" aria-expanded="true">
                            <div>Apartments</div>
                        </a>
                    </li> -->
                     <li class="active" id="hoarding" data-target="#myCarousel" data-slide-to="0">
                        <a href="#hoardingSection1" data-toggle="tab" aria-expanded="true">
                            <div>Hoardings</div>
                        </a>
                    </li>
                     <li id="park" data-target="#myCarousel" data-slide-to="1">
                        <a href="#parkSection1" data-toggle="tab" aria-expanded="true">
                            <div>Business Parks</div>
                        </a>
                    </li>                   
                  
                    <li id="events" data-target="#myCarousel" data-slide-to="2">
                        <a href="#eventSection1" data-toggle="tab" aria-expanded="true">
                            <div>Events and Exhibition</div>
                        </a>
                    </li>
                                
                    <li id="malls" data-target="#myCarousel" data-slide-to="3">
                        <a href="#mallSection1" data-toggle="tab" aria-expanded="true">
                            <div>Malls</div>
                        </a>
                    </li>                                
                    <li id="radio" data-target="#myCarousel" data-slide-to="4">
                        <a href="#radioSection1" data-toggle="tab" aria-expanded="true">
                            <div>Radio</div>
                        </a>
                    </li>                    
                                    
                   
                   
                    </ul> 
        
    <!-- New All recomendded options Start


           
    <!-- Indicators --> 
     <div class="tab-content clearfix recommended_options">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">          
                    <div class="carousel-inner owl-stage">

                      <!--  <div class="item active1">
                            <div class="tab-pane active" id="apartmentSection1">       
                                <section class="container">
                                    <div class="row">
                                    <?php 
                                    if(is_array($recomanded['apartment']) && !empty($recomanded['apartment'])){
                                        
                                    }
                                    foreach ($recomanded['apartment'] as $key => $value) {
                                    ?>
                                
                                    <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img src="<?php echo asset_url().'uploads/apartments/'.$value->a_image; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'apartments/show/'.$value->a_id; ?>"><?php echo ucwords($value->a_name);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->a_cityname." - ".$value->a_area);?>
                                                         </div>
                                               </div> 
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                </section>

                            </div>   
                        </div>-->
                        <div class="item active">
                                 <div class="tab-pane" id="hoardingSection1">
                                   <section class="container">
                                   <div class="row">
                                        <?php
                                        if(is_array($recomanded['hoarding']) && !empty($recomanded['hoarding'])){
                                           
                                        }
                                        foreach ($recomanded['hoarding'] as $key => $value) {
                                            //print_r($value);
                                        ?>
                                        
                                             <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img  src="<?php echo asset_url().'uploads/hoarding_ads/'.$value->ref_image; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'hoarding_ads/show/'.$value->h_id; ?>"><?php echo ucwords($value->h_title);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->h_cityname." - ".$value->h_area);?> 
                                                        </div>
                                               </div> 
                                        </div>
                                    </div>
                                            
                                        <?php
                                        }
                                        ?>
                                        </div>
                                    </section>
                                </div>
                             </div>
                             <div class="item">
                                 <div class="tab-pane" id="parkSection1">
                                    <section class="container">
                                    <div class="row">
                                        <?php
                                        if(is_array($recomanded['park']) && !empty($recomanded['park'])){
                                           
                                        }
                                        foreach ($recomanded['park'] as $key => $value) {
                                            //print_r($value);
                                        ?>
                                        
                                        <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img  src="<?php echo asset_url().'uploads/parks/'.$value->park_image; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'parks/show/'.$value->park_id; ?>"><?php echo ucwords($value->park_name);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->park_cityname." - ".$value->park_area);?> 
                                                        </div>
                                               </div> 
                                        </div>
                                    </div>
                                           

                                        <?php
                                        }
                                        ?>
                                        </div>
                                    </section>
                                </div>
                             </div>
                            <div class="item">
                                <div class="tab-pane" id="eventSection1">
                                  <section class="container">
                                  <div class="row">
                                    <?php 
                                    if(is_array($recomanded['event']) && !empty($recomanded['event'])){
                                       
                                    }
                                    foreach ($recomanded['event'] as $key => $value) {
                                    ?>
                                    
                                    <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img  src="<?php echo asset_url().'uploads/events/'.$value->event_image; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'events/show/'.$value->event_id; ?>"><?php echo ucwords($value->event_name);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->event_cityname." - ".$value->event_area);?>
                                                         </div>
                                               </div> 
                                        </div>
                                    </div>
                                     
                                    <?php
                                    }
                                    ?>
                                    </div>
                                 </section>
                              </div>
                            </div>
                            <div class="item">
                                <div class="tab-pane" id="mallSection1">
                                    <section class="container">
                                    <div class="row">
                                    <?php 
                                    if(is_array($recomanded['mall']) && !empty($recomanded['mall'])){
                                       
                                    }
                                    foreach ($recomanded['mall'] as $key => $value) {
                                        //print_r($value);
                                    ?>
                                    
                                     <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img  src="<?php echo asset_url().'uploads/malls/'.$value->img_name; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'malls/show/'.$value->mall_id; ?>"><?php echo ucwords($value->mall_name);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->city_name." - ".$value->mall_area);?>
                                                         </div>
                                               </div> 
                                        </div>
                                    </div>
                                     
                                   <!--     <div class="col-md-3 col-sm-3">
                                         <div class="thumbnail">
                                            <a href="<?php echo base_url().'malls/show/'.$value->mall_id; ?>"><img class='options_img' src="<?php echo asset_url().'uploads/malls/'.$value->img_name; ?>">
                                             <div class="desc">
                                                <br>
                                                <h4><?php echo ucwords($value->mall_name);?></h4> 
                                             </div>
                                            </a>
                                                <h5><?php echo ucwords($value->city_name." - ".$value->mall_area);?></h5>
                                        </div>
                                        </div>-->
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    </section>
                                </div>
                            </div>
                             <div class="item">
                                <div class="tab-pane" id="radioSection1">
                                   <section class="container">
                                   <div class="row">
                                        <?php
                                        if(is_array($recomanded['radio']) && !empty($recomanded['radio'])){
                                            
                                        }
                                        foreach ($recomanded['radio'] as $key => $value) {
                                            //print_r($value);
                                        ?>
                                            
                                            <div class="col-lg-4 ">      
                                        <div class="directory-item maxheight-lg-4">
                                                    <img  src="<?php echo asset_url().'uploads/radios/'.$value->r_image; ?>" alt="bg" class="img-responsive">
                                                <div class="overlay"></div> 
                                                <div class="content">
                                                        <h3><a href="<?php echo base_url().'radio/show/'.$value->radio_station_id; ?>"><?php echo ucwords($value->radio_station_name);?> </a></h3>
                                                        <div class="location"><img src="images/directory-location.png" alt="location"><?php echo ucwords($value->radio_station_city);?>                                                </div>
                                               </div> 
                                        </div>
                                    </div>
                                           
                                        <?php
                                        }
                                        ?>
                                        </div>
                                   </section>
                                </div>
                            </div>
                            
                             
     <!--  <a class="left carousel-control" href="#myCarousel" data-slide="prev" >
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section light">
    <div class="inner">
        <div class="container">
            <h2 class="text-center">Numbers we love to share</h2>
        </div>
          <div class="main-content" id="transparent_back_img">
            <div class="row count_divs">
                <div class="col-md-12">    
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <?php 
                         (is_array($new['owner_details']) && !empty($new['owner_details'])) 
                         ?>
                            <div id="shiva"><span class="count"><?php echo $new['owner_details'] ?></span> + Owner</div>
                        </div>
                  
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                         <?php 
                         (is_array($new['buyer_details']) && !empty($new['buyer_details']))
                          ?>
                            <div id="shiva"><span class="count"><?php echo $new['buyer_details'] ?></span> + Buyer</div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                       
                       <?php 
                         (is_array($new['enquiries']) && !empty($new['enquiries']))
                          ?>
                          
                            <div id="shiva"><span class="count"><?php echo $new['enquiries'] ?></span> + Enqueries</div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <?php 
                          $count=/*$options['apartment_ads']+*/$options['business_park_ads']+$options['event_ads']+$options['hoarding_ads']+$options['radio_ads']+$options['mall_ads'];
                          ?>
                            <div id="shiva"><span class="count"><?php echo $count ?></span> + Options</div>
                        </div>
           </div>            
        </div>
    </div>
    </div>

<!--complete a new design start from here -->
           <div class="section light transparent" style="background-image: url(&#39;images/background02.jpg&#39;);">
            <div class="inner">
                <div class="container">
                    <h2 class="text-center">How it Works<small>Discover how Media Basket can you help you to grow your business.</small></h2>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="services">
                                <img src="images/search1.png" alt="icon" class="img-responsive center-block">
                                <h3>Search Media Option</h3>
                              
                            </div> <!-- end .services -->
                        </div> <!-- end .col-sm-4 -->
                        <div class="col-sm-3">
                            <div class="services">
                                <img src="images/005-send.png" alt="icon" class="img-responsive center-block">
                                <h3>Send<br>Enquiries</h3>
                                
                               
                            </div> <!-- end .services -->
                        </div> <!-- end .col-sm-4 -->
                        <div class="col-sm-3">
                            <div class="services">
                                <img src="images/online-shop.png" alt="icon" class="img-responsive center-block">
                                <h3> Get Best<br> Deals</h3>
                                
                               
                            </div> <!-- end .services -->
                        </div> <!-- end .col-sm-4 -->
                        <div class="col-sm-3">
                            <div class="services">
                                <img src="images/002-networking.png" alt="icon" class="img-responsive center-block">
                                <h3>Execution<br><br> </h3>                           
                               
                            </div> <!-- end .services -->
                        </div> <!-- end .col-sm-4 -->
                    </div> <!-- end .row -->
                </div> <!-- end .container -->
            </div> <!-- end .inner -->
        </div> <!-- end .section -->
<body>