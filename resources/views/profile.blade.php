@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('common.profile')}}</div>
                    <div class="panel-body">
                        @include('area.messages')
                        <form class="form-horizontal" method="POST" action="{{ url('/profile') }}">


                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">User ID:</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value="{{$user->id}}" name="id" disabled/></div>
                            </div>

                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label">{{trans('common.name')}}*:</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="{{trans('common.name')}}"/></div>
                            </div>

                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label">{{trans('common.phone')}}*:</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value="{{$user->phone}}" name="phone" placeholder="{{trans('common.phone')}}"/></div>
                            </div>

                            <div class="form-group">
                                <label for="pwd" class="col-sm-3 control-label">{{trans('common.password')}}:</label>
                                <div class="col-sm-9"><input type="password" class="form-control" name="password" placeholder="{{trans('common.password')}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pwdrp" class="col-sm-3 control-label">{{trans('common.password_confirmation')}}:</label>
                                <div class="col-sm-9"><input type="password" class="form-control" name="password_confirmation" placeholder="{{trans('common.password_confirmation')}}"/></div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">{{trans('common.email')}}:</label>
                                <div class="col-sm-9"><input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="{{trans('common.email')}}" disabled/></div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="submit" class="btn btn-success">{{trans('common.save')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
