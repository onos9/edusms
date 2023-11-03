@extends('backEnd.master')
@section('title')
@lang('academics.objective')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('academics.objective')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('academics.academics')</a>
                <a href="#">@lang('academics.objective')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($objective))
        @if(userPermission(258))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('objective')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('common.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($objective))
                                @lang('academics.edit_objective')
                                @else
                                @lang('academics.add_objective')
                                @endif

                            </h3>
                        </div>
                        @if(isset($objective))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'objective_update', 'method' => 'POST']) }}
                        @else
                        @if(userPermission(258))

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'objective_store', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ @$errors->has('objective_name') ? ' is-invalid' : '' }}" type="text" name="objective_name" autocomplete="off" value="{{isset($objective)? $objective->objective_name: old('objective_name')}}">
                                            <input type="hidden" name="id" value="{{isset($objective)? $objective->id: ''}}">
                                            <label>@lang('academics.objective_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('objective_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ @$errors->first('objective_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="d-flex radio-btn-flex">
                                            @if(isset($objective))
                                            <div class="mr-30">
                                                <input type="radio" name="objective_type" id="relationFather" value="T" class="common-radio relationButton" {{@$objective->objective_type == 'T'? 'checked':''}}>
                                                <label for="relationFather">@lang('academics.theory')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="objective_type" id="relationMother" value="P" class="common-radio relationButton" {{@$objective->objective_type == 'P'? 'checked':''}}>
                                                <label for="relationMother">@lang('academics.practical')</label>
                                            </div>
                                            @else
                                            <div class="mr-30">
                                                <input type="radio" name="objective_type" id="relationFather" value="T" class="common-radio relationButton" checked>
                                                <label for="relationFather">@lang('academics.theory')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="objective_type" id="relationMother" value="P" class="common-radio relationButton">
                                                <label for="relationMother">@lang('academics.practical')</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('objective_code') ? ' is-invalid' : '' }}" type="text" name="objective_code" autocomplete="off" value="{{isset($objective)? $objective->objective_code: old('objective_code')}}">
                                            <label>@lang('academics.objective_code') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('objective_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ @$errors->first('objective_code') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                $tooltip = "";
                                if(userPermission(258)){
                                $tooltip = "";
                                }else{
                                $tooltip = "You have no permission to add";
                                }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($objective))
                                            @lang('academics.update_objective')
                                            @else
                                            @lang('academics.save_objective')
                                            @endif

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('academics.objective_list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    <th> @lang('common.sl')</th>
                                    <th> @lang('academics.objective')</th>
                                    <th> @lang('academics.objective_type')</th>
                                    <th>@lang('academics.objective_code')</th>
                                    <th>@lang('common.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=0; @endphp
                                @foreach($objectives as $objective)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{@$objective->objective_name}}</td>
                                    <td>{{trans('academics.'.($objective->objective_type == 'T'? 'theory':'practical'))}} </td>
                                    <td>{{@$objective->objective_code}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('common.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(userPermission(259))
                                                <a class="dropdown-item" href="{{route('objective_edit', [@$objective->id])}}">@lang('common.edit')</a>
                                                @endif
                                                @if(userPermission(260))
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteobjectiveModal{{@$objective->id}}" href="#">@lang('common.delete')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteobjectiveModal{{@$objective->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('academics.delete_objective')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('common.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                    <a href="{{route('objective_delete', [@$objective->id])}}" class="text-light">
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('common.delete')</button>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection