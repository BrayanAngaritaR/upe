@extends('admin.layouts.app')

@section('page-title', __('Users List') )

@section('header-actions')

@endsection

@push('stylesheets')

@endpush

@section('content')
    {{-- @can('Manage User') --}}
        <div class="row">
            <div class="col-12">
                <div class="card common-list-card">
                    <div class="card-header">
                        <h4>{{ __('File Upload') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['method' => 'POST', 'route' => ['upload.txt.file'], 'files'=>'true']) }}
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('File') }}</label>
                                    <input type="file" class="form-control" name="uploadfile">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DNI del usuario</label>
                                    <input type="text" class="form-control" name="user_document"> 

                                    @error('user_document')
                                    <span class="text-danger" role="alert">
                                        <strong>Debes ingresar un DNI y volver a subir el documento.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-primary" value="Import">
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    {{-- @endcan --}}
@endsection
