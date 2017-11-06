$(document).ready(function() {
	
    $(".post_details .link_select_active").addClass("hidden");
	/*for (i = new Date().getFullYear(); i > 1900; i--)
	{
	    $(".year_selector").append($('<option />').val(i).html(i));
	}*/
//set focus to post id

$("#text_ab_ac_num").focus(function(){
    $("#link_ab_ac_num").focus();
    $(".post_details").removeClass("hidden");
    $(".post_details .link_select_active").removeClass('hidden');
    $(".post_details .link_text_active").addClass("hidden");
    //$(".link_text_active").css("display":"none");
});
$("#link_ab_ac_num").change(function () {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_ac_location?ac_num=" + $(this).val(),
            async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
                $("input[name='link_location'").val(data);
                $("#link_cadre").focus();
                //$("input[name='location'").focus();
            },
            error: function(xhr, textStatus, error){
             
          }                                            
        });
});


$("#link_cadre").focus(function () {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_all_cadre?ac_num=" + $("#link_ab_ac_num").val(),
            async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {

                parsed_json_array = $.parseJSON(data);
                if(parsed_json_array) {
                    $('#link_cadre').find('option').remove().end();
                    var str1 = "<option value=0>--Select--</option>";
                    var str;
                    $.each( parsed_json_array, function( key, value ) {
                         str += "<option value = "+value.cadre_id+">"+value.cadre_name+"</option>";
                    });
                    $("#link_cadre").append(str1 + str);
                }
                else {
                    $('#link_cadre').find('option').remove().end();
                    var str1 = "<option value=0>--Select--</option>";
                    $("#link_cadre").append(str1);
                }
            },
            error: function(xhr, textStatus, error){
             
          }                                            
        });
});

$("#link_cadre").change(function () {
    $.ajax({
  method: "POST",
  url: base_url+"ajax/get_all_post_subjects",
  data: { cadre_id: $(this).val(), ac_num: $("#link_ab_ac_num").val() }
})
  .done(function( data ) {
  
    parsed_json_array = $.parseJSON(data);
    if(parsed_json_array) {
        $('#link_post_subject').find('option').remove().end();
        var str1 = "<option value=0>--Select--</option>";
        var str;
        $.each( parsed_json_array, function( key, value ) {
             str += "<option value = "+value.post_sub_id+">"+value.post_subject+"</option>";
        });
        $("#link_post_subject").append(str1 + str);
    }
  });

/*    var s = base_url+"ajax/get_all_post_subjects?cadre_id=" + $(this).val()+"/ac_num ="+$("#link_ab_ac_num").val();
          $.ajax({
            type: "GET",
            url: base_url+"ajax/get_all_post_subjects?" + $(this).val()+"/"+$("#link_ab_ac_num").val(),
            async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
               
            },
            error: function(xhr, textStatus, error){
             
          }                                        
        });*/
});
$("#link_post_subject").change(function () 
    $.ajax({
  method: "POST",
  url: base_url+"ajax/get_all_post_names",
  data: { cadre_id: $("#link_cadre").val(), ac_num: $("#link_ab_ac_num").val(), post_sub_id: $(this).val() }
})
  .done(function( data ) {
    parsed_json_array = $.parseJSON(data);
    if(parsed_json_array) {
        $('#link_post_name').find('option').remove().end();
        var str1 = "<option value=0>--Select--</option>";
        var str;
        $.each( parsed_json_array, function( key, value ) {
             str += "<option value = "+value.post_id+">"+value.post_name+"("+value.post_id+")</option>";
        });
        $("#link_post_name").append(str1 + str);
    }
  });
});

$("#link_post_name").change(function () {
    if($(this).val() != 0){
        $("#post_id").val($(this).val());        
    }

});
//Teaching or non - teaching hide and show
nature_of_work();
$("#inc_nature_of_work").change(function(){
	nature_of_work();
})
function nature_of_work() {
	if(($("#inc_nature_of_work").val() == 'teaching') || ($("#inc_nature_of_work").val() == 'administration')) {
		$(".non-teaching").hide();
		$(".teaching").show();
	}
	else {
		$(".non-teaching").show();
		$(".teaching").hide();
	}
}

//Hiding all the default hidable fields

$(".deafult_hide").hide();

