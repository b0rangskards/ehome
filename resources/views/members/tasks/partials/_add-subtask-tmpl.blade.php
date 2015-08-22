<script type="text/html" id="subtaskTmpl">
<div class="card">
    <div class="card-body" style="padding-bottom: 0px">
        <li class="clearfix">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="subtasks[<%=index%>][name]">
                        <label>Subtask</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="form-control select2-list select2-multi" name="subtasks[<%=index%>][]" multiple>
                            @foreach($taskMembers as $member)
                                <option value="{{ $member->user->id }}">{{ $member->user->firstname }}</option>
                            @endforeach
                        </select>
                        <label>Assign To</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-icon-toggle btn-delete stick-top-right text-muted" style="top:-20px;">
                        <span class="md md-clear"></span>
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea type="text" class="form-control" name="subtasks[<%=index%>][description]"></textarea>
                        <label>Description</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="streetnumber">Image (Optional)</label>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new"><i class="fa fa-paperclip text-muted"></i></span>
                                <span class="fileinput-exists"><i class="fa fa-refresh text-muted"></i></span>
                                <input type="file" name="subtasks[<%=index%>][image]">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                <i class="fa fa-times text-muted"></i>
                            </a>
                            <div class="fileinput-preview thumbnail inline-block" data-trigger="fileinput" style="width: 60px; height: 60px;border:none"></div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
	</div>
</div>
</script>
 