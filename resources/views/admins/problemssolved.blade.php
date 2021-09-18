@extends('layouts.app')
@section('content')
<style>
    .table td, .table th {width: 1%;}
</style>

    <!-- container -->
    <div class="container">

        @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            <strong>{{session()->get('message')}}</strong>
        </div>
        @endif
        @if(session()->has('message1'))
        <div class="alert alert-danger" role="alert">
            <strong>{{session()->get('message1')}}</strong>
        </div>
        @endif
        {{-- @if(session()->has('admindata'))
        <div class="alert alert-success" role="alert">
            <strong>{{session()->get('admindata')}}</strong>
        </div>
        @endif --}}
        <div class="page-header text-center">
            <h1>{{__('msg.Problems I have solved')}}</h1> <br>

        </div>

        <!-- PHP code to read records will be here -->
        <p class="text-white d-table @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
            <strong>{{__('msg.Total')}}: </strong>{{count($problems)}}
        </p>
        <table class='table table-hover table-responsive table-bordered text-center'>
            <!-- creating our table heading -->
            <tr>
                <th>{{__('msg.ID')}}</th>
                <th>{{__('msg.Title')}}</th>
                <th>{{__('msg.Content')}}</th>
                <th>{{__('msg.Answer')}}</th>
                <th>{{__('msg.Patient')}}</th>
                <th>{{__('msg.Doctor')}}</th>
                <th>{{__('msg.Created')}}</th>
                <th>{{__('msg.Edited')}}</th>
                <th>{{__('msg.Action')}}</th>
            </tr>



            @foreach ($problems as $fetchedData )


            <tr>
                    <td>{{ $fetchedData->id }}</td>
                    <td>{{ $fetchedData->title }}</td>
                    <td><p>{{ $fetchedData->content }}</p></td>
                    <td><p>{{ $fetchedData->answer }}</p></td>
                    <td>{{ $fetchedData->user }}</td>
                    <td>{{ $fetchedData->admin }}</td>
                    <td>{{ $fetchedData->created_at }}</td>
                    <td>{{ $fetchedData->updated_at }}</td>
                    </td>
                    <td>
                        <a href='{{ url('problem/answer/'.$fetchedData->id) }}' class='btn btn-primary m-r-1em'>{{__('msg.Edit Answer')}}</a>
                    </td>
            </tr>
            @endforeach
        </table>
        <br>
        <br>
        <div class="d-flex justify-content-center">
            {!!$problems->links()!!}
        </div>
    </div>
    <!-- end .container -->

@endsection

