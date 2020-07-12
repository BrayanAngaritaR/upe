{{ Form::model($notification, ['route' => ['notifications.update', $notification->id], 'method' => 'PUT']) }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('from', __('From')) }}
            {{ Form::text('from', null, ['class' => 'form-control', 'id' => 'from', 'placeholder' => __('Select from date')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('to', __('To')) }}
            {{ Form::text('to', null, ['class' => 'form-control', 'id' => 'to', 'placeholder' => __('Select to date')]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('color', __('Notification color'), ['class' => 'd-block']) }}
            <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
                <?php $colors = [ 'info', 'warning', 'danger', 'success', 'default', 'primary' ]; ?>
                @foreach($colors as $color)
                    <label class="btn bg-{{ $color }} {{ $notification->color == $color ? 'active' : '' }}">
                        <input type="radio" name="color" value="{{ $color }}" {{ $notification->color == $color ? 'checked' : '' }} autocomplete="off">
                    </label>
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
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Edit') }}">
</div>

{{ Form::close() }}
