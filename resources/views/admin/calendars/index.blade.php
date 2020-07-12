@extends('admin.layouts.app')
@section('page-title')
    {{__('Event')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card calendar-card">
                <div class="card-header">
                    <h4>Calendar</h4>
                    <a href="#" data-url="{{ route('calendars.create') }}" class="btn btn-sm btn-primary btn-round btn-icon" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Event')}}" data-original-title="{{__('Create Event')}}">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
                <div class="card-body">
                    <div class="fc-overflow">
                        <div data-toggle="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('stylesheets')
        <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>

        <script>
            $(function () {

                $('[data-toggle="calendar"]').fullCalendar({
                    height: 'auto',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    editable: true,
                    events: {!! $calendarEvents !!},
                });

                $(document).on('click', '.fc-day-grid-event', function (e) {
                    e.preventDefault();
                    var event = $(this);
                    var title = $(this).find('.fc-content .fc-title').text();
                    var url = $(this).attr('href');
                    $("#commonModal .modal-title").text(title);
                    $("#commonModal .modal-dialog").addClass('modal-md');
                    $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function (data) {
                            $('#commonModal .modal-body').html(data);
                            $("#commonModal").modal('show');

                            $('.datepicker').daterangepicker({
                                singleDatePicker: true,
                                format: 'yyyy-mm-dd',
                                locale: {format: 'YYYY-MM-DD'},
                                // todayHighlight: true,
                            });
                        },
                    });
                });
            });

        </script>
    @endpush
@endsection

