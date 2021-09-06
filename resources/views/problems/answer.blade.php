@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
                <div class="card-header">{{ __('msg.Create Problem') }}</div>

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
                    <form method="POST" action="{{route('problems.updatewithanswer',$problemdata->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{__('msg.Problem Title')}}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $problemdata->title }}" readonly autofocus>

                                @error('title')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{__('msg.Problem Content')}}</label>

                            <div class="col-md-6">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" cols="30" rows="15" readonly>{{ $problemdata->content }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-md-4 col-form-label text-md-right">{{__('msg.Problem Answer')}}</label>

                            <div class="col-md-6">
                                @if($problemdata->answer == 'waiting for answer')
                                <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" id="answer" cols="30" rows="15" placeholder="{{$problemdata->answer}}">{{ old('answer') }}</textarea>
                                @else
                                <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" id="answer" cols="30" rows="15">{{$problemdata->answer}}</textarea>
                                @endif
                                @error('answer')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('msg.Add Answer') }}
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
