(function ($) {
'use strict';
    window.App = {};

   App.Notification = function() {
       var self = this;

       this.updateCount = function() {
           var notificationsElement = $('#notifications-ctr');

           var currentCount = parseInt(notificationsElement.text()) || 0;

           if(currentCount === 0)
           {
               notificationsElement.removeClass('hidden').text(++currentCount);
               return;
           }

           console.log('current count '+currentCount);

           notificationsElement.text(++currentCount);
       };
       this.addItem = function(notification) {
           self.updateCount();

           var template = $('#notificationTpl').html();
           var html = Mustache.to_html(template, notification);
           $('#notifications-list').prepend(html);

           var len = $('#notifications-list a.notification').length;
           if(len > 7) {
               $('#notifications-list a.notification:last').remove();
           }
       };
   }
    /* Notifier */
    App.Notifier = function () {
        var self = this;
        this.notify = function (message) {
            toastr.info(message);
        },
        this.generateNotification = function(data) {
            self.notify(data.notification.title);
            (new App.Notification).addItem(data.notification);
        }
    };

    App.TaskNote = function () {
        var self = this;
        this.newNote = function(note) {
            var template = $('#noteTpl').html();
            var html = Mustache.to_html(template, note);
            $('#list-tasknote').prepend(html);

            $('#no-notes-item').remove();

            if ($('#list-tasknote li').length >= 6) {
                $('#list-tasknote li:last').remove();
            }
        }
    };

    /* Listeners */
    App.Listeners = {};

    App.Listeners.Registration = {
        whenUserHasRegistered: function (data) {
            (new App.Notifier).notify(data.user);

        },
        whenUserHasActivated: function (data) {
            (new App.Notifier).generateNotification(data);
        }
    };

    App.Listeners.Task = {
        whenNewTaskDelegated: function (data) {
            (new App.Notifier).generateNotification(data);
        },
        whenTaskStatusIsUpdated: function(data) {
            (new App.Notifier).generateNotification(data);
        },
        whenNewTaskNoteIsAdded: function(data) {
            (new App.Notifier).generateNotification(data);
            (new App.TaskNote).newNote(data.note);
        },
        whenTaskIsUpdated: function(data) {
            (new App.Notifier).generateNotification(data);
        }
    };

}(jQuery));
