$(document).ready(function(){
    $("a").tooltip();
    $("div").tooltip();

    var new_room = [];
    var final_array = new Array;
    var booking_array = new Array();
    var room_price = new Array();

    $("div.clickable").click(function(){
        //alert($(this).attr('data-original-title'));
        $(this).css({
            background:'rgba(10, 51, 48, 0.44)',
            color:"#fff"
        });

        if(jQuery.inArray($(this).text(), booking_array) === -1)
        {
            booking_array.push($(this).text());
            room_price.push($(this).attr('data-price'));

            new_room.push("<div class='booking_details_block row'><span class='col-md-6'>Selected Stall : "+ $(this).text() +"</span><span class='col-md-6'>Stall Price : <span class='room_price'> INR:"+ $(this).attr('data-price') +"</span></span><span class='col-md-12'>Stall Size : "+$(this).attr('data-original-title')+"</span><hr></div>");
            $("#room_details").html(new_room);
            //console.log(new_room);
        }
        else {
            /*$(this).css({
                background:'goldenrod',
                color:"turquoise"
            });*/
          //booking_array.splice( $.inArray($(this).text(), booking_array), 1 );
        }
        
        $("#layout_outer").animate({
            width: '80%'
          }, 10, function() {
            //After above animation completes
            $("#booking_details").animate({
                width: '18%'
              });
          });
        var total_sum = 0;
        for (var i = 0; i < room_price.length; i++) {
            total_sum += room_price[i] << 0;
        }
            final_array = {'Cow': 'Moo', 'Pig': 'Oink', 'Dog': 'Woof', 'Cat': 'Miao'};
            console.log(final_array+'d');
        console.log(booking_array);
        $("#total_price").text(total_sum);
        $('#booking_details').css({"display":"block"});
    });
});