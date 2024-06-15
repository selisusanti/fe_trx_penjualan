
$(document).ready(function() {
    function zoneCircle() {
        // ---- Zone Circle ----
        $('#draw-zone-circle').on('click', function() {
            var long = Number($('input[name="poi-address-long"]').val());
            var lat = Number($('input[name="poi-address-lat"]').val());

            var map = new google.maps.Map(document.getElementById('map-zone'), {
                zoom: 13,
                center: {
                    lat: lat, 
                    lng: long
                },
                mapTypeId: 'terrain'
            });

            $('input[name="count-circle[]"]').each(function() {
                var value = Number($(this).val());
                var randColor = getRandomColor();
                var cityCircle = new google.maps.Circle({
                    strokeColor: randColor,
                    strokeOpacity: 0.5,
                    strokeWeight: 2,
                    fillColor: randColor,
                    fillOpacity: 0.35,
                    map: map,
                    center: {
                        lat: lat,
                        lng: long
                    },
                    radius: Number($('input[name="circle-radius['+value+']"]').val())
                });
            });
            $('#map-zone').addClass('maps');
        });

        //add form for zone circle
        var element_circles = 1;
        $('#add-zone-circle').on('click', function() {
            var element =   '<div class="row" style="margin-top: 1rem" id="radius-' + element_circles + '">' +
                            '<input type="hidden" name="count-circle[]" value="' + element_circles + '">' +
                            '<div class="col-7">' +
                            '<input type="text" name="circle-name[' + element_circles + ']" class="form-control form-control-alt" placeholder="Input zone name">' +
                            '</div>' +
                            '<div class="col-4" style="padding-right: 0 !important;">' +
                            '<input type="text" name="circle-radius[' + element_circles + ']" class="form-control form-control-alt" placeholder="Input zone radius">' +
                            '</div>' +
                            '<div class="col-1 ml-auto text-right">' +
                            '<button type="button" class="btn btn-outline-danger delete-radius" data-id="radius-' + element_circles + '">' +
                            '<i class="far fa-trash-alt"></i>' +
                            '</button>' +
                            '</div>' +
                            '</div>';
            $('#step-zone #circle-form').append(element);
            element_circles++;  
            delete_circle = $('.delete-radius').click(function() {
                var delete_form = $(this).attr('data-id');
                var id_form = document.getElementById(delete_form);
                id_form.remove();
            });
        });

        //delete for radius circle form
        var delete_circle = $('.delete-radius').click(function() {
            var delete_form = $(this).attr('data-id');
            var id_form = document.getElementById(delete_form);
            id_form.remove();
        });
        // ---- End Zone Circles ----
    }

    window.onload = function () {
        initializePoi();
    }

    /* Additional function */
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    /* Additional function */

    /* Maps */
        // ---- POI ----
        var marker_poi;
        function initializePoi() {
            var myLatlng = new google.maps.LatLng(-6.16104,106.76251);
            $('[name="poi-address-lat"]').val(-6.16104);
            $('[name="poi-address-long"]').val(106.76251);
            var myOptions = {
                zoom:17,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map-poi"), myOptions);

            // marker refers to a global variable
            marker_poi = new google.maps.Marker({
                position: myLatlng,
                draggable: true,
                map: map
            });

            google.maps.event.addListener(map, "click", function(event) {
                // get lat/lon of click
                var clickLat = event.latLng.lat();
                var clickLon = event.latLng.lng();

                $('[name="poi-address-lat"]').val(clickLat.toFixed(5));
                $('[name="poi-address-long"]').val(clickLon.toFixed(5));

                marker_poi.setPosition(event.latLng);
            });
        }

        $('#map-poi').hide();
        $('.toggle-maps-poi').click(function() {
            $('#map-poi').toggle();
            $('#map-poi').addClass('maps');
        });
        // ---- End POI ----

        // ---- Sector ----
        $('#draw-sector').on('click', function() {
            var max_radius = 0;
            var long = Number($('input[name="poi-address-long"]').val());
            var lat = Number($('input[name="poi-address-lat"]').val());

            Number.prototype.toRad = function() {
                return this * Math.PI / 180;
            }

            Number.prototype.toDeg = function() {
                return this * 180 / Math.PI;
            }

            google.maps.LatLng.prototype.destinationPoint = function(brng, dist) {
                dist = (dist/1000) / 6371;  
                brng = brng.toRad();  

                var lat1 = this.lat().toRad(), lon1 = this.lng().toRad();

                var lat2 = Math.asin(Math.sin(lat1) * Math.cos(dist) + 
                                    Math.cos(lat1) * Math.sin(dist) * Math.cos(brng));

                var lon2 = lon1 + Math.atan2(Math.sin(brng) * Math.sin(dist) *
                                            Math.cos(lat1), 
                                            Math.cos(dist) - Math.sin(lat1) *
                                            Math.sin(lat2));

                if (isNaN(lat2) || isNaN(lon2)) return null;

                return new google.maps.LatLng(lat2.toDeg(), lon2.toDeg());
            }

            var map = new google.maps.Map(document.getElementById('map-sector'), {
                zoom: 13,
                center: {
                    lat: lat, 
                    lng: long
                },
                mapTypeId: google.maps.MapTypeId.TERRAIN
            });

            $('input[name="count-circle[]"]').each(function() {
                var value = Number($(this).val());
                var radius = Number($('input[name="circle-radius['+value+']"]').val());
                if(radius > max_radius) max_radius = radius;
                var randColor = getRandomColor();
                var cityCircle = new google.maps.Circle({
                    strokeColor: randColor,
                    strokeOpacity: 0.5,
                    strokeWeight: 2,
                    fillColor: randColor,
                    fillOpacity: 0.35,
                    map: map,
                    center: {
                        lat: lat,
                        lng: long
                    },
                    radius: radius
                });
            });

            $('input[name="count-sector[]"]').each(function() {
                var value = Number($(this).val());
                var thisElement = $('input[name="sector-degree[' + value + ']"]');
                var center = new google.maps.LatLng(lat, long);
                var getLtLng = center.destinationPoint(Number(thisElement.val()), max_radius);
                $('input[name="sector-latlng[' + value + ']"]').val(getLtLng);
                var citySector = new google.maps.Polyline({
                    path: [ 
                        center, 
                        getLtLng
                    ],
                    strokeWeight: 2,
                    map: map
                });
            });
            $('#map-sector').addClass('maps');
        });

        //add form for zone circle
        var element_sectors = 1;
        $('#add-sector').on('click', function() {
            var element =   '<div class="row" style="margin-top: 1rem" id="sector-' + element_sectors + '">' +
                            '<input type="hidden" name="count-sector[]" value="' + element_sectors + '">' +
                            '<input type="hidden" name="sector-latlng[' + element_sectors + ']">' +
                            '<div class="col-7">' +
                            '<input type="text" name="sector-name[' + element_sectors + ']" class="form-control form-control-alt" placeholder="Input sector name">' +
                            '</div>' +
                            '<div class="col-4" style="padding-right: 0 !important;">' +
                            '<input type="text" name="sector-degree[' + element_sectors + ']" class="form-control form-control-alt" placeholder="Input sector degree">' +
                            '</div>' +
                            '<div class="col-1 ml-auto text-right">' +
                            '<button type="button" class="btn btn-outline-danger delete-sector" data-id="' + element_sectors + '">' +
                            '<i class="far fa-trash-alt"></i>' +
                            '</button>' +
                            '</div>' +
                            '</div>';
            $('#step-sector .form-group:first').append(element);
            element_sectors++;  
            delete_sector = $('.delete-sector').click(function() {
                var delete_form = $(this).attr('data-id');
                var id_form = document.getElementById("sector-" + delete_form);
                id_form.remove();
            });
        });

        //delete for radius circle form
        var delete_sector = $('.delete-sector').click(function() {
            var delete_form = $(this).attr('data-id');
            var id_form = document.getElementById("sector-" + delete_form);
            id_form.remove();
        });
        // ---- End Sector ----
    /* Maps */

    /* zone shape */
        zoneCircle();
        $('#polygon-button, #polygon-form').hide();
        $('select[name=zone-shape]').on('change', function() {
            var selected = $(this).children("option:selected").val();
            if (selected == "circle") {
                $('#next').attr('data-wizard','next');
                $('#next').show();
                $('#submit').hide();
                $('#polygon-button, #polygon-form').hide();
                $('#circle-form, #circle-button').show();
                zoneCircle();
            } else {
                $('#next').removeAttr('data-wizard');
                $('#next').hide();
                $('#submit').show();
                $('#polygon-button, #polygon-form').show();
                $('#circle-form, #circle-button').hide();
            }
        });
    /* zone shape */

    //If Region Active
    $('#next').hide();
    $('#poi-region').change(function() {
        if ($('#poi-region').is(':checked')) {
            $('#next').attr('data-wizard','next');
            $('#next').show();
            $('#submit').hide();
        } else {
            $('#next').removeAttr('data-wizard');
            $('#next').hide();
            $('#submit').show();
        }
    });
});