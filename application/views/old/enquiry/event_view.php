<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//echo form_open_multipart(base_url().'enquiry/send/');

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
<legend class="text-center"><h2>List of Event Enquiries</h2></legend>
                <div class="panel-body threepanel panel_lists">
                    <div class="tab-content">
                        <section  class="tab-pane fade in active" id="media-mall">
                                <div class="row">
                                    <div class="text-center">
                                        <ul class="nav nav-pills nav-justified underlined" >
                                                <li class=""><a href="<?php echo base_url()?>enquiries/" >Apartments</a></li>
                                                <li class="active"><a href="<?php echo base_url()?>enquiries/events" >Events</a></li>
                                                <li class=""><a href="<?php echo base_url()?>enquiries/malls" >Malls</a></li>
                                                <li class=""><a href="<?php echo base_url()?>enquiries/radios" >Radio</a></li>
                                                <li class=""><a href="<?php echo base_url()?>enquiries/parks" >Business Parks</a></li>
                                                <li class=""><a href="<?php echo base_url()?>enquiries/hoardings">Hoardings</a></li>
                                        </ul>
                                        <div class="panel-body">
                                            <div class="tab-content row">
                                               
                                                <section  class="tab-pane fade in active" id="media2">
                                                    <table class="example" class="display" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Enquiry No.</th>
                                                                <th>Ad Title</th>
                                                                <th>Media Title</th>
                                                                <th>User</th>
                                                                <th>Status</th>
                                                                <?php
                                                                if($user_type == 'admin') {
                                                                    echo "<th></th>";
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($enquiry_list['events'] as $key => $value) {
                                                               //print_r($value);
                                                                    $media_link = "<a href=".base_url()."events/show/".$value->event_id.">".$value->media_name."</a>";
                                                                    if($value->flag == 0) {
                                                                        $status = 'Followup';
                                                                    }
                                                                    elseif ($value->flag == 1) {
                                                                        $status = 'Enquiry';
                                                                    }
                                                                    elseif ($value->flag == 2) {
                                                                        $status = 'Cancelled';
                                                                    }
                                                                    elseif ($value->flag == 3) {
                                                                        $status = 'Closed';
                                                                    }

                                                                    //$status = ($value->flag) ? "Approved" : "Not Approved";
                                                                    $remarks=$value->remarks;

                                                                   
                                                                $admin_aprove_link = ($user_type == 'admin' && ($value->flag != 3)) ? '<td>
                                                                <a data-target="#popupmodal"  class="popup" id="'.$value->enquiry_id."-".$value->remarks.'" data-toggle="modal" href="#popupmodal."> Review </a></td>': '<td></td>';

                                                                    /*$admin_aprove_link= '<td><select> 
                                                                       <option value="enquiry">Enquiry</option>
                                                                       <option value="followup">Follow Up</option>
                                                                       <option value="closed"> Closed</option>
                                                                       <option value="Cancelled"> Cancelled</option>
                                                                       </select> </td>';*/
                                                                   
                                                                    echo "<tr><td>".$value->enquiry_id."</td><td><b>".$value->ad_title."</b></td><td>".$media_link."</td><td><b>".$value->user_name." - ".$value->user_id."</b></td><td><b>".$status."</b></td>".$admin_aprove_link."</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </section>
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        

                                                
                                            </div>
                                        </div>
                                </div>
                           
                        </section>
                    </div>
                </div>
</div>

    <div id="popupmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Review and submit enquiry status.</h4>
                </div>
                <div class="modal-body row">
                    <form action="<?php echo base_url().'enquiries/review'; ?>" method="post">
                    <input type="text" name="enquiry_id" id="enquiry_id" class="hidden">
                    <div class="col-lg-12">
                        <label class="col-lg-12">Enquiry ID : <span id="enquiry_id_text"></span></label>
                        <label class="col-lg-6">Status : 
                        <select name="status" class="form-control col-lg-3">
                            <option value="0">Follow up</option>
                            <option value="1">Enquiry</option>
                            <option value="2">Cancelled</option>
                            <option value="3">Closed</option>
                        </select>
                        </label>
                        <div class="col-lg-6">
                            <label>Remarks :
                                <input  id="remarks" name="remarks" autofocus="true" required="" class="form-control col-lg-12"/>
                            
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <input type="submit" name="submitbtn" value="Submit" class="btn hoverable_btn">
                    </div>

                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">close</button>
                </div>
            </div>

        </div>
    </div>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="
https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var full_url = "<?php echo base_url();?>reports/event_ajax_list";
    $('.example').DataTable( {
        dom: 'Blfrtip',
        bFilter: true, //Removes search box.
        buttons: [
            'copy',  'excel', 'pdf', 'print'
        ],

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
});
</script>