$('input[name=asst_prof_sr_scale]').change(function(){
	if($(this).val() == 'no') {
		$("input[name='asst_prof_sr_scale_date']").hide();
	}
	else {
		$("input[name='asst_prof_sr_scale_date']").show();

	}
});


$('input[name=asst_prof_sel_scale]').change(function(){
	if($(this).val() == 'no') {
		$("input[name='asst_prof_sel_grade_date']").hide();
	}
	else {
		$("input[name='asst_prof_sel_grade_date']").show();

	}
});

//hide or show of modes for teaching
 var p_flag = 0, r_flag = 0;
$(".mode").change(function(){

var myArray = ["", "INSTRUCTOR", "ASST.PROFESSOR", "ASSOC.PROFESSOR", "PROFESSOR"];
	if($(this).val() == "promoted") {
		$(this).parent().next('.mode_promote').show();
		$(this).parent().next().next('.mode_recruite').hide();
        var partType = $(this).closest('div.partType').find('span.name').text();
        if(p_flag < partType) {
            p_flag = partType;
        }
        $("input[name='inc_designation']").val(myArray[p_flag]);
	}
	else if($(this).val() == "recruited") {
		$(this).parent().next('.mode_promote').hide();
		$(this).parent().next().next('.mode_recruite').show();
        var partType = $(this).closest('div.partType').find('span.name').text();
       
        if(r_flag < partType) {
            r_flag = partType;
        }
        $("input[name='inc_post_held']").val(myArray[r_flag]);
	}
    else {

    }
})
$(function() {
    $("input[name='post_id'").autocomplete({
    source: base_url+"ajax/get_post_id",
        autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_post_full_details?post_id="+ui.item.value,
        	async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
            	parsed_json_array = $.parseJSON(data);
            	$("#post_origin").val(parsed_json_array.post_origin);
            	$("input[name='ab_ac_num']").val(parsed_json_array.abstract_num);
            	$("input[name='location']").val(parsed_json_array.ab_location);
            	$("input[name='post_name']").val(parsed_json_array.post_name);
            	$("input[name='cadre']").val(parsed_json_array.cadre_name);
            	$("input[name='post_code']").val(parsed_json_array.cadre_post_code);
            	$("#post_category").val(parsed_json_array.category);
            	$("#post_activity").val(parsed_json_array.activity);
            	$("input[name='post_subject']").val(parsed_json_array.post_subject);
            	$("input[name='post_subject_code']").val(parsed_json_array.post_sub_id);
            	$("input[name='faculty']").val(parsed_json_array.faculty);
            	$("input[name='pay_scale']").val(parsed_json_array.post_pay_scale);
            	$("#post_group").val(parsed_json_array.post_group);
            	$("input[name='creation_order']").val(parsed_json_array.creation_order);
            	var new_date_array = parsed_json_array.creation_order_date.split('-');
				$("input[name='creation_order_date']").val(new_date_array[2] +'-'+ new_date_array [1] +'-'+ new_date_array[0]);
            	$("#remarks1").val(parsed_json_array.remarks1);
            	$("#remarks2").val(parsed_json_array.remarks2);
            	$("#hidden_field_1").val(parsed_json_array.post_id);
            	//$("input[name='submitForm']").val("Update");
            	
            	//$("input[name='location'").focus();
            },
	        error: function(xhr, textStatus, error){
             
          }                                            
        });
      },
    });
});

$(function() {
    $("input[name='ab_ac_num'").autocomplete({
    source: base_url+"ajax/abstract_num",
        autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_ac_location?ac_num="+ui.item.value,
        	async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
            	$("input[name='location'").val(data);
            	//$("input[name='location'").focus();
            },
	        error: function(xhr, textStatus, error){
             
          }                                            
        });
      },
    });
});


$(function() {
	$("input[name='post_name'").autocomplete({
    source: base_url+"ajax/post_name",
        autoFocus:true
    });
});

$(function() {
	$("input[name='inc_frm_post_name'").autocomplete({
    source: base_url+"ajax/filtered_post_name",
        autoFocus:true
    });
});

$(function() {
    $("input[name='cadre']").autocomplete({
    source: base_url+"ajax/cadre",
        autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_cadre_details?cadre_name='"+ui.item.value+"'",
        	async:false,
            success: function (data) {
            	parsed_json_array = $.parseJSON(data);
            	$("#post_group").val(parsed_json_array.cadre_group);
            	$("input[name='post_code']").val(parsed_json_array.cadre_post_code);
            	$("input[name='pay_scale']").val(parsed_json_array.cadre_payscale);
            	
            },
	        error: function(xhr, textStatus, error){
              
          }                                            
        });
      },
    });
});

