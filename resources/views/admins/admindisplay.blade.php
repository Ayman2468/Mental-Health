@extends('layouts.app')
@section('content')
<style>
    span{
        display: inline-block;
    }
    h6{
        margin-bottom: .8rem;
    }
</style>
@if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            <strong>{{session()->get('message')}}</strong>
        </div>
        @endif
<div hidden>{{$admindata=request()->session()->get('admindata')}}</div>
<div class="d-flex justify-content-sm-around justify-content-md-start">
<span class="mr-md-3 ml-md-3">
    <h5>{{__('msg.ID')}}: </h5>
    <h5>{{__('msg.Arabic Name')}}: </h5>
    <h5>{{__('msg.English Name')}}: </h5>
    <h5>{{__('msg.Email')}}: </h5>
    <h5>{{__('msg.College')}}: </h5>
    <h5>{{__('msg.Division')}}: </h5>
    <h5>{{__('msg.Mobile Number')}}: </h5>
</span>
<span class="mr-md-3 ml-md-3">
    <h6>{{$admindata->id}}</h6>
    <h6>{{$admindata->name_ar}}</h6>
    <h6>{{$admindata->name_en}}</h6>
    <h6>{{$admindata->email}}</h6>
    <h6>{{$admindata->college}}</h6>
    <h6>{{$admindata->division}}</h6>
    <h6>{{$admindata->mobile}}</h6>
</span>
</div>
<br>
<div>
</div>
<div class="mr-md-3 ml-md-3 @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
    <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModal">
    {{__('msg.Delete')}}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('msg.Delete Confirmation')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        {{__('msg.are you sure you want to delete your admin account')}}
        </div>
        <div class="modal-footer">
            <a href='{{ url('admin/delete/'.$admindata->id) }}' class='btn btn-danger'>{{__('msg.Delete Your Admin Account')}}</a>
        </div>
    </div>
    </div>
</div>
<a href='{{ url('admin/edit/'.$admindata->id) }}' class='btn btn-primary m-1'>{{__('msg.Edit Your Admin Data')}}</a>
<a href='{{ url('admin/problems/'.$admindata->id) }}' class='btn btn-primary m-1'>{{__('msg.Problems I have solved')}}</a>
</div>
@endsection
