@extends('admin.layouts.app')

@section('page-title', __('User Profile') )

@section('content')

    <div class="row min-vh-100">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <h4>{{__('Edit Profile')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="setting-tab">
                        <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#my-profile" role="tab" aria-selected="false">{{__('My Profile')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#change-password" role="tab" aria-selected="false">{{__('Change Password')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade fade show active" id="my-profile" role="tabpanel">
                                {{ Form::model($user, ['route' => ['profile.upload'], 'enctype'=>'multipart/form-data']) }}
                                <div class="card-header">
                                    <h3>{{ __('Edit Profile') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group col-md-12 col-12">
                                                    {{ Form::label('name', __('Full Name')) }}
                                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Name')]) }}
                                                </div>
                                                <div class="form-group col-md-12 col-12">
                                                    {{ Form::label('email', __('Email')) }}
                                                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email Address')]) }}
                                                </div>
                                                <div class="form-group col-md-12 col-12">
                                                    {{ Form::label('image', __('Choose Image')) }}
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">{{ __('Upload') }}</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            {{ Form::file('avatar', [ 'class' => 'custom-file-input',
                                                                                      'accept'=>"image/jpg, image/png, image/jpeg",
                                                                                      'multiple' => true,
                                                                                      'id' => "inputGroupFile",
                                                                                    ] ) }}
                                                            {{ Form::label('inputGroupFile', __('Choose file'), ['class' => 'custom-file-label']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img src="{{ asset(Storage::url($user->avatar)) }}" class="profile-image img-responsive" onerror="this.onerror=null;this.src='{{ asset('public/img/theme/avatar.png') }}';">
                                                <button type="button" class="btn btn-danger mt-2" onclick="document.getElementById('delete_avatar').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                                </div>
                                {{ Form::close() }}

                                {!! Form::open(['method' => 'DELETE', 'id' => 'delete_avatar', 'route' => ['delete.profile.image'] ]) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade" id="change-password" role="tabpanel">

                                <div class="email-setting-wrap ">
                                    {{Form::open(['route'=>'update.password', 'method'=>'POST'])}}

                                    <div class="card-header">
                                        <h3>{{ __('Change Password') }}</h3>
                                    </div>

                                    <div class="row card-body">
                                        <div class="form-group col-md-4">
                                            {{Form::label('current_password',__('Current Password')) }}
                                            <input class="form-control" name="current_password" type="password" id="current_password" required autocomplete="current_password" placeholder="{{ __('Enter Current Password') }}">
                                            @error('current_password')
                                            <span class="invalid-current_password" role="alert">
                                                     <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('password', __('New Password')) }}
                                            <input class="form-control" name="password" type="password" id="password" required autocomplete="password" placeholder="{{ __('Enter New Password') }}">
                                            @error('password')
                                            <span class="invalid-password" role="alert">
                                                     <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('confirm_password', __('Confirm Password')) }}
                                            <input class="form-control" name="confirm_password" type="password" id="confirm_password" required autocomplete="confirm_password" placeholder="{{ __('Confirm New Password') }}">
                                            @error('confirm_password')
                                            <span class="invalid-confirm_password" role="alert">
                                                     <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        {{Form::submit(__('Save Changes'),['class'=>'btn btn-primary'])}}
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
