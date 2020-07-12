@extends('admin.layouts.app')
@section('page-title', __('Roles List') )

@section('header-actions')

@endsection

@push('stylesheets')

@endpush

@section('content')
    @can('Manage Role')

        <div class="row">
            <div class="col-12">
                <div class="card common-list-card">
                    <div class="card-header">
                        <h4>{{ __('Roles List') }}</h4>
                        <button type="button" class="btn btn-icon icon-left btn-primary" data-ajax-popup="true" data-size="lg"
                                    data-title="{{ __('Add Role') }}" data-url="{{route('roles.create')}}"><i class="fa fa-plus mr-2"></i>{{ __('Add Role') }}</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped common-datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Permissions') }}</th>
                                    <th>{{ __('Operation') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="td-white-space">
                                            @foreach($role->permissions()->pluck('name') as $pername)
                                                <span class="badge badge-pill badge-primary mt-2">{{ $pername }}</span>
                                            @endforeach
                                        </td>
                                        <td class="pull-right">
                                            @can('Edit Role')
                                                <a href="#" data-ajax-popup="true" data-title="{{__('Edit Role')}}"
                                                   data-size="lg" data-url="{{route('roles.edit', $role->id)}}"
                                                   class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                                            @endcan
                                            @can('Delete Role')
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="sweet-alert"
                                                   data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                   data-confirm-yes="document.getElementById('delete-form-{{$role->id}}').submit();">
                                                    {{__('Delete')}}
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id' => 'delete-form-'.$role->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
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

@push('scripts')
    <script>
        $(document).on('click', '#select-all', function (e) {
            if (this.checked) {
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
