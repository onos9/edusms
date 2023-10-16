@extends('backEnd.master')
@section('title') 
    @lang('parentregistration::parentRegistration.settings')
@endsection
@section('mainContent')
 <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 4px;
            bottom: 1px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .buttons_div_one{
        /* border: 4px solid #FFFFFF; */
        border-radius:12px;

        padding-top: 0px;
        padding-right: 5px;
        padding-bottom: 0px;
        margin-bottom: 4px;
        padding-left: 0px;
         }
        .buttons_div{
        border: 4px solid #19A0FB;
        border-radius:12px
        }
        .school-table-style tr th {
            padding: 10px 18px 10px 10px;
        }
        .school-table-style tr td{
            padding: 10px 10px 0px 10px;
            color: #415094;
        }
        .school-table-style table, th, td {
        border: 1px solid #d6d2d2;
        border-collapse: collapse;
        }
        .school-table-style {
            background: #ffffff;
             padding: 0px; 
            border-radius: 0px;
            /* box-shadow: 0px 10px 15px rgb(236 208 244 / 30%); */
            margin: 0 auto;
            clear: both;
            /* border-collapse: separate; */
            border-spacing: 0;
        }
        .buttonColor{
            color:#a336eb;
        }
    </style>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('parentregistration::parentRegistration.registration_settings')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('parentregistration::parentRegistration.registration')</a>
                <a href="#">@lang('parentregistration::parentRegistration.settings')</a>
            </div>
        </div>
    </div>
