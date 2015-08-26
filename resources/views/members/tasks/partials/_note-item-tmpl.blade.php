<script type="text/template" id="noteTpl">
    <li data-id="@{{id}}">
        <div class="card">
            <div class="comment-avatar"><i class="fa fa-comment opacity-50"></i></div>
            <div class="card-body">
            	<h4 class="comment-title">@{{owner}} <small>@{{timeSent}}</small></h4>
            	<p>@{{note}}</p>
            </div>
        </div>
    </li>
</script>
