/**
 * Created by Wayne on 7/14/2015.
 * CONSTANTS
 */

/* MAP CONSTANTS */
var GMAP = {
    coords: {
        lat: 10.30739,
        lng: 123.89728
    },
    zoom: 12,
    minZoom: 15,
    defaultMarker: location.origin + '/images/default-marker.png'
};


function updateMapCenter(map, newLatLng) {
    $(map).gmap3({
        map: {
            options: {
                center: [newLatLng[0], newLatLng[1]]
            }
        }
    });
}
$(function () {




        /* Household Page */
        $('#setup-household-map, #create-task-map').gmap3({
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

        $('#household-side-info-map').gmap3({
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

    $(function () {

        /* Ajax Functions */

        function processAjaxRequest(method, url, data) {
            return $.ajax({
                method: method,
                url: url,
                data: data
            });
        }

        function processFormAjaxRequest(form) {
            var method = form.find('input[name="_method"]').val() || 'POST';
            var url = form.prop('action');
            console.log(method);
            return processAjaxRequest(method, url, form.serialize());
        }

        /* End Ajax Functions */

        /* Form Functions */

        function resetForm(form) {
            form[0].reset();
        }

        function clearForm(form) {
            form.find('div.form-group').removeClass('has-error');
            form.find('p.help-block').html('');
        }

        function displayError(fieldName, jsonObj) {
            var current = $('input[name=' + fieldName + '], select[name=' + fieldName + '], textarea[name=' + fieldName + ']');

            var currentFormGroup = current.closest('div.form-group'),
                currentHelpBlock = current.closest('p.help-block'),
                errorMessage = '';

            if (!$.isEmptyObject(jsonObj)) {
                currentFormGroup.addClass('has-error');
                $.each(jsonObj, function (key, value) {
                    errorMessage += value + '<br/>';
                });
                current.parent().parent().find('p.help-block').html(errorMessage).fadeIn(300);
            }
        }

        function displayErrors(form, responseJSON) {
            clearForm(form);

            $.each(responseJSON, function (key, value) {
                displayError(key, value);
            });
        }

        /* Message Dialog */

        function showSuccessMessage(message, title) {
            swal({
                title: title || "Success",
                text: message,
                type: "success",
                timer: 1500
            });
        }

        function showInfoMessage(message, title) {
            swal({
                title: title || "Success",
                text: message,
                type: "info",
                timer: 1500
            });
        }

        function showErrorMessage(message, title) {
            swal({
                title: title || 'Error',
                text: message,
                type: "error"
            });
        }
        /* End Message Dialog */

        /* Form Ajax Submission */
        $('form[data-form-remote]').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);
            var deffered = processFormAjaxRequest(form);
            var inputs = form.find('input[type="submit"]');
            inputs.prop('disabled', true);
            deffered
                .done(function (data) {

                    if(data.message != undefined) {
                        showSuccessMessage(data.message);
                    }

                    resetForm(form);

                    setTimeout(function () {
                        if(data.redirectTo != undefined){
                            window.location = data.redirectTo;
                        }else {
                            location.reload();
                        }
                    }, 1000);
                })
                .fail(function (jqXHR) {
                    if (jqXHR.responseJSON.error == null) {
                        displayErrors(form, jqXHR.responseJSON);
                    } else {
                        showErrorMessage(jqXHR.responseJSON.error);
                    }
                })
                .always(function () {
                    inputs.prop('disabled', false);
                });
        });

        /* Confirmation Dialog on Button Delete */
        $('input[data-confirm], button[data-confirm]').on('click', function (e) {
            e.preventDefault();

            var input = $(this);
            var form = input.closest('form');
            var prompt = input.data('confirm') || 'Are you sure?';
            var promptYes = input.data('confirm-yes') || 'Yes, pls!';

            swal({
                title: 'Are you sure?',
                text: prompt,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: promptYes,
                cancelButtonText: 'No, cancel pls!',
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    form.submit();
                }
            });
        });

        var initMultiSelect2 = function () {
            $('.select2-multi').select2();
        };

        var duplicateTemplate = function (templateId, target) {
            if (typeof tmpl === 'undefined') {
                return;
            }
            var o = this;

            var index = (target.data('index') > 0) ? target.data('index') : target.children().length + 1;
            target.data('index', index + 1);
            var clonedContent = tmpl(templateId, {index: index});

            // Add cloned source to parent
            var newContent = $(clonedContent).appendTo(target).hide().slideDown('fast');

            // Init date component
            initMultiSelect2(newContent, index);

            // Add delete event
            newContent.on('click', '.btn-delete', function (e) {
                newContent.slideUp('fast', function () {
                    newContent.remove();
                });
            });
        };

        /* Jquery Microtemplating Duplication of Elements */
        // Add event lsitener for duplication
        $('[data-duplicate]').on('click', function (e) {
            var item = $(this);
            var templateId = item.data('duplicate');
            var target = $(item.data('target'));
            duplicateTemplate(templateId, target);
        });

        // Init dulicate function
        $('[data-duplicate]').each(function () {
            var item = $(this);
            var templateId = item.data('duplicate');
            var target = $(item.data('target'));
            duplicateTemplate(templateId, target);
        });
        /* End Jquery Microtemplating Duplication of Elements */

        $('input.material-datetime').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', minDate: new Date()});

        $('.select2-multi').select2();
    });

$(function(){

    /* Registration Page */

    $('[data-tooltip-validation]').tooltip({trigger: 'manual'}).tooltip('show');

    $('input.mobile_no').inputmask("mask", {"mask": "(+63) 999-9999999"});

    /* Registration Page End */

});

//# sourceMappingURL=app.js.map