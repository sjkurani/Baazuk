<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open_multipart(base_url().'owner/malls/add');

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
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div>
                <label>Mall Name</label>
                <input name="mall_name" class="form-control" type="text">
            </div>
            <div>
                <label>Mall Image</label>
                <input name="userfile" class="form-control" type="file">
            </div>
            <div>
                <label>Mall Description</label>
                <textarea name="mall_desc" class="form-control" rows="4" cols="50"></textarea>
            </div>
            <div>
                <label>Mall Area</label>
                <input name="mall_area" class="form-control" type="text" type="text" >
            </div>
			<div>
                <label>Mall Location</label>
                <input name="mall_loc" class="form-control" type="text" id="pac-input" type="text" placeholder="Enter a location">
            </div>
            <div id="map" style="height:400px;"></div>
            <div>
             <label>Latitude</label>   <input id="map_lat" name="map_lat" class="form-control" type="text">
             <label>longitude</label>   <input id="map_lang" name="map_lang" class="form-control" type="text">
            </div>
			
           <!-- <table id="address" style="width: 100%;">
      <tr>
        <td class="label hidden">Street address</td>
        <td class="slimField  hidden"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField hidden" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td>City</td>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
       <!-- <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true" class="form-control"></input></td>
      </tr>
      <tr>
        <td>State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label hidden">Zip code</td>
        <td class="wideField hidden"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td>Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
    </table>-->

            <div>
                <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</div>