$(function() {
    $("input[name='specialization']").autocomplete({
    source: base_url+"ajax/get_subject",
        autoFocus:true
    })
});
$(function() {
    $("input[name='post_subject'").autocomplete({
    source: base_url+"ajax/get_subject",
        autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_sub_code?sub_name="+encodeURIComponent(ui.item.value), //To send & with get parameter.
        	async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
            	$("input[name='post_subject_code'").val(data);
            	//$("input[name='post_subject_code'").focus();
            },
	        error: function(xhr, textStatus, error){
             
          }                                            
        });
      },
    });
});

$(function() {
    $("input[name='faculty'").autocomplete({
    source: base_url+"ajax/get_faculty",
    autoFocus:true
    });
});

$(function() {
    $("input[name='link_emp_id'").autocomplete({
    source: base_url+"ajax/get_inc_id",
    autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_inc_link_details?inc_id="+ ui.item.value,
            //url: base_url+"ajax/get_inc_link_details/inc_id="+ui.item.value,
        	async:false,
            success: function (data) {
            	parsed_json_array = $.parseJSON(data);
                if(parsed_json_array.post_id) {
                    $("input[name='link_post_id']").val(parsed_json_array.post_id);
                }
                if(parsed_json_array.abstract_num) {
                    $("#link_ab_ac_num").val(parsed_json_array.abstract_num);
                }
                if(parsed_json_array.post_name) {
                    $("#link_post_name").val(parsed_json_array.post_name);
                }
                if(parsed_json_array.ab_location) {
                    $("#link_location").val(parsed_json_array.ab_location);
                }
                if(parsed_json_array.post_subject) {
                    $("#link_post_subject").text(parsed_json_array.post_subject);
                    $("#link_post_subject").val(parsed_json_array.post_subject);
                }
                if(parsed_json_array.work_location) {
                    $("input[name='work_location']").val(parsed_json_array.work_location);
                }
                //Employee
                if(parsed_json_array.emp_id) {
                    $("input[name='link_emp_id']").val(parsed_json_array.emp_id);
                }
                if(parsed_json_array.emp_name) {
                    $("input[name='inc_name']").val(parsed_json_array.emp_name);
                }
                if(parsed_json_array.orignial_post_held) {
                    $("input[name='inc_post_held']").val(parsed_json_array.orignial_post_held);
                }
                if(parsed_json_array.present_designation) {
                    $("input[name='inc_designation']").val(parsed_json_array.present_designation);
                }
                if(parsed_json_array.final_specialisation) {
                    $("input[name='inc_final_spec']").val(parsed_json_array.final_specialisation);
                }
                if(parsed_json_array.remarks) {
                    $("#link_remarks").val(parsed_json_array.remarks);
                }
/*                if((parsed_json_array.emp_id) && (parsed_json_array.post_id) ) {
                    $('#submit_btn').prop('disabled', true);
                    $('#delete_btn').prop('disabled', false);

                }
                else {
                    $('#submit_btn').prop('disabled', false);
                    $('#delete_btn').prop('disabled', true);
                }*/
            },
	        error: function(xhr, textStatus, error){
            
          }                                            
        });
        }
    });
});


