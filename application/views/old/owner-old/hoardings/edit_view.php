<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div>
                <label>Hoarding Title</label>
                <input name="hoarding_title" class="form-control" type="text">
            </div>
            <div>
                <label>Hoarding Specification</label>
                <input name="hoarding_spec" class="form-control" type="text">
            </div>
            <div>
                <label>Hoarding Location</label>
                <input name="hoarding_loc" class="form-control"> 
            </div>
            <div>
                <label>Hoarding Location Image</label>
                <input name="apartment_loc_img" class="form-control" type="file">
            </div>
            <div>
                <label>map lat</label>
                <input name="map_lat" class="form-control" type="hidden1">
            </div>
            <div>
                <label>map lang</label>
                <input name="map_lang" class="form-control" type="hidden1">
            </div>
        </div>
    </div>

    <div class="row1">
        <div class="col-md-3">
            <button type="button" class="btn btn-success btn-lg">Submit</button>
        </div>
    </div>
</div>