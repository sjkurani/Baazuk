
<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//echo form_open_multipart(base_url().'search/show');
?>
<script>
function check() {
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
}
</script>

<div class="body">
    <div class="hero">
        <div class="jumbotron main-content">
            <h1 class="text-center">MediaBasket </h1>
            <p class="text-center">Small description about the mediabasket.</p>
            <div class="nav nav-tabs nav-justified">

                <div class="panel-body threepanel">
                    <div class="tab-content">
                        <section  class="tab-pane fade in active" id="media-mall">
                                <div class="row">
                                    <div class="text-center">
                                        
                                        <div class="panel-body">
                                            <div class="tab-content row">
                                                <section  class="tab-pane fade in active" id="media1">
                                                    <form action="<?php echo base_url().'search/show'?>?" method="get">
														<div class="col-md-4">
														    <label class="col-md-12 text-left">Media type *</label>
                                                            <select name="media_type" class="col-md-12 form-control" id="yesCheck" onchange="javascript:check()" >
                                                                <option value="apartments">Apartments</option>
																<option value="events">Events</option>
                                                                <option value="parks">Business Parks</option>
                                                                <option value="malls">Malls</option>
                                                                <option value="radios">Radios</option>
                                                                <option value="hoardings">Hoardings</option>
                                                            </select>
                                                        </div>
														<div class="col-md-4">
                                                            <label class="col-md-12 text-left">City *</label>
															<input type="text" class="col-md-12 form-control" name="city" required>        
                                                        </div>
														
                                                        <div class="col-md-4" id="ifYes" style="display:block">
                                                            <label class="col-md-12 text-left">Area *</label>
                                                            <input type="text" id="area" class="col-md-12 form-control" name="area" required>       
                                                        </div> 
														<div class="col-md-12">
														    <br>
                                                            <button type="submit" class="btn hoverable_btn" ><i class="fa fa-search fa-2"></i> &nbsp;&nbsp;&nbsp;Search &nbsp;&nbsp;&nbsp;</button>
                                                        </div>
                                                    </form>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
						</section>
                           <!-- <a href="#howmedia" class="pull-right" id="howmediabtn">How It Works</a>-->
                        
                    </div>
                </div>
            </div>
                            <!--<a href="#howadvertising" class="pull-right" id="howadvertisingbtn">How It Works</a>-->
         </div>
    </div>
</div>
      
    <!-- /.container -->
           
           

            

    </div>