$(function() {
    $("input[name='link_post_id'").autocomplete({
    source: base_url+"ajax/get_post_id",
    autoFocus:true,
      select: function( event, ui ) {
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_full_link_data/"+ui.item.value+"/0",
        	async:false,
            success: function (data) {
                parsed_json_array = $.parseJSON(data);
                if(parsed_json_array.post_id) {
                    $("input[name='link_post_id']").val(parsed_json_array.post_id);
                }
                if(parsed_json_array.abstract_num) {
                    $("input[name='ab_ac_num']").val(parsed_json_array.abstract_num);
                }
                if(parsed_json_array.post_name) {
                    $("input[name='post_name']").val(parsed_json_array.post_name);
                }
                if(parsed_json_array.ab_location) {
                    $("input[name='location']").val(parsed_json_array.ab_location);
                }
                if(parsed_json_array.post_subject) {
                    $("input[name='post_subject']").val(parsed_json_array.post_subject);
                }
                if(parsed_json_array.work_location) {
                    $("input[name='work_location']").val(parsed_json_array.work_location);
                }
                //Employee
                if(parsed_json_array.emp_id) {
                    $("input[name='link_emp_id']").val(parsed_json_array.emp_id);
                }
                if(parsed_json_array.emp_name) {
                    $("input[name='inc_name']").val(parsed_json_array.emp_name);
                }
                if(parsed_json_array.orignial_post_held) {
                    $("input[name='inc_post_held']").val(parsed_json_array.orignial_post_held);
                }
                if(parsed_json_array.present_designation) {
                    $("input[name='inc_designation']").val(parsed_json_array.present_designation);
                }
                if(parsed_json_array.final_specialisation) {
                    $("input[name='inc_final_spec']").val(parsed_json_array.final_specialisation);
                }
                if(parsed_json_array.remarks) {
                    $("#link_remarks").val(parsed_json_array.remarks);
                }
                if((parsed_json_array.emp_id) && (parsed_json_array.post_id) ) {
                   /* $('#submit_btn').prop('disabled', true);
                    $('#delete_btn').prop('disabled', false);*/
                }
                else {/*
                    $('#submit_btn').prop('disabled', false);
                    $('#delete_btn').prop('disabled', true);*/
                }
            },
	        error: function(xhr, textStatus, error){
             
          }                                            
        });
        }
    });
});

$(function() {
	var url = base_url+"post/form2/";
    $("input[name='inc_emp_id'").autocomplete({
    source: base_url+"ajax/get_inc_id",
        autoFocus:true,
      select: function( event, ui ) {

      	window.open(url+ui.item.value, '_self');
            $.ajax({
            type: "GET",
            url: base_url+"ajax/get_inc_full_details?inc_id="+ui.item.value,
        	async:false,
            //data:'{ac_num: "' + ui.item.value  + '"}',
            success: function (data) {
            	parsed_json_array = $.parseJSON(data);
            	$("input[name='inc_name']").val(parsed_json_array.emp_name);
            	var new_date_array = parsed_json_array.dob.split('-');
				$("input[name='inc_dob']").val(new_date_array[2] +'-'+ new_date_array [1] +'-'+ new_date_array[0]);

            	$("#gender").val(parsed_json_array.gender);
            	$("#applicant_cat").val(parsed_json_array.category);
            	$("#inc_nature_of_work").val(parsed_json_array.nature_of_work);

            	$("input[name='inc_religion']").val(parsed_json_array.religion);
            	$("input[name='inc_caste']").val(parsed_json_array.caste);
            	$("input[name='inc_designation']").val(parsed_json_array.present_designation);
            	$("input[name='inc_post_held']").val(parsed_json_array.orignial_post_held);
            	$("input[name='inc_pay_scale']").val(parsed_json_array.pay_scale);
            	$("input[name='inc_group']").val(parsed_json_array.inc_group);
            	$("input[name='inc_final_spec']").val(parsed_json_array.final_specialisation);
            	$("input[name='in_tel_office']").val(parsed_json_array.tel_office);
            	$("input[name='inc_tel_res']").val(parsed_json_array.tel_res);
            	$("input[name='inc_cell']").val(parsed_json_array.inc_cell);
            	$("input[name='inc_email']").val(parsed_json_array.inc_email);
            	//$("input[name='submitForm']").val("Update");
            	
            	//$("input[name='location'").focus();
            },
	        error: function(xhr, textStatus, error){
             
          }                                            
        });
        }
    });
});
$(".form_datetime").datepicker({ 
	    dateFormat: 'dd-mm-yy',
        endDate: '+1d',
	    autoclose: true,
  		changeYear: true,
  		changeMonth: true
});
/*$("input[name='designation']").blur(function(){
	if($(this).val() == 'professor' || $(this).val() == 'assoc prof' || $(this).val() == 'assistant professor') {
		$("input[name='category']").val("Teaching");
		//Show only teaching div
		$('.teach').show();
		$('.comman_tech').show();
		$('.non_teach').hide();
	}
	else {
		$("input[name='category']").val("Non - Teaching");
		//Show only Non Teaching div
		$('.non_teach').show();
		$('.comman_tech').show();
		$('.teach').hide();
	}
})
*/
	//Function to hide or show disability after click
	$(".spl_cat").click(function(){
		if(($(this).val() == "physically challenged") && ($(this).is(':checked'))) {
			$("#disability_type_div").removeClass('force_hidden');
		}
		else if(($(this).val() == "physically challenged") && (!$(this).is(':checked'))) {
		$("#disability_type_div").addClass('force_hidden');
		}
		if(($(this).val() == "hyderabad karnataka") && ($(this).is(':checked'))) {
			$("#hk_div").removeClass('force_hidden');
		}
		else if(($(this).val() == "hyderabad karnataka") && (!$(this).is(':checked'))) {
		$("#hk_div").addClass('force_hidden');
		}
	});
		if(($('.spl_cat').val() == "physically challenged") && ($(this).is(':checked'))) {
			$("#disability_type_div").show(100);
		}
		else if(($('.spl_cat').val() == "physically challenged") && (!$(this).is(':checked'))) {
		$("#disability_type_div").hide(100);	
		}
		if(($('.spl_cat').val() == "hyderabad karnataka") && ($(this).is(':checked'))) {
			$("#hk_div").show(100);
		}
		else if(($('.spl_cat').val() == "hyderabad karnataka") && (!$(this).is(':checked'))) {
			$("#hk_div").hide(100);
		}

