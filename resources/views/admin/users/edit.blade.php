@extends('admin.layouts.app')

@if(Auth::user()->type == 'user')
    @section('page-title', __('My Profile') )
@else
    @section('page-title', __('Edit User') )
@endif

@section('header-actions')

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            {{ Form::label('dni', __('DNI')) }}
                            <div class="input-group">
                                {{ Form::text('dni', null, ['class' => 'form-control', 'placeholder' => __('Enter DNI Number')]) }}
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">{{ __('WS RENIEC') }}</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('last_name', __('Last Name')) }}
                            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Last Name')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('mother_last_name', __("Mother's Last Name")) }}
                            {{ Form::text('mother_last_name', null, ['class' => 'form-control', 'placeholder' => __("Enter Mother's Last Name")]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('name', __('Name')) }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name')]) }}
                        </div>

                        <div class="form-group col-md-6">
                            {{ Form::label('residence_address', __('Residence Address')) }}
                            {{ Form::textarea('residence_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Residence Address')]) }}
                        </div>

                        <div class="form-group col-md-6">
                            {{ Form::label('residence_reference', __('Residence Reference')) }}
                            {{ Form::textarea('residence_reference', null, ['class' => 'form-control', 'placeholder' => __('Enter Residence Reference')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('user_role', __('Role')) }}
                            {{ Form::select('user_role', ['' => 'Select', 'office' => 'Office', 'final_user' => 'Final User'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('residence_department', __('Residence Department')) }}
                            {{ Form::select('residence_department', $residence_department, null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('province_of_residence', __('Province of Residence')) }}
                            {{ Form::select('province_of_residence', $province_residence, null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('district_of_residence', __('District of Residence')) }}
                            {{ Form::select('district_of_residence', $district_residence, null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('command_team', __('Command Team')) }}
                            {{ Form::select('command_team', ['Select','Key Work Team','Key Sub Team','Does not apply'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('institutional_mail', __('Institutional Mail')) }}
                            {{ Form::text('institutional_mail', null, ['class' => 'form-control', 'placeholder' => __('Enter Institutional Mail')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('birthdate', __('Birthdate')) }}
                            <div class="input-group">
                                {{ Form::date('birthdate', null, ['class' => 'form-control', 'placeholder' => __('Select Birth Date')]) }}
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">{{ __('Calculate') }}</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('blood_type', __('Blood Type')) }}
                            {{ Form::select('blood_type', ['Select','A+','A-','B+','B-','O+','O-','AB+','AB-'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('sex', __('Sex')) }}
                            {{ Form::select('sex', ['Select','Male','Female'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('marital_status', __('Marital Status')) }}
                            {{ Form::select('marital_status', ['Select','Married','Single', 'Widower', 'Divorced'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('pension_scheme', __('Pension Scheme')) }}
                            {{ Form::select('pension_scheme', ['Select','INTEGRA AFP','AFP PRIMA','PROFUTURO AFP','AFP HABITAT','SNP','NONE'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('cuss_number', __('CUSS No.')) }}
                            {{ Form::text('cuss_number', null, ['class' => 'form-control', 'placeholder' => __('Enter CUSS No.')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('personal_mail', __('Personal Mail')) }}
                            {{ Form::email('personal_mail', null, ['class' => 'form-control', 'placeholder' => __('Enter Personal Mail')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('mobile_number', __('Mobile Number')) }}
                            {{ Form::text('mobile_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Mobile Number')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('phone_number', __('Phone Number')) }}
                            {{ Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone Number')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('passport_number', __('Passport Number')) }}
                            {{ Form::text('passport_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Passport Number')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('brief_number', __('Brief Number')) }}
                            {{ Form::text('brief_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Brief Number')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('brief_type', __('Brief Type')) }}
                            {{ Form::select('brief_type', ['A - I','A - IIa', 'A - IIb', 'A - IIIa', 'A - IIIb', 'A - IIIc'], null, ['class' => 'form-control', 'placeholder' => __('Select Brief Number')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('expire_brief_date', __('Expire Brief')) }}
                            {{ Form::date('expire_brief_date', null, ['class' => 'form-control', 'placeholder' => __('Select Expire Brief Date')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('higher_income_earner', __('Higher Income Earner')) }}
                            {{ Form::select('higher_income_earner', ['No','Yes'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('type_of_disability', __('Type of Disability')) }}
                            {{ Form::text('type_of_disability', null, ['class' => 'form-control', 'placeholder' => __('Enter Type of Disability')]) }}
                        </div>

                        <div class="form-group col-md-3">
                            {{ Form::label('conadis_registration', __('CONADIS Registration')) }}
                            {{ Form::text('conadis_registration', null, ['class' => 'form-control', 'placeholder' => __('Enter CONADIS Registration')]) }}
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="table-responsive allergies-diseases-repeater" data-value="{{ $user->getAllergiesDiseases() }}">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <button type="button" data-repeater-create class="btn btn-icon icon-left btn-primary"><i class="fa fa-folder-plus mr-2"></i>{{ __('Allergies / Diseases') }}</button>
                                        </div>
                                        <table class="table table-sm mt-4" data-repeater-list="allergies">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Special Attention') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-repeater-item>
                                                <td>
                                                    <input type="text" name="name" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="special_attention" class="form-control" required/>
                                                </td>
                                                <td class="stage-remove text-center">
                                                    <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="table-responsive emergency-numbers-repeaters" data-value="{{ $user->getEmergencyNumbers() }}">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <button type="button" data-repeater-create class="btn btn-icon icon-left btn-primary"><i class="fa fa-folder-plus mr-2"></i>{{ __('Emergency Numbers') }}</button>
                                        </div>
                                        <table class="table table-sm mt-4" data-repeater-list="emergencies">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Family Bond') }}</th>
                                                <th>{{ __('Surnames and Names') }}</th>
                                                <th>{{ __('Phones') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-repeater-item>
                                                <td>
                                                    <input type="text" name="family_bond" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="surnames_names" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="phones" class="form-control" required/>
                                                </td>
                                                <td class="stage-remove text-center">
                                                    <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="table-responsive families-data-repeaters" data-value="{{ $user->getFamilyData() }}">
                                        <div class="col-md-12 pl-0 pr-0">
                                            <button type="button" data-repeater-create class="btn btn-icon icon-left btn-primary"><i class="fa fa-folder-plus mr-2"></i>{{ __('Family Data') }}</button>
                                        </div>
                                        <table class="table table-sm mt-4" data-repeater-list="families">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Family Bond') }}</th>
                                                <th>{{ __('Surnames and Names') }}</th>
                                                <th>{{ __('Age') }}</th>
                                                <th>{{ __('DNI') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Social Networks') }}</th>
                                                <th>{{ __('Important Medical Information') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-repeater-item>
                                                <td>
                                                    <input type="text" name="family_bond" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="surnames_names" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="age" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="dni" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="email" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="phone" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="social_networks" class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="text" name="medical_information" class="form-control" required/>
                                                </td>
                                                <td class="stage-remove text-center">
                                                    <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="button" class="btn btn-secondary btn-md">{{ __('Cancel') }}</button>
                    <input class="btn btn-success btn-md" type="submit" value="{{ __('Save') }}">

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('stylesheets')

@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/repeater.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var $ADRepeater = $('.allergies-diseases-repeater').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                isFirstItemUndeletable: true
            });

            var value = JSON.parse($('.allergies-diseases-repeater').attr('data-value'));

            if (typeof value != 'undefined' && value.length > 0) {
                $ADRepeater.setList(value);
            }

            var $ENRepeater = $('.emergency-numbers-repeaters').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                isFirstItemUndeletable: true
            });

            var value = JSON.parse($('.emergency-numbers-repeaters').attr('data-value'));

            if (typeof value != 'undefined' && value.length > 0) {
                $ENRepeater.setList(value);
            }

            var $FDRepeater = $('.families-data-repeaters').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                isFirstItemUndeletable: true
            });

            var value = JSON.parse($('.families-data-repeaters').attr('data-value'));

            if (typeof value != 'undefined' && value.length > 0) {
                $FDRepeater.setList(value);
            }
        });
        $(document).on('change', '#residence_department', function (e) {
            $.ajax({
                url: '{{ route('get.province.of.residence') }}',
                data: {
                    'department_id': $(this).val()
                },
                success: function (data) {
                    $('#province_of_residence').find('option').not(':first').remove();
                    $('#district_of_residence').find('option').not(':first').remove();
                    $.each(data, function (key, value) {
                        $('#province_of_residence')
                            .append($("<option></option>")
                                .attr("value", value)
                                .text(key));
                    });
                },
            });
        });
        $(document).on('change', '#province_of_residence', function (e) {
            $.ajax({
                url: '{{ route('get.district.of.residence') }}',
                data: {
                    'province_id': $(this).val()
                },
                success: function (data) {
                    $('#district_of_residence').find('option').not(':first').remove();
                    $.each(data, function (key, value) {
                        $('#district_of_residence')
                            .append($("<option></option>")
                                .attr("value", value)
                                .text(key));
                    });
                },
            });
        });
    </script>
@endpush
