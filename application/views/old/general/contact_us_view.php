<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo form_open('account/signup','class=frm');

?>

<div class="row">
	<div class="col-sm-12 text-center"><legend>Contact Us</legend></div>
    <div class="col-sm-6">
    <div class="col-sm-12 address">
    <p><b>ONEMOVE Software Solutions LLP</b><br>1st B main, 2nd Phase, Banashankari, <br>3rd Stage,
	Bangalore-560085<br>
	E-mail: <a href="mailto:support@Orgbitor.com">support@Orgbitor.com</a><br>
	Mobile: +917899452456</p>
    </div>
     </div>
    <div class="col-sm-6">
   <div class="contact_us_input">
    <label>Your Name</label><i class="redstar">*</i>
    <input class="form-control  " type="text" name="text" value="" >
   </div>
   <div class="contact_us_input">
    <label>Your Email</label><i class="redstar">*</i>
    <input class="form-control " type="text" name="email" value="" >
   </div>
   <div class="contact_us_input">
    <label>Your Message</label><i class="redstar">*</i>
    <textarea class="form-control"></textarea>
   </div>
   <div>
   	<br>
   	<button type="submit" class="submit btn btn-info submit_btn">Submit</button>
     
    </div>
    
  </div>
</div>


</form>