//mode for teaching
	$(function() {
	$(".teach_mode").autocomplete({
    source: base_url+"ajax/post_name",
        autoFocus:true
    });
});



//unwanted

if($("input[name='employed']:checked").val() !== undefined) {
				if($("input[name='employed']:checked").val() == "private") {

				$("#fianl_govt_nature_emp").hide();
				$("#fianl_uasd_nature_emp").hide();
				$("#govt_present_basic_pay").hide();
			}
			else if($("input[name='employed']:checked").val() == "govt") {
				$("#govt_present_basic_pay").show();
				$("#fianl_uasd_nature_emp").hide();
				$("#fianl_govt_nature_emp").show();
			}
			else if($("input[name='employed']:checked").val() == "uasd") {
				$("#fianl_govt_nature_emp").hide();
				$("#govt_present_basic_pay").show();
				$("#fianl_uasd_nature_emp").show();
			}
}
//alert($('input[name="employed"]:checked").val()').val());

//uppercase of inputs.
		$('.upper_fields').keyup(function(){
		
			$(this).val (function () {
		    	return this.value.toUpperCase();
			})	
		})

		$("#applicant_cat").change(function(){
		if(($(this).val()=="sc") || ($(this).val()=="st") ) {
			$("#application_processing_fee").val('350');
		}
		else if($(this).val()== 0 ){
			$("#application_processing_fee").val('');
		}
		else {
		$("#application_processing_fee").val('650');	
		}
	});
	$(".close").click(function(){
		$(".error_msgs").hide(300);
	});

	$('input[name=are_u_employed]').change(function(){
		if($(this).val() == 'no') {
			$("#employed").hide(200);
			
		}
		else {
		$("#employed").show(200);	
			$("#private_office_details").show(200);
		}
	});

