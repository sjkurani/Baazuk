
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

<div class="container jumbotron" id="enquiry">

                <form id="contact" action="#" method="post" class="">
                    <center> <h3>Enquiry Form</h3></center>
                    
                    <fieldset>
                        <label for="type">Name</label>
                        <input placeholder="Your name" class="form-control" type="text" id="1" required="" autofocus="">
                    </fieldset>
                        
                    <fieldset>
                        <label for="type" >Email</label>
                        <input placeholder="Your Email Address"  class="form-control" type="email" id="2" required="">
                    </fieldset>
                    <fieldset>
                        <label for="type">Phone Number</label>
                        <input placeholder="Your Phone Number" class="form-control" type="tel" id="3" required="">
                    </fieldset>
                    <fieldset>
                        <label for="type">Type</label>

                        <select id="type" class="form-control" name="type" col="10" row="10">
                            <option value="type1">Media Mall</option>
                            <option value="type1">Events</option>
                            <option value="type2">Advertising</option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="type" style="color:black">Subject</label>
                        <textarea placeholder="Type your Message Here...." tabindex="5" required=""  class="form-control"></textarea>
                    </fieldset>
                    <fieldset><br>
                    <center>
                        <button name="submit" class="btn hoverable_btn" type="submit" color="teal" id="contact-submit" data-submit="...Sending">Submit</button>
                    </center>
                    </fieldset>
                </form>
              
         
</div>