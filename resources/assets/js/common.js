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
            return processAjaxRequest(method, url, form.serialize());
        }

        function processFormAjaxRequestWithData(form, additionalData) {
            var method = form.find('input[name="_method"]').val() || 'POST';
            var url = form.prop('action');
            var formData = form.serialize() + additionalData
            return processAjaxRequest(method, url, formData);
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

        /* Marking seen on Notifications */
        $('.notification:not(.seen)').on('click', function(e){
            var thisElement = $(this);
            var link = thisElement.prop('href');
            var recipientId = thisElement.data('recipient');

           processAjaxRequest('PATCH', '/notification/markseen', {link: link, to_userid: recipientId})
               .done(function(){
                   thisElement.addClass('seen');
               });
        });
        $('ul.notifications-list .notification:not(.seen)').on('click', function(){
            var thisElement = $(this);
            var link = thisElement.find('a').prop('href');
            var recipientId = thisElement.data('recipient');

            processAjaxRequest('PATCH', '/notification/markseen', {link: link, to_userid: recipientId})
                .done(function () {
                    thisElement.addClass('seen');
                });
        });
        /* End Marking seen on Notifications */

        $('#form-task-confirm button[data-task-confirm]').on('click', function(){
           var confirm = $(this).data('task-confirm');
            var form = $('#form-task-confirm');
            var method = form.find('input[name="_method"]').val() || 'POST';
            var url = form.prop('action');

            var formData = form.serialize() + '&confirm=' + confirm;

            processAjaxRequest(method, url, formData)
                .done(function(data){

                    showInfoMessage(data.message, '');

                    setTimeout(function () {
                        if (data.redirectTo != undefined) {
                            window.location = data.redirectTo;
                        } else {
                            location.reload();
                        }
                    }, 1500);
                });
        });

        $('#view-task-image-modal').on('show.bs.modal', function(e)
        {
            var img = $(e.relatedTarget).find('img').prop('src');
            $(this).find('.modal-body img').prop('src', img);
        })
            .on('hidden.bs.modal', function()
            {
                $(this).find('.modal-body img').prop('src', '');
            });


        $('.btn-update-task-status').on('click', function(){
            var thisElement = $(this),
                status = thisElement.data('status'),
                from_userid = thisElement.data('userid'),
                form = thisElement.closest('form'),
                loader = form.find('.loader');

            var additionalParams = '&status=' + status + '&from_userid=' + from_userid;

            loader.show();

            processFormAjaxRequestWithData(form, additionalParams)
                .done(function(data) {
                    form.parent().find('.current-status-content').text(data.status);

                    $(".tooltip").hide();

                    if (status === 'done') {
                        thisElement.parent().remove();
                        return;
                    }

                    thisElement.remove();
                })
                .always(function(){
                   loader.hide();
                });
        });

        $('.form-task-leave-note').on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var deferred = processFormAjaxRequest(form);
            var loader = form.find('.loader');

            loader.show();
            form.find('.help-block').text('');
            form.find('.form-group').removeClass('has-error');

            deferred
                .done(function(data){
                    var template = $('#noteTpl').html();
                    var html = Mustache.to_html(template, data.note);
                    $('#list-tasknote').prepend(html);

                    $('#no-notes-item').remove();

                    if($('#list-tasknote li').length >= 6) {
                        $('#list-tasknote li:last').remove();
                    }

                    resetForm(form);
                })
                .fail(function(data){
                    var error = data.responseJSON.note[0];
                    form.find('.help-block').text(error);
                    form.find('.form-group').addClass('has-error');
                })
                .always(function(){
                    loader.hide();
                });
        });

        $('[data-tooltip-validation]').tooltip({trigger: 'manual'}).tooltip('show');

        $('input.mobile_no').inputmask("mask", {"mask": "(+63) 999-9999999"});

        $('table.datatable').DataTable();

    });
