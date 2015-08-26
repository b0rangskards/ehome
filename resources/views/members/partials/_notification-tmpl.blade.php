<script type="text/template" id="notificationTpl">
	<a data-recipient="@{{recipientId}}" class="alert alert-callout alert-success notification @{{seen?'seen':''}}"
	   href="@{{link}}">
		<img class="pull-left img-circle dropdown-avatar" src="{{ asset('images/icon-user-default.png') }}" alt=""/>
		<strong>@{{senderName}}</strong>
		<span class="time">@{{timeSent}}</span>
		<br/>
		<div class="elipses-overflow-notification"><small class="text-muted">@{{title}}</small></div>
	</a>
</script>
