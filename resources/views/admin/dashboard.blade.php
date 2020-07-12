@extends('admin.layouts.app')

@section('page-title', __('Dashboard') )

@section('content')
<div class="row">
    {{-- @if(isset($news) && !empty($news) && count($news) > 0)
        <div class="col-md-12">
            @foreach($news as $onenews)
                <div class="alert alert-dismissible fade show" style="background: {{ $onenews->color }}" role="alert">
                    <span class="alert-text">{!! $onenews->description !!}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        </div>
    @endif --}}

    <div class="col-md-12">
        @forelse($news as $new)
            <div class="alert alert-dismissible fade show" style="background: {{ $new->color }}" role="alert">
                <span class="alert-text">{!! $new->description !!}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @empty
        <p>
            No hay noticias
        </p>
        @endforelse
    </div>

</div>
@endsection

@push('stylesheets')
@endpush

@push('scripts')

@endpush