/*	$('input[name=employed]').change(function(){
		if($(this).val() == 'govt') {
			$("#private_office_details").show(200);
		}
		else {
		$("#private_office_details").hide(200);	
		}
	});*/
		$("#bachelor_degree").click(function(){
			//alert($("option:selected",this).val())
			bachelor_specify_degree();
		});
		$("#master_degree").click(function(){
			master_specify_degree();
/*			if($("option:selected",this).val() == "Others") {
			$("#other_master_degree").show('slow');
			}
			else {
			$("#other_master_degree").hide();
			}*/
		});

		$("#applied_post").change(function(){
			hide_show();
		});
		$("#gender").change(function(){
			tick_women();
		});

			if($("input[name='aggregate_b']:checked").val() == "grade") {
			$('input[name="bachelor_aggregate"]').val('');
			$('input[name="bachelor_aggregate"]').attr("readonly",false);
			}
			else {
			//$('input[name="bachelor_aggregate"]').val('');
			$('input[name="bachelor_aggregate"]').attr("readonly",true);
			}

			if($("input[name='are_u_employed']:checked").val() == "yes") {
			$("#employed").show();
			$("#private_office_details").show();
			}
			else {
			$("#employed").hide();
			}
		//SSLC Percentage calculate

		$('input[name="sslc_total_marks"]').blur(function(){
			//alert(parseInt($(this).val()));
			if(parseInt($(this).val()) > parseInt($('input[name="sslc_marks_scored"]').val())) {
			$("#sslc_max_min").html("Total marks scored value should be less than Maximum marks value");
				$(this).val('');
				$(this).focus();
			}
			else {
				$("#sslc_max_min").html("");
			}
			var max_marks = $('input[name="sslc_marks_scored"]').val();
			var aggregate = parseInt($(this).val()) * 100 / parseInt(max_marks);
			aggregate = aggregate || 0 ;
			////$('input[name="sslc_percentage"]').val(aggregate);
			//alert('s')
			$('input[name="sslc_percentage"]').val(aggregate.toFixed(2));
		});
		//Puc Percentage calculate

		$('input[name="puc_total_marks"]').blur(function(){
			if(parseInt($(this).val()) > parseInt($('input[name="puc_marks_scored"]').val())) {
			$("#puc_max_min").html("Total marks scored value should be less than Maximum marks value");
				$(this).val('');
				$(this).focus();
			}
			else {
				$("#puc_max_min").html("");
			}
			var max_marks = $('input[name="puc_marks_scored"]').val();
			var aggregate = $(this).val() * 100 / max_marks;
			aggregate = aggregate || 0 ;

			$('input[name="puc_percentage"]').val(aggregate.toFixed(2));
		});

		//Bachelor aggrigate
		$('input[name="bachelor_total_marks"]').blur(function(){
			//alert($(this).val());
			if($("input[name='aggregate_b']:checked").val() == "marks") {
			if(parseInt($(this).val()) > parseInt($('input[name="bachelor_marks_scored"]').val())) {
			$("#bachelor_max_min").html("Total marks scored value should be less than Maximum marks value");
				$(this).val('');
				$(this).focus();
			}
			else {
				$("#sslc_max_min").html("");
			}

			var max_marks = $('input[name="bachelor_marks_scored"]').val();
			var aggregate = $(this).val() * 100 / max_marks;
			aggregate = aggregate || 0 ;

			//alert(aggregate);
			$('input[name="bachelor_aggregate"]').val(aggregate.toFixed(2));
			$('input[name="bachelor_aggregate"]').attr("readonly",true);
			} 
			else {
			$('input[name="bachelor_aggregate"]').val('');
			$('input[name="bachelor_aggregate"]').attr("readonly",false);
			}
/*			if($("input[name="aggregate_b"]").prop("checked") == true) {
				//alert($(this).val());
			}
			else {
			alert($(this).val());
			alert("else");
			}*/
/*		if($('input[name="aggregate_b"]').val() == "marks") {
			var max_marks = $('input[name="bachelor_marks_scored"]').val();
			var aggregate = $(this).val() * 100 / max_marks;
			//alert(aggregate);
			$('input[name="bachelor_aggregate"]').val(aggregate);
			$('input[name="bachelor_aggregate"]').attr("readonly",true);
		}
	else {
		alert('ss');
	}*/
		});
	
		/*$(".bachelor_text").focus(function(){
			$("#bachelor_note").show();
		});*/
		/*$(".master_text").focus(function(){
			$("#master_note").show();
		});*/
		$('input[name="master_grade_point"]').click(function(){
			if($(this).val() == "yes") {
				$("#master_grade").show();
				$('input[name="master_aggregate"]').focus();
			}
		});
		$('input[name="aggregate_b"]').click(function(){
			if($(this).val() == "grade") {
				$("#bachelor_grade").show();
				$("#bachelor_aggrigate_warn").hide();
				//$('input[name="bachelor_aggregate"]').focus();
				$(".grade_div").show();
				$(".marks_div").hide();
				
				$('input[name="bachelor_aggregate"]').attr("readonly",false);
			}
			else {
				$("#bachelor_grade").hide();
				$("#bachelor_aggrigate_warn").show();
				$(".bachelor_grade_div").hide();
				$(".bachelor_marks_div").show();
				$('input[name="bachelor_aggregate"]').attr("readonly",true);
			}
		});

		$('input[name="aggregate_m"]').click(function(){
			if($(this).val() == "grade") {
				$("#master_grade").show();
				$("#master_aggrigate_warn").hide();
				//$('input[name="bachelor_aggregate"]').focus();
				$(".master_grade_div").show();
				$(".master_marks_div").hide();
				
				$('input[name="master_aggregate"]').attr("readonly",false);
			}
			else {
				$("#master_grade").hide();
				$(".master_grade_div").hide();
				$(".master_marks_div").show();
				$('input[name="master_aggregate"]').attr("readonly",true);
			}
		});
		$('input[name="employed"]').click(function(){	

			if($(this).val() == "private") {

				$("#fianl_govt_nature_emp").hide();
				$("#fianl_uasd_nature_emp").hide();
				$("#govt_present_basic_pay").hide();
			}
			else if($(this).val() == "govt") {
				$("#govt_present_basic_pay").show();
				$("#fianl_uasd_nature_emp").hide();
				$("#fianl_govt_nature_emp").show();
			}
			else if($(this).val() == "uasd") {
				$("#fianl_govt_nature_emp").hide();
				$("#govt_present_basic_pay").show();
				$("#fianl_uasd_nature_emp").show();
			}
		});
		tick_women();
		hide_show();
		bachelor_specify_degree();
		master_specify_degree();
		
		//hide alert after 2000ms
		function explode(){
			$('.alert-success').hide("slow");
		}
		setTimeout(explode, 5000);
		$("#print").click(function(){
			$(".alert-success").hide();
		});
		//hide and marks and grade
		if($("input[name='aggregate_b']:checked").val() == 'grade') {

				$("#bachelor_grade").show();
				//$('input[name="bachelor_aggregate"]').focus();
				$(".grade_div").show();
				$(".marks_div").hide();
				
				$('input[name="bachelor_aggregate"]').attr("readonly",false);
			}
			else {
				$(".grade_div").hide();
				$(".marks_div").show();
				$('input[name="bachelor_aggregate"]').attr("readonly",true);
			}
		//	alert($("input[name='are_u_employed']:checked").val());
		//only numeric fields avilable.
      $('.numeric_field').keydown(function(event) {
		    // Allow special chars + arrows 
		   // $(this).attr('maxlength','4');
		    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
		        || event.keyCode == 27 || event.keyCode == 13 
		        || (event.keyCode == 65 && event.ctrlKey === true) 
		        || (event.keyCode >= 35 && event.keyCode <= 39)){
		            return;
		    }else {
		        // If it's not a number stop the keypress
		        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
		            event.preventDefault(); 
		        }   
		    }
	  });
	  
	  /*
	       $('.marks_2length').keydown(function(event) {
		    // Allow special chars + arrows 
		    $(this).attr('maxlength','2');
		    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
		        || event.keyCode == 27 || event.keyCode == 13 
		        || (event.keyCode == 65 && event.ctrlKey === true) 
		        || (event.keyCode >= 35 && event.keyCode <= 39)){
		            return;
		    }else {
		        // If it's not a number stop the keypress
		        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
		            event.preventDefault(); 
		        }   
		    }
	  });*/
	  //Show grade only when needed for bachelor
	  //$(".grade_div").hide();
	  //$(".show_for_grade").css({"position": "absolute", "top": "-200px"});


