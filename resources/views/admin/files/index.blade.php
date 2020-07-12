@extends('admin.layouts.app')

@section('page-title', __('All files') )


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card common-list-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped common-datatable">
                            <thead>
                            <tr>
                                <th>{{ __('Filename') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('View') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file->filename }}</td>
                                    <td>{{ $file->user->name }}</td>
                                    <td>
                                    	<a href="{{ env('APP_URL') }}/{{ $file->url }}" target="_blank">
                                    		Ver archivo
                                    	</a>
                                    </td>
                                    <td>{{ $file->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection