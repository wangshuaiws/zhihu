@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">设置个人信息</div>

                    <div class="panel-body">
                        <form action="/setting" role="form" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">居住城市</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" value="{{ user()->settings['city'] }}" name="city" required>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                <label for="bio" class="col-md-4 control-label">个人简介</label>

                                <div class="col-md-6">
                                    <textarea id="bio" type="text" class="form-control" name="bio" required>{{ user()->settings['bio'] }}</textarea>
                                    @if ($errors->has('bio'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary btn-block">
                                        更新资料
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
