@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
                <div class="card-header">{{ __('msg.admin data editing') }}</div>

                <div class="card-body text-center">
                    @if(session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        <strong>{{session()->get('success')}}</strong>
                                    </div>
                    @endif
                    <form method="POST" action="{{route('admins.update',$admindata->id)}}" enctype="multipart/form-data">
                        @csrf


                                <input type="text" name="id" value="{{ $admindata->id }}" hidden>

                        <div class="form-group row">
                            <label for="adminname" class="col-md-4 col-form-label text-md-right">{{__('msg.Name_ar')}}</label>

                            <div class="col-md-6">
                                <input id="adminname" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ $admindata->name_ar }}" autocomplete autofocus>

                                @error('name_ar')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adminname" class="col-md-4 col-form-label text-md-right">{{__('msg.Name_en')}}</label>

                            <div class="col-md-6">
                                <input id="adminname" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ $admindata->name_en }}" autocomplete>

                                @error('name_en')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('msg.Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$admindata->email}}" autocomplete>

                                @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('msg.College') }}</label>

                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control @error('college') is-invalid @enderror" name="college" value="{{$admindata->college}}" autocomplete>

                                @error('college')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('msg.Division') }}</label>

                            <div class="col-md-6">
                                <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{$admindata->division}}" autocomplete>

                                @error('division')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('msg.Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$admindata->mobile}}" autocomplete>

                                @error('mobile')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('msg.Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
