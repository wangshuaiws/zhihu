@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">消息通知</div>

                    <div class="panel-body">
                        @foreach($messages as $messageGroup)
                            <div class="media {{ $messageGroup->first()->shouldAddUnreadClass() ? 'unread' : ''}}">
                                <div class="media-left">
                                    <a href="#">
                                        @if(Auth::id() == $messageGroup->last()->from_user_id)
                                            <img width="44" src="{{ $messageGroup->last()->toUser->avatar }}" alt="">
                                        @else
                                            <img width="44" src="{{ $messageGroup->last()->fromUser->avatar }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="#">
                                            @if(Auth::id() == $messageGroup->last()->from_user_id)
                                            {{ $messageGroup->last()->toUser->name }}
                                            @else
                                                {{ $messageGroup->last()->fromUser->name }}
                                            @endif
                                        </a>
                                    </h4>
                                    <a href="/inbox/{{ $messageGroup->first()->dialog_id }}">
                                        <p>
                                            {{ $messageGroup->first()->body }}
                                        </p>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
