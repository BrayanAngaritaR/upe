{{ Form::open(['url' => 'users']) }}

<div class="form-row mb-3">
    <div class="form-group col-md-6">
        {{ Form::label('name', __('Name')) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter new user name'), 'required' => 'required']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('institutional_mail', __('Institutional Mail')) }}
        {{ Form::email('institutional_mail', null, ['class' => 'form-control', 'placeholder' => __('Enter Institutional Mail'), 'required' => 'required']) }}
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Create') }}">
</div>

{{ Form::close() }}
