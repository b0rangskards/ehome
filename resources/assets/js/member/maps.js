$(function () {

        /* Household Page */
        $('#setup-household-map').gmap3({
            map: {
                options: {
                    center: [GMAP.coords.lat, GMAP.coords.lng],
                    zoom: GMAP.zoom,
                    disableDefaultUI: true
                }
            },
            marker: {
                latLng: [GMAP.coords.lat, GMAP.coords.lng],
                options: {
                    draggable: true,
                    icon: GMAP.defaultMarker
                },
                events: {
                    dragend: function (marker, event, context) {
                        var newLatLng = $.map(marker.position, function (el) {
                            return el;
                        });
                        updateMapCenter(this, newLatLng);
                        $('input[name="coordinates"]').val(newLatLng[0] + ',' + newLatLng[1]);
                    }
                }
            }
        });



    $('#include-location-modal')
        .on('show.bs.modal', function(){
            $('#create-task-map').gmap3({
                map: {
                    options: {
                        center: [GMAP.coords.lat, GMAP.coords.lng],
                        zoom: GMAP.zoom,
                        disableDefaultUI: true
                    }
                }
            });
        }).on('shown.bs.modal', function(e){
            var triggerBtn = $(e.relatedTarget);

           $('#create-task-map').gmap3({
               trigger: 'resize',
               map: {
                   options: {
                       center: [GMAP.coords.lat, GMAP.coords.lng]
                   }
               },
               marker: {
                   latLng: [GMAP.coords.lat, GMAP.coords.lng],
                   options: {
                       draggable: true,
                       icon: GMAP.defaultMarker
                   },
                   events: {
                       dragend: function (marker, event, context) {
                           var newLatLng = $.map(marker.position, function (el) {
                               return el;
                           });
                           updateMapCenter(this, newLatLng);
                           var latLng = newLatLng[0] + ',' + newLatLng[1];
                           triggerBtn.parent().parent().find('input[name=coordinates]').val(latLng);
                       }
                   }
               }
           });
        }).on('hidden.bs.modal', function(){
            $('#create-task-map').gmap3('destroy');
        });

        $('a[href="#tab-additional-details"]').on('shown.bs.tab', function (e) {
            $('#create-task-map').gmap3({
                trigger: 'resize',
                map: {
                    options: {
                        center: [GMAP.coords.lat, GMAP.coords.lng]
                    }
                }
            });

        });

        $('#household-side-info-map,.map-with-coords').gmap3({
            map: {
                options: {
                    center: [GMAP.coords.lat, GMAP.coords.lng],
                    zoom: GMAP.minZoom,
                    disableDefaultUI: true
                },
                callback: function(){
                    var latLngArray = ($(this).data('coordinates')).split(',');
                    $(this).gmap3({
                        map: {
                            options: {
                                center: [latLngArray[0], latLngArray[1]]
                            }
                        },
                        marker: {
                            latLng: [latLngArray[0], latLngArray[1]],
                            options: {
                                icon: GMAP.defaultMarker
                            }
                        }
                    });
                }
            }
        });

        $('#update-household-map').gmap3({
            map: {
                options: {
                    center: [GMAP.coords.lat, GMAP.coords.lng],
                    zoom: GMAP.minZoom,
                    disableDefaultUI: true
                },
                callback: function () {
                    var coordinates = $(this).data('coordinates');
                    var latLngArray = coordinates ? coordinates.split(',') : [GMAP.coords.lat, GMAP.coords.lng];

                    $(this).gmap3({
                        map: {
                            options: {
                                center: [latLngArray[0], latLngArray[1]]
                            }
                        },
                        marker: {
                            latLng: [latLngArray[0], latLngArray[1]],
                            options: {
                                draggable: true,
                                icon: GMAP.defaultMarker
                            },
                            events: {
                                dragend: function (marker, event, context) {
                                    var newLatLng = $.map(marker.position, function (el) {
                                        return el;
                                    });
                                    updateMapCenter(this, newLatLng);
                                    $('input[name="coordinates"]').val(newLatLng[0] + ',' + newLatLng[1]);
                                }
                            }
                        }
                    });
                }
            }
        });

        /* Household Page End */

});
