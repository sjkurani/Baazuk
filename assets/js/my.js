$(document).ready(function() {
  if($("#apartment_area").length) {
    console.log('s');
    get_area_list('apartment_city','apartment_area','apartment');
  }
  if($("#event_area").length) {
    get_area_list('event_city','event_area','event');
  }
  if($("#mall_area").length) {
    get_area_list('mall_city','mall_area','mall');
  }
  if($("#park_area").length) {
    get_area_list('park_city','park_area','park');
  }
  if($("#hoarding_area").length) {
    get_area_list('hoarding_city','hoarding_area','hoarding');
  }

  $('#apartment_city').change(function(){
    get_area_list('apartment_city','apartment_area','apartment');
  });
  $('#event_city').change(function(){
    get_area_list('event_city','event_area','event');
  });
  $('#mall_city').change(function(){
    get_area_list('mall_city','mall_area','mall');
  });
  $('#park_city').change(function(){
    get_area_list('park_city','park_area','park');
  });
  $('#hoarding_city').change(function(){
    get_area_list('hoarding_city','hoarding_area','hoarding');
  });
  //for city based on options start 
 if($("#apartment_city").length) {
    console.log('s');
    get_citys_list('apartment_city','apartment');
  }
  if($("#event_city").length) {
    get_citys_list('event_city','event');
  }
  if($("#mall_city").length) {
    get_citys_list('mall_city','mall');
  }
  if($("#park_city").length) {
    get_citys_list('park_city','park');
  }
  if($("#hoarding_city").length) {
    get_citys_list('hoarding_city','hoarding');
  }


   //for city based on options end
  $(".popup").click(function(e){
    e.preventDefault();
	  var str = $(this).attr('id').split("-");
    console.log(str);
    $("#popupmodal #enquiry_id").val(str[0]);
    $("#popupmodal #enquiry_id_text").text(str[0]);
	  $("#popupmodal #remarks").val(str[1]);
    $("#popupmodal input[name='status']").val(1);
	
  });

  //modal load based upon the url..
  var target = document.location.hash.replace("#", "");
  if (target.length) {
    if(target != 'whatsmediabasket') {
      $('#'+target).modal('show');
    }
  }
  //Date format
  var date = new Date();
  date.setDate(date.getDate());

  $(".date_fields")
  .datetimepicker({
    format: "dd/mm/yyyy - HH:ii P",
    showMeridian: true,
    autoclose: true,
    todayBtn: "linked",
    startDate: date,
    linkField: "selected_pickup_date",
    linkFormat: "yyyy-mm-dd hh:ii"
  })
  .on('changeDate', function(ev){
    //assign_enddate();
  });
  
  var cnt = 0;
    $(window).scroll(function(){
      //alert($(this).scrollTop());
      if($("#transparent_back_img").length) {
        var targetOffset  = $("#transparent_back_img").offset().top - 400;
        if($(this).scrollTop() >targetOffset  && cnt == 0)
        {
          cnt = 1;
          $('.count').each(function () {
                  $(this).prop('Counter',0).animate({
                      Counter: $(this).text()
                  }, {
                      duration: 2500,
                      easing: 'swing',
                      step: function (now) {
                          $(this).text(Math.ceil(now));
                      }
                  });
              });

        }
      }
    });
  nanospell_url = base_url+'assets/nanospell/plugin.js';
	tinymce.init({
            selector: "textarea",
            plugins: "link image table searchreplace wordcount visualblocks insertdatetime media nonbreaking save",
            external_plugins: {"nanospell": nanospell_url},
            nanospell_server: "php"
   });    
	

  });

  function assign_enddate(){
    enddate =  new Date($("#selected_pickup_date").val());
    $(".end_datetime").datetimepicker({
      format: "dd/mm/yyyy - HH:ii P",
      showMeridian: true,
      autoclose: true,        
      startDate: enddate
    });
  }
  
  function get_area_list(city, area,media_type) {
    var hashed_area = "#"+area;
    var hashed_city = "#"+city;
    var city_id = $(hashed_city).val();
    var city_name = $(hashed_city+" option:selected").text();
    var name = "input[name='"+city+"']";
    var hidden_city_name = city+'_name';
    $('#'+city+'_name').val(city_name);
    $(hashed_area).empty();
     $.ajax({
            method: "GET",
            url: base_url+"ajax/get_areas?term="+city_id+"&media_type="+media_type,
            success: function(area_array){
              console.log(area_array);
              if(city_id == 0) {
                      var option_str = "<option value='0'>--Select Area--</option>";
                      $(hashed_area).append(option_str);                
              }
              else if(typeof area_array !== 'undefined' && area_array.length > 0) {
                  var area_array = $.parseJSON(area_array);
                  $(hashed_area).append("<option value='0'>--Select Area--</option>");
                  $.each( area_array, function( index, value ){
                      option_str = "<option value='"+value.area_name+"'>"+value.area_name+"</option>";
                      $(hashed_area).append(option_str);
                  });
                }
                else {
                      var option_str = "<option value='0'>--No Area Found--</option>";
                      $(hashed_area).append(option_str);
                }
            }
        });    
  }
  function get_citys_list(city,media_type) {
   
    var hashed_city = "#"+city;
    var city_id = $(hashed_city).val();
    var city_name = $(hashed_city+" option:selected").text();
    var name = "input[name='"+city+"']";
    var hidden_city_name = city+'_name';
    $('#'+city+'_name').val(city_name);
   
     $.ajax({
            method: "GET",
            url: base_url+"ajax/get_city?term="+city_id+"&media_type="+media_type,
            success: function(area_array){
              console.log(city_array);
              if(city_id == 0) {
                      var option_str = "<option value='0'>--Select city--</option>";
                      $(hashed_city).append(option_str);                
              }
              else if(typeof city_array !== 'undefined' && city_array.length > 0) {
                  var city_array = $.parseJSON(city_array);
                  $(hashed_city).append("<option value='0'>--Select city--</option>");
                  $.each( city_array, function( index, value ){
                      option_str = "<option value='"+value.city_name+"'></option>";
                      $(hashed_city).append(option_str);
                  });
                }
                else {
                      var option_str = "<option value='0'>--No city Found--</option>";
                      $(hashed_city).append(option_str);
                }
            }
        });    
  }
