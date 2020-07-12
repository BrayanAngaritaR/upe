{{ Form::open(['url' => 'permissions', 'class' => 'repeater']) }}

<div class="form-group" id="repeaterform">
    {{ Form::label('name', __('Name')) }}
    <div class="repeater input-group col-xs-3">
        {{ Form::text('permissions[]', null, ['class' => 'form-control', 'placeholder' => __('Enter new Permission Name')]) }}
        <span class="input-group-btn">
            <button type="button" class="btn btn-success btn-sm btn-add">
                <i class="fa fa-plus"></i>
            </button>
        </span>
    </div>
</div>

@if(!$roles->isEmpty())
    <h5>{{ __('Assign Permission to Roles') }}</h5>
    <div class="form-group">
        @foreach ($roles as $key => $role)
            <div class="custom-control custom-checkbox">
                {{ Form::checkbox('roles[]', $role->id, null, ['class' => 'custom-control-input', 'id' => $key]) }}
                {{ Form::label($key, ucfirst($role->name), ['class' => 'custom-control-label']) }}
            </div>
        @endforeach
    </div>
@endif

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Create') }}">
</div>

<script>
    $(document).ready(function () {
        $('form').submit(function () {
            var error = true;
            $('input[name="permissions[]"').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass("error");
                    $(this).focus();
                    error = false;
                } else {
                    $(this).removeClass("error");
                }
            });
            return error;
        });
    });
</script>
{{ Form::close() }}