/*		$('input[name="present_basic_salary"]').hide();
		$(".govt_basic_pay").hide();*/
	    $("#myTab a").click(function(e){
	        e.preventDefault();
	        $(this).tab('show');
	    });
});

function tick_women() {
			if($("#gender").val() == "female") {
				/*alert("D")
				$("#women").attr('checked','checked');*/
			}
		}
function hide_show() {
	if($("#applied_post").val() == "assistant / asst cum computer operator") {
		$("#diploma").hide();
		$("#phd").show();
	}
	else if($("#applied_post").val() == "field/lab assistant") {
		$("#phd").hide();
		$("#diploma").show();
		$('#training').insertBefore('#diploma');
	}
}
function bachelor_specify_degree() {
if($("option:selected",$("#bachelor_degree")).val() == "Others") {
			$("#other_bachelor_degree").css({"position": "relative", "top": "0px"});
			$("#other_bachelor_degree").show('slow');
			}
			else {
			$("#other_bachelor_degree").css({"position": "absolute", "top": "-200px"});
			}
}

function master_specify_degree() {
if($("option:selected",$("#master_degree")).val() == "Others") {
			$("#other_master_degree").css({"position": "relative", "top": "0px"});
			$("#other_master_degree").show('slow');
			}
			else {
			$("#other_master_degree").css({"position": "absolute", "top": "-200px"});
			}
}			