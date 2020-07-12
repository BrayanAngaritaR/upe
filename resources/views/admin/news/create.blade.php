{{ Form::open(['url' => 'news']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('from', __('From')) }}
            {{ Form::text('from', null, ['class' => 'form-control datepicker', 'id' => 'from', 'placeholder' => __('Select from date'), 'readonly' => '']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('to', __('To')) }}
            {{ Form::text('to', null, ['class' => 'form-control datepicker', 'id' => 'to', 'placeholder' => __('Select to date'), 'readonly' => '']) }}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {{Form::label('color',__('News Color'))}}
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

    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description')) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => __('Enter Address'), 'rows' => 3, 'style' => 'resize: none']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Create') }}">
</div>

{{ Form::close() }}
