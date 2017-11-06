      var autocomplete = [];
      function initAutocomplete() {
            var input = document.getElementsByClassName('google_location');
            var options = {
                 //bounds: defaultBounds,
                types: ['establishment']
            };
             for (i = 0; i < input.length; i++) {
                autocomplete[i] = new google.maps.places.Autocomplete(input[i], options);
                var dom_ele = input[i];
                google.maps.event.addListener(autocomplete[i], 'place_changed', function(){
                  var place = this.getPlace();
                  console.log(JSON.stringify(place));
                  console.log(JSON.parse(JSON.stringify(place)));

                    lat = this.getPlace().geometry.location.lat();
                    lng = this.getPlace().geometry.location.lng();
                    console.log(this.id);
                    console.log(lat+"@"+lng);
                });


          $("#airportdroppoint_lat_lng").val("sss");
                //$("#airportdroppoint_lat_lng").val(this.getPlace().geometry.location.lat()+"@"+this.getPlace().geometry.location.lng());
                
             }
      }

      function fillInAddress() {
        console.log('s')
        // Get the place details from the autocomplete object.
        /*var place = autocomplete1.getPlace();
        console.log(autocomplete1);*/
      }
