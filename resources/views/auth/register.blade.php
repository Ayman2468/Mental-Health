@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
                <div class="card-header">{{ __('msg.Registration') }}</div>

                <div class="card-body text-center">
                    @if(session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        <strong>{{session()->get('success')}}</strong>
                                    </div>
                    @endif
                    @if(session()->has('ident'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{session()->get('ident')}}</strong>
                                    </div>
                    @endif
                    <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{__('msg.Name_ar')}}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" autocomplete="name" autofocus>

                                @error('name_ar')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{__('msg.Name_en')}}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" autocomplete="name" autofocus>

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
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" autocomplete="current-password">

                                @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('msg.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordconfirm" class="col-md-4 col-form-label text-md-right">{{ __('msg.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordconfirm" type="password" class="form-control @error('passwordconfirm') is-invalid @enderror" name="passwordconfirm" value="{{old('passwordconfirm')}}" required autocomplete="new-password">
                                @error('passwordconfirm')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('msg.Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{old('age')}}" autocomplete="current-password">

                                @error('age')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('msg.College') }}</label>

                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control @error('college') is-invalid @enderror" name="college" value="{{old('college')}}" autocomplete="current-password">

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
                                <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{old('division')}}" autocomplete="current-password">

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
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{old('division')}}" autocomplete="current-password">

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
                                    {{ __('msg.Regist') }}
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
