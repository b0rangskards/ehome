<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover datatable">
                        <thead>
                            <tr>
                                @foreach($tableHeader as $header)
                                    <th class="{{$header=='Action'?'text-center':''}}">{{$header}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><span class="text-default-light">{{$user->present()->prettyName}}</span></td>
                                    <td><span class="text-default-light">{{$user->present()->prettyRole}}</span></td>
                                    <td>
                                        @if($user->isBanned())
                                            <span class="text-danger">Banned</span>
                                        @elseif($user->deactivated())
                                            <span class="text-danger">Deactivated</span>
                                        @elseif($user->isActivated())
                                            <span class="text-success">Activated</span>
                                        @else
                                            <span class="text-muted">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!($user->deactivated() && $user->isBanned()))
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.ban', $user->id], 'data-form-remote']) !!}
                                                {!! Form::submit('Ban User', ['class' => 'btn btn-danger ink-reaction', 'data-confirm' => 'Ban User?', 'data-confirm-yes' => 'Yes Ban User']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                        {{--@if($user->isBanned())--}}
                                            {{--{!! Form::open(['method' => 'PUT', 'route' => ['admin.users.revoke', $user->id], 'data-form-remote']) !!}--}}
                                                {{--{!! Form::submit('Revoke Ban', ['class' => 'btn btn-success ink-reaction', 'data-confirm' => 'Revoke Ban?', 'data-confirm-yes' => 'Yes Revoke Ban']) !!}--}}
                                            {{--{!! Form::close() !!}--}}
                                        {{--@endif--}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>