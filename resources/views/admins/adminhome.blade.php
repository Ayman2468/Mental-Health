@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
                <div class="card-header">{{ __('msg.Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{__('msg.Welcome back')}}{{__('msg.,')}} {{__('msg.admin')}} : {{ session()->get('admindata')->{'name_' . LaravelLocalization::getcurrentlocale()} }}
                    <br>
                    <a href='{{ url('admin/display') }}' class='btn btn-primary m-1'>{{__('msg.Personal Data')}}</a>
                    <a href='{{ url('problem/unsolved-problems') }}' class='btn btn-primary m-1'>{{__('msg.Answer a Problem')}}</a>
                    @if(session()->get('admindata')->position == 'master')
                    <a href='{{ url('admin/index') }}' class='btn btn-primary m-1'>{{__('msg.Control Admins')}}</a>
                    <a href='{{ url('user/index') }}' class='btn btn-primary m-1'>{{__('msg.Control Users')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
