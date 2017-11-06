<script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
<footer>
<div id="footer" class="container-fluid">
    <div class="row-fluid footer-rows ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="row text-center muted">
                        <div class="footer-social">
                        <br>
                        <div class="icons">
                                        <div class="pull-right">
                                          No 1213, 1st Floor, 22nd Cross, 3rd Sector, HSR Layout, Bangalore 
                                          <br>
                                          Email : themediabasket@gmail.com 
                                          <br>
                                          Mobile : 08073590048
                                        </div>
                            <a target="_blank" href="#"><i class="fa fa-twitter fa-2x"></i></a>
                            <a target="_blank" href="https://www.facebook.com/themediabasket/"><i class="fa fa-facebook fa-2x"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/company-beta/13211933/"><i class="fa fa-linkedin fa-2x"></i></a>
                            <a target="_blank" href="#"><i class="fa fa-google-plus fa-2x"></i></a>
                        </div>
        
                        </div>
                    </div>
                        <ul class="text-center">
                            <li><a href="<?php echo base_url()."#whatsmediabasket";?>" title="Would you like to know about us?">About Us</a></li><!-- 
                            <li><a href="#" title="Feel free to contact us">Contact Us</a></li> -->
                            <li><a href="#" title="Frequently asked questions">FAQS</a></li>
                            <li><a href="#" title="Privacy policy">Privacy</a></li>
                            <?php
                                if(!$this->session->userdata('logged_in')) {
                                echo '<li><a href='.base_url().'account/signin title="Signin now">Sign in</a></li>
                                      <li><a href='.base_url().'account/signup title="Register now">Sign up</a></li>';

                                }
                            ?>
                        </ul>
                    </div>
                        <div class="row">
                          <center><small>© 2017 Mediabasket. All rights reserved.</small></center>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="JavaScript:void(0);" title="Back To Top" id="backtop" style="display: inline;"></a>
    </div>
</footer>

     <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        locality: 'long_name'
      };

      function initMap() {
/*
        var lat = document.getElementById('map_lat').value;
        var lng = document.getElementById('map_lang').value;
        console.log(lat);
        console.log(lng);
        */
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 12.9715987, lng: 77.59456269999998},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var input1 = document.getElementById('pac-input1');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var autocomplete1 = new google.maps.places.Autocomplete(input1);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);
        autocomplete1.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          Draggable: true
        });
        //Draggable 
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("map_lat").value = this.getPosition().lat();
            document.getElementById("map_lang").value = this.getPosition().lng();
        });
        //AutoComplete.
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).readOnly = true;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }
          document.getElementById("map_lat").value = place.geometry.location.lat();
          document.getElementById("map_lang").value = place.geometry.location.lng();
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
    

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="
https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var full_url = "<?php echo base_url();?>reports/event_ajax_list";
    $('.DataTable').DataTable( {
        dom: 'Blfrtip',
        bFilter: true, //Removes search box.
        buttons: [
            'copy',  'excel', 'pdf', 'print'
        ],

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmff4pnL3Z7g_SQ0Sjt-eZCPa4GE-8atI&libraries=places&callback=initMap"
        async defer></script>

</html>