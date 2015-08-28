    @include('members.partials._notification-tmpl')

    {!! HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp') !!}
    {!! HTML::script('js/vendor.js') !!}
    {!! HTML::script('js/gmap3.min.js') !!}
    {!! HTML::script('js/app.js') !!}

   <script>
     {{-- Enable pusher logging - don't include this in production --}}
     Pusher.log = function(message) {
         console.log(message);
     };

     var pusher = new Pusher(PUSHER.APP_KEY, PUSHER.OPTIONS);

     var channel = pusher.subscribe("{{$currentUser->getChannel()}}");

    /* Listen for events */

     channel.bind('App\\Events\\UserHasRegistered', App.Listeners.Registration.whenUserHasRegistered);

     /* When a task is created. Show alert notifications to task members. */
     channel.bind('App\\Events\\TaskHasCreated', App.Listeners.Task.whenNewTaskDelegated);

     /* When task is updated. Show alert notifications to task members. */
     channel.bind('App\\Events\\TaskHasUpdated', App.Listeners.Task.whenTaskIsUpdated);

     /* When a task status is updated. Notify task creator or household head */
     channel.bind('App\\Events\\TaskStatusUpdated', App.Listeners.Task.whenTaskStatusIsUpdated);

     channel.bind('App\\Events\\NewTaskNoteHasCreated', App.Listeners.Task.whenNewTaskNoteIsAdded);


   </script>

</body>
</html>