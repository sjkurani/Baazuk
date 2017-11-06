<!--<?php
    $is_home = $this->router->fetch_class() === 'home' ? true : false;
    if($is_home) {
    ?>
    <section class="header fixed clearfix">
    <div class="left">
        <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/mediabasket02.png";?>" alt="ExploreCity" class="img-responsive"></a></div> 
        </div> 
        <div class="navigation clearfix right">
          <nav class="main-nav">
            <ul class="list-unstyled">
              <li class="menu-item">
                <a href="tel:9945831047"><i class="fa fa-phone-square fa-2"></i> +91-9945831047</a>
              </li>
              <li class="menu-item">
                <a href="<?php echo base_url().'#whatsmediabasket'; ?>">About us</a>
              </li>
              <?php
                  if($this->session->userdata('logged_in'))
                  {
                    echo '<li class="menu-item-has-children">
                    <a>'.strtoupper($this->session->userdata('user_name')).'</a><ul>
                    <li><a href='.base_url().'dashboard/>Dashboard</a></li>
                    <li><a href='.base_url().'users/profile/>Profile</a></li>
                    <li><a href='.base_url().'account/logout>Logout</a></li>'
                    ;
                  }
                  else{
                    echo '<a href='. base_url().'account/signin class="button login-open">Log In</a>';
                    echo '<a href='. base_url().'account/signup class="button border">Sign Up</a>';
                  }
              ?>
           </ul>
         </nav> 
          <a href="" class="responsive-menu-open"><i class="fa fa-bars"></i></a>
        </div> 
        <div class="right">
          <div class="navigation clearfix main-nav list-unstyled">
            <ul>
       <a href="" class="button border">Add Listing</a>
        <a href="" class="button login-open">Log In</a>

        
            </ul>
        </div>
    </div> 
    
</section>
    <?php
    }
    else {
        ?>
<nav class="navbar navbar-default" >
        <div class="container-fluid"  style="background: #172434;">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

        <div class="logo" style="padding: 15%;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/mediabasket02.png";?>" alt="ExploreCity" class="img-responsive"></a></div>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
             
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <nav class="main-nav" style="margin-right: 50px;">
            <ul class="list-unstyled">
            <li class="menu-item">
               <a href="tel:9945831047"><i class="fa fa-phone-square fa-2"></i> +91-9945831047</a>                          
            </li>
            <li class="menu-item">
                <a href="http://localhost/Public/digi/mbasket/#whatsmediabasket">About us</a>
                
            </li>

            <?php
              if($this->session->userdata('logged_in'))
              {
                echo '<li class="menu-item-has-children">
                <a>'.strtoupper($this->session->userdata('user_name')).'</a><ul>
                <li><a href='.base_url().'dashboard/>Dashboard</a></li>
                <li><a href='.base_url().'users/profile/>Profile</a></li>
                <li><a href='.base_url().'account/logout>Logout</a></li>'
                ;
              }
              else{
                echo '<a href='. base_url().'account/signin class="button login-open">Log In</a>';
                echo '<a href='. base_url().'account/signup class="button border">Sign Up</a>';
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>

<?php
    }
?>
   
    <div class="responsive-menu">
      <nav class="responsive-nav">
        
      </nav> 
    </div> -->
    <body>
    
    <nav class="navbar navbar-default" >
       <div class="container-fluid"  style="background: #172434;">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
       <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."images/mediabasket07.png";?>" alt="Media Basket" style="width: auto ; height:100px;" class="img-responsive"></a></div>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right"  style="margin-top:2em; padding:0.5em;">
           <!--<nav class="main-nav" style="margin-right: 50px;">
           <ul class="list-unstyled">-->
           <li class="menu-item">
              <a href="tel:9945831047"><i class="fa fa-phone-square fa-2"></i>  08073590048</a>                          
           </li>
           <li class="menu-item">
               <a href="<?php echo base_url().'#whatsmediabasket'; ?>">About us</a>    
           </li>
           <?php
             if($this->session->userdata('logged_in'))
             {
               echo '<li class="dropdown menu-item-has-children" style="background:#172434 !important;">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style="background: #172434 !important;" aria-expanded="false">'.strtoupper($this->session->userdata('user_name')).' <span class="caret"></span></a>
               <ul class="dropdown-menu" >
               <li><a href='.base_url().'dashboard/>Dashboard</a></li>
               <li><a href='.base_url().'users/profile/>Profile</a></li>
               <li><a href='.base_url().'account/logout>Logout</a></li> 
               </ul>
               </li>'
               ;
             }
             else{
               echo '<a href='.base_url().'account/signin class="button login-open" style="margin:0 24px !important;">Log In</a>';
               echo '<a href='.base_url().'account/signup class="button border" style="margin: 0 24px !important ;">Sign Up</a>';
             }
             ?>
           </ul>
         </div><!--/.nav-collapse -->
       </div><!--/.container-fluid -->
     </nav>

