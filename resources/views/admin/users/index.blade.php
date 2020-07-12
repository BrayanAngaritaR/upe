@extends('admin.layouts.app')

@section('page-title', __('Users List') )

@section('header-actions')

@endsection

@push('stylesheets')

@endpush

@section('content')
    @can('Manage User')
        <div class="row" style="display: none;">
            <div class="col-md-12">
                {{ Form::open(['method' => 'POST', 'route' => ['upload.txt.file'], 'files'=>'true']) }}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="uploadfile">
                        <input type="submit" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card common-list-card">
                    <div class="card-header">
                        <h4>{{ __('Users List') }}</h4>
                        @can('Create User')
                            <button type="button" class="btn btn-icon icon-left btn-primary" data-ajax-popup="true" data-size="lg"
                                    data-title="{{ __('Add User') }}" data-url="{{route('users.create')}}"><i class="fa fa-plus mr-2"></i>{{ __('Add User') }}</button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped common-datatable">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->is_active == 1)
                                                @can('Edit User')
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                                                @endcan

                                                @can('Delete User')
                                                    <a href="#" class="btn @if($user->user_status == 1) btn-success @else btn-danger @endif btn-sm" data-toggle="sweet-alert"
                                                       data-confirm="{{ __('Are You Sure?') }}|{{ __('Do you want to change status?') }}"
                                                       data-button-text="Change"
                                                       data-confirm-yes="document.getElementById('status-form-{{$user->id}}').submit();">
                                                        @if($user->user_status == 1) {{__('Active')}} @else {{__('Deactive')}} @endif
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$user['id']}}').submit();">
                                                        {{__('Delete')}}
                                                    </a>

                                                    {!! Form::open(['method' => 'PATCH', 'route' => ['user.status', $user->id],'id' => 'status-form-'.$user->id]) !!}
                                                    {!! Form::close() !!}

                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            @else
                                                <a href="#" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                            @endif
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
    @endcan
@endsection
