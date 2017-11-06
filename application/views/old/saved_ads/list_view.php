<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<legend> <h2>Saved Ads</h2> </legend>

<div class="container">
  
  <table style="width:90%" class="table table-bordered table-striped">
  <tr>
  <?php 
 
//  echo "<pre>";
//  print_r( $saved_ads);
 // echo "</pre>";
  ?>
  <thead class="thead-default">  
    <th>No</th>
	<th>Title</th>
    <th>Type</th> 
  </tr>
  </thead>
   <?php
   $count=0;
 /*  if(!empty($saved_ads['apartment'])) {
      foreach ($saved_ads['apartment'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."apartments/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

       } 
    }*/
    if(!empty($saved_ads['event'])) {

      foreach ($saved_ads['event'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."events/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

        } 
    } 

    if(!empty($saved_ads['hoarding'])) {
      foreach ($saved_ads['hoarding'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."hoarding_ads/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

        }
    }

    if(!empty($saved_ads['mall'])) {
   
      foreach ($saved_ads['mall'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."malls/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

        }  
    }
     

    if(!empty($saved_ads['park'])) {
      foreach ($saved_ads['park'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."parks/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

        } 
    } 

    if(!empty($saved_ads['radio'])) {
      foreach ($saved_ads['radio'] as $key => $value) {

        echo" <tr>
              <td>".++$count."</td>
              <td> <a href=".base_url()."radio/show/".$value->media_type_id."#readmore".$value->ad_id.">".$value->ad_title."</a></td>
                 
              <td> ".$value->ad_type." </td> 
             </tr>";

        } 
    } 

    if($count == 0) {
    	echo"<legend> No Ads Found Here.... </legend>";
    }

    ?>
  
 </table>
</div>