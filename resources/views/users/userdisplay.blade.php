@extends('layouts.app')
@section('content')
<style>
    span{
        display: inline-block;
    }
    h6{
        margin-bottom: .86rem;
    }
</style>
<div class="d-flex justify-content-sm-around justify-content-md-start">
    <span class="mr-md-3 ml-md-3">
        <h5>{{__('msg.ID')}}: </h5>
    <h5>{{__('msg.Arabic Name')}}: </h5>
    <h5>{{__('msg.English Name')}}: </h5>
    <h5>{{__('msg.Email')}}: </h5>
    <h5>{{__('msg.Age')}}: </h5>
    <h5>{{__('msg.College')}}: </h5>
    <h5>{{__('msg.Division')}}: </h5>
    <h5>{{__('msg.Mobile Number')}}: </h5>
</span>
<span class="mr-md-3 ml-md-3">
    <h6>{{Auth::user()->id}}</h6>
    <h6>{{Auth::user()->name_ar}}</h6>
    <h6>{{Auth::user()->name_en}}</h6>
    <h6>{{Auth::user()->email}}</h6>
    <h6>{{Auth::user()->age}}</h6>
    <h6>{{Auth::user()->college}}</h6>
    <h6>{{Auth::user()->division}}</h6>
    <h6>{{Auth::user()->mobile}}</h6>
</span>
</div>
<br>
<div class="mr-md-3 ml-md-3 @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
 <!-- Button trigger modal -->
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
        {{__('msg.are you sure you want to delete this account')}}
        </div>
        <div class="modal-footer">
            <a href='{{ url('user/delete/'.Auth::user()->id) }}' class='btn btn-danger m-r-1em'>{{__('msg.Delete Account')}}</a>
        </div>
    </div>
    </div>
</div>
<a href='{{ url('user/edit/'.Auth::user()->id) }}' class='btn btn-primary m-1'>{{__('msg.Edit Info')}}</a>
<a href='{{ url('user/problems/'.Auth::user()->id) }}' class='btn btn-primary m-1'>{{__('msg.My Problems')}}</a>
</div>
@endsection
