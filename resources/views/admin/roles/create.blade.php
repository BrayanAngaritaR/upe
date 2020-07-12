{{ Form::open(['url' => 'roles']) }}

<div class="form-group">
    {{ Form::label('name', __('Role Name')) }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter new role name')]) }}
</div>

@if(!empty($permissions) && count($permissions) > 0)
    {{ Form::label('permission', __('Assign Permission'), ['class' => 'form-label']) }}

    <div class="custom-control custom-checkbox float-right">
        {{ Form::checkbox('select-all', false, null, ['class' => 'custom-control-input', 'id' => 'select-all']) }}
        {{ Form::label('select-all', 'Select All', ['class' => 'custom-control-label']) }}
    </div>

    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th width="200px">{{__('Module')}}</th>
                        <th class="text-center">{{__('Permissions')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        $modules = ['User', 'Role', 'Profile'];
                    ?>
                    @foreach($modules as $module)
                        <tr>
                            <td>{{__($module)}}</td>

                            <td>
                                <div class="row">
                                    <?php
                                    $internalPermission = ['Manage', 'Create', 'Edit', 'Delete', 'Buy']
                                    ?>
                                    @foreach($internalPermission as $ip)
                                        @if(in_array($ip . ' ' . $module,$permissions))
                                            @php($key = array_search($ip . ' ' . $module, $permissions))
                                            <div class="col-3 custom-control custom-checkbox">
                                                {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                                {{ Form::label('permission_'.$key, $ip ,['class'=>'custom-control-label']) }}
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>{{__('Account')}}</td>
                        <td>
                            <div class="row">
                                <?php
                                    $customPermission = ['Email Settings', 'Manage Logos', 'Create Language', 'Change Language', 'Manage Language', 'Change Password', 'System Settings', 'Billing Settings', 'Store Settings', 'Manage Purchases', 'Manage Sales', 'Manage Order'];
                                ?>
                                @foreach($customPermission as $p)
                                    @if(in_array($p, $permissions))
                                        @php($key = array_search($p, $permissions))
                                        <div class="col-4 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, $p,['class'=>'custom-control-label']) }}
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Create') }}">
</div>

{{ Form::close() }}