</section> 
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                  
                    <div class="white-box"> 
                            
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'parentregistration/settings', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                       
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <h3 class="text-center">@lang('parentregistration::parentRegistration.registration_settings')</h3>
                                    <hr>


                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">@lang('parentregistration::parentRegistration.registration') </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_permission" id="relationFather" value="1" class="common-radio relationButton" {{@$setting->registration_permission == 1? 'checked': ''}}>
                                                                    <label for="relationFather">@lang('common.enable')</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_permission" id="relationMother" value="2" class="common-radio relationButton" {{@$setting->registration_permission == 2? 'checked': ''}}>
                                                                    <label for="relationMother">@lang('common.disable')</label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row ">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">@lang('parentregistration::parentRegistration.registration_button')</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class=" radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="position" id="positionF" value="1" class="common-radio relationButton"  {{@$setting->position == 1? 'checked': ''}}>
                                                                    <label for="positionF">@lang('parentregistration::parentRegistration.header')</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="position" id="positionM" value="2" class="common-radio relationButton"  {{@$setting->position == 2? 'checked': ''}}>
                                                                    <label for="positionM">@lang('parentregistration::parentRegistration.footer')</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">@lang('parentregistration::parentRegistration.after_registration_mail_send') </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_after_mail" id="registration_after_mailF" value="1" class="common-radio relationButton"  {{@$setting->registration_after_mail == 1? 'checked': ''}}>
                                                                    <label for="registration_after_mailF">@lang('common.yes')</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_after_mail" id="registration_after_mailM" value="2" class="common-radio relationButton"  {{@$setting->registration_after_mail == 2? 'checked': ''}}>
                                                                    <label for="registration_after_mailM">@lang('common.no')</label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">@lang('parentregistration::parentRegistration.after_registration_approve_mail_send') </p>
                                                </div>
                                               <div class="col-lg-7">
                                                   
                                                        <div class="radio-btn-flex ml-20">
                                                             <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="approve_after_mail" id="approve_after_mailF" value="1" class="common-radio relationButton"  {{@$setting->approve_after_mail == 1? 'checked': ''}}>
                                                                    <label for="approve_after_mailF">@lang('common.yes')</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="approve_after_mail" id="approve_after_mailM" value="2" class="common-radio relationButton"  {{@$setting->approve_after_mail == 2? 'checked': ''}}>
                                                                    <label for="approve_after_mailM">@lang('common.no')</label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10">@lang('parentregistration::parentRegistration.recaptcha') </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="recaptcha" id="recaptchaF" value="1" class="common-radio relationButton" {{@$setting->recaptcha == 1? 'checked': ''}}>
                                                                    <label for="recaptchaF">@lang('common.enable')</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="recaptcha" id="recaptchaM" value="2" class="common-radio relationButton" {{@$setting->recaptcha == 2? 'checked': ''}}>
                                                                    <label for="recaptchaM">@lang('common.disable')</label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="https://www.google.com/recaptcha/admin/create" target="_blank">@lang('parentregistration::parentRegistration.click_for_recaptcha_create')</a>
                                        </div>

                                    </div>
                                   
                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control{{ $errors->has('nocaptcha_sitekey') ? ' is-invalid' : '' }}" type="text" name="nocaptcha_sitekey" value="{{@$setting->nocaptcha_sitekey}}">
                                                <label>@lang('parentregistration::parentRegistration.nocaptcha_sitekey') <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('nocaptcha_sitekey'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nocaptcha_sitekey') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control{{ $errors->has('nocaptcha_secret') ? ' is-invalid' : '' }}" type="text" name="nocaptcha_secret" value="{{@$setting->nocaptcha_secret}}">
                                                <label>@lang('parentregistration::parentRegistration.nocaptcha_secret')</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('nocaptcha_secret'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('nocaptcha_secret') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- footer not added by -abu nayem --}}
                                                                       

                                    <div class="row mt-40 mb-40">
                                        <div class="col-lg-6">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="primary-input date form-control" id="startDate" type="text" name="start_date" value="{{ optional($setting->start_date)->format('m/d/Y') }}" readonly="">
                                                            <label>@lang('parentregistration::parentRegistration.start_date')</label>
                                                            <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="" type="button">
                                                        <i class="ti-calendar" id="start-date-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            @if ($errors->has('start_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="primary-input date form-control" id="endDate" type="text" name="end_date" value="{{ optional($setting->end_date)->format('m/d/Y')}}" readonly="">
                                                            <label>@lang('parentregistration::parentRegistration.end_date')</label>
                                                            <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="" type="button">
                                                        <i class="ti-calendar" id="end-date-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            @if ($errors->has('end_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="row mt-40 mb-40">
                                        <div class="col-lg-6">
                                            <label for="">@lang('parentregistration::parentRegistration.before_start_msg')</label> 
                                            <input type="text" class="primary-input form-control{{ $errors->has('before_start_msg') ? ' is-invalid' : '' }}" name="before_start_msg" id="" value="{{ $setting->before_start_msg }}">
                                            <span>{{ __('parentregistration::parentRegistration.You can use {START_DATE}, {END_DATE} as variable for show dynamic date on message') }}</span>
                                            @if ($errors->has('before_start_msg'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('before_start_msg') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">@lang('parentregistration::parentRegistration.after_end_msg')</label> 
                                            <input type="text" class="primary-input form-control{{ $errors->has('after_end_msg') ? ' is-invalid' : '' }}" name="after_end_msg" id="" value="{{ $setting->after_end_msg }}">
                                            <span>{{ __('parentregistration::parentRegistration.You can use {START_DATE}, {END_DATE} as variable for show dynamic date on message') }}</span>
                                            @if ($errors->has('after_end_msg'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('after_end_msg') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-40 mb-40">
                                        <div class="col-12">
                                            <div class="form-group input-group text-lowercase align-items-center">
                                                {{ url('/online') }}/
                                                <input
                                                    class="primary-input form-control {{ $errors->has('url') ? ' is-invalid' : '' }} p-0 px-3 m-0"
                                                    type="text" name='url' id="domain" placeholder="Choose a url" value="{{ $setting->url }}" />
                                                    @if ($errors->has('url'))
                                                    <span class="invalid-feedback " role="alert">
                                                        <strong>{{ $errors->first('url') }}</strong>
                                                    </span>
                                                    @endif
                                                
                                            </div>
                                        </div>
                                    </div>


                                    {{-- footer not added by -abu nayem --}}
                                    
                                    <div class="row mb-40 mt-40">  
                                                                             
                                        <div class="col-lg-12">
                                            <label for="">@lang('parentregistration::parentRegistration.footer_note')</label> 
                                            <input type="text" class="primary-input form-control{{ $errors->has('footer_note_text') ? ' is-invalid' : '' }}" name="footer_note_text" id="" value="{{ $setting->footer_note_text }}">
                                        </div>
                                    </div>
                                    {{-- end --}}
                                    @if(userPermission(548))

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" id="_submit_btn_admission">
                                                <span class="ti-check"></span>
                                                @lang('common.save') 
                                            </button>
                                        </div>
                                    </div>

                                    @endif
                                    
                                </div>
                            </div>
                            {{ Form::close() }}
                            {{-- add online registration field --abunayem --}}
                            <div class="row mt-40">
                                @php
                                $count=$fields->count();
                                $half = round($count / 2);
                                @endphp
                              @foreach($fields as $field)
                                @if($loop->iteration == 1 or $loop->iteration == $half+1)
                                <div class="col-lg-6">
                                    <table class="display school-table school-table-style" cellspacing="0" width="100%">
                                        <thead>
                                                <tr>
                                                    <th>@lang('parentregistration::parentRegistration.online_student_registration_display')</th>
                                                    <th>@lang('common.status')</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @endif
                                                <tr>
                                                    <td> <strong>{{$field->label_name==null ? __('parentregistration::parentRegistration.'.$field->field_name) : $field->label_name}} </strong> <a  class="btn"> <i class="fa fa-edit buttonColor" data-toggle="modal" data-target="#update_{{$field->id}}"></i> </a></td>
                                                    <td>
                                                    <label class="switch">
                                                        <input type="checkbox" data-id="{{$field->id}}"
                                                                class="field_switch_btn"
                                                                {{@$field->active_status == 0? '':'checked'}} {{$field->is_required==1 ? "disabled" :''}} >
                                                            <span class="slider round"></span>
                                                    </label>
                                                    </td>
                                                    <!--  -->
                                                </tr>
                                                @if($loop->iteration == $half or $loop->iteration == $count)
                                            </tbody>
                                    </table>
                            
                                </div>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="update_{{ $field->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    @lang('parentregistration::parentRegistration.update_label')</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {{Form::open(['class' => 'form-horizontal', 'route' => 'parentregistration/labelUpdate', 'method' => 'POST']) }}
                                
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input
                                                                    class="primary-input form-control{{ @$errors->has('name') ? ' is-invalid' : '' }}"
                                                                    type="text" name="label_name" autocomplete="off"
                                                                    value="{{ $field->label_name == null ? __('parentregistration::parentRegistration.' . $field->field_name) : $field->label_name }}">
                                                                <input type="hidden" name="id" value="{{ $field->id }}">
                                                                <label>@lang('common.name') <span>*</span></label>
                                                                <span class="focus-border"></span>
                                
                                                            </div>
                                                        </div>
                                                        @if (!$field->is_required)
                                                            <div class="col-md-12 mt-20">
                                                                <label
                                                                    for="">@lang('parentregistration::parentRegistration.online_student_registration_display')</label>
                                                                <div class="d-flex radio-btn-flex">
                                                                    <div class="mr-30">
                                                                        <input type="radio" name="status" id="yes_{{ $field->id }}" value="1"
                                                                            class="common-radio relationButton"
                                                                            {{ @$field->active_status == 1 ? 'checked' : '' }}>
                                                                        <label for="yes_{{ $field->id }}">@lang('common.yes')</label>
                                                                    </div>
                                                                    <div class="mr-30">
                                                                        <input type="radio" name="status" id="no_{{ $field->id }}" value="0"
                                                                            class="common-radio relationButton"
                                                                            {{ @$field->active_status == 0 ? 'checked' : '' }}>
                                                                        <label for="no_{{ $field->id }}">@lang('common.no')</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <input type="hidden" name="status" value="1">
                                                        @endif
                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.close')</button>
                                                <button type="submit" class="primary-btn fix-gr-bg">@lang('common.update')</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                @endforeach
                               
                            </div>

                    </div>
                    
                </div>

            </div>

          
        </div>
    </section>



@endsection

@push('script')
<script>
    $(document).ready(function() {
            $(".field_switch_btn").on("change", function() {
                var filed_id = $(this).data("id");
                
                if ($(this).is(":checked")) {
                    var field_status = "1";
                } else {
                    var field_status = "0";
                }
                
                
                var url = $("#url").val();
                

                $.ajax({
                    type: "POST",
                    data: {'field_status': field_status, 'filed_id': filed_id},
                    dataType: "json",
                    url: url + "/" + "parentregistration/field/switch",
                    success: function(data) {
                        //  location.reload();
                        setTimeout(function() {
                            toastr.success(
                                "Operation Success!",
                                "Success Alert", {
                                    iconClass: "customer-info",
                                }, {
                                    timeOut: 2000,
                                }
                            );
                        }, 500);
                        // console.log(data);
                    },
                    error: function(data) {
                        // console.log('no');
                        setTimeout(function() {
                            toastr.error("Operation Not Done!", "Error Alert", {
                                timeOut: 5000,
                            });
                        }, 500);
                    },
                });
            });
        });
</script>
@endpush
