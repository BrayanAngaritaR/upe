@extends('admin.layouts.app')

@section('page-title', __('News List') )

@section('header-actions')

@endsection

@push('stylesheets')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card common-list-card">
                <div class="card-header">
                    <h4>{{ __('News List') }}</h4>
                    <button type="button" class="btn btn-icon icon-left btn-primary" data-size="lg" data-ajax-popup="true" data-title="{{__('Add New News')}}" data-url="{{route('news.create')}}"><i class="fa fa-plus mr-2"></i>{{ __('Add News') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped common-datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Notifications') }}</th>
                                <th>{{ __('Date/Time Added') }}</th>
                                <th>{{ __('From') }}</th>
                                <th>{{ __('To') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $key => $onenews)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="td-white-space">
                                        {!! $onenews->description !!}
                                    </td>
                                    <td>{{ Auth::user()->datetimeFormat($onenews->created_at) }}</td>
                                    <td>{{ Auth::user()->dateFormat($onenews->from) }}</td>
                                    <td>{{ Auth::user()->dateFormat($onenews->to) }}</td>
                                    <td>
                                        <div class="btn-group dropleft display-news" data-li-id="{{ $onenews->id }}">
                                            <button type="button" class="btn btn-sm {{ $onenews->status == 0 ? 'btn-success' : 'btn-danger' }} dropdown-toggle news-label" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $onenews->status == 0 ? __('Open') : __('Close') }}
                                            </button>
                                            <div class="dropdown-menu news-actions" data-id="{{ $onenews->id }}" data-url="{{ route('update.news.status', $onenews->id) }}">
                                                <a href="#" data-status="0" data-class="btn-success" class="dropdown-item news-action {{ $onenews->status == 0 ? 'selected' : '' }}">{{ __('Open') }}
                                                </a>
                                                <a href="#" data-status="1" data-class="btn-danger" class="dropdown-item news-action {{ $onenews->status == 1 ? 'selected' : '' }}">{{ __('Close') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" data-ajax-popup="true" data-title="{{__('Edit News')}}"
                                           data-size="lg"
                                           data-url="{{route('news.edit', $onenews->id)}}"
                                           class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="sweet-alert"
                                           data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                           data-confirm-yes="document.getElementById('delete-form-{{$onenews->id}}').submit();">
                                            {{__('Delete')}}
                                        </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $onenews->id],'id' => 'delete-form-'.$onenews->id]) !!}
                                        {!! Form::close() !!}
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
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        $(document).on('change', '#from, #to', function (e) {
            if ((Date.parse($('#from').val()) > Date.parse($('#to').val()))) {
                $('#to').val('');
                alert("End date should be greater than Start date");
            }
        });

        $(document).on('click', '.news-action',function(e) {
            e.stopPropagation();
            e.preventDefault();

            var ele = $(this);

            var id = ele.parent().attr('data-id');
            var url = ele.parent().attr('data-url');
            var status = ele.attr('data-status');

            $.ajax({
                url: url,
                method: 'PATCH',
                data: {
                    status: status
                },
                success: function (response) {

                    if (response) {

                        $('[data-li-id="'+id+'"] .news-action').removeClass('selected');

                        if (ele.hasClass('selected')) {

                            ele.removeClass('selected');

                        } else {
                            ele.addClass('selected');
                        }

                        var news = $('[data-li-id="'+id+'"] .news-actions').find('.selected').text().trim();

                        var news_class = $('[data-li-id="'+id+'"] .news-actions').find('.selected').attr('data-class');
                        $('[data-li-id="'+id+'"] .news-label').removeClass('btn-success btn-danger').addClass(news_class).text(news);
                    }
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('Error', data.error, 'error')
                }
            });
        });
    </script>
@endpush
