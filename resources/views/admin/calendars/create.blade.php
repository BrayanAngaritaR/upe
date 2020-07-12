{{Form::open(['url'=>'calendars','method'=>'post'])}}
<div class="card-body p-0">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Event Title'))}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Event Title')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Event start Date'))}}
                {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('Event End Date'))}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('color',__('Event Select Color'))}}
                <div class="row gutters-xs">
                    <?php
                    $colors = [
                        'primary' => '#6777ef',
                        'secondary' => '#cdd3d8',
                        'danger' => '#fc544b',
                        'warning' => '#ffa426',
                        'info' => '#3abaf4',
                        'success' => '#63ed7a',
                    ];
                    ?>
                    @foreach($colors as $key => $color)
                        <div class="col-auto">
                            <label class="colorinput">
                                <input name="color" type="radio" value="{{ $color }}" class="colorinput-input" {{ $key == 'primary' ? 'checked' : '' }} autocomplete="off"/>
                                <span class="colorinput-color bg-{{ $key }}"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Event Description'))}}
                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Event Description')))}}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer pr-0">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
</div>
{{Form::close()}}
