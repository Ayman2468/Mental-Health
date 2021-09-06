@extends('layouts.app')
@section('content')

    <!-- container -->
    <div class="container">

        @if(session()->has('message1'))
        <div class="alert alert-danger" role="alert">
            <strong>{{session()->get('message1')}}</strong>
        </div>
        @endif
        @if(count($problemsdata) < 1 && $index == 'unsolved')
        <div class="alert alert-success" role="alert">
            <strong>{{__('msg.Congrats No More Unanswered Problems')}}</strong>
        </div>
        @else
            @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                <strong>{{session()->get('message')}}</strong>
            </div>
            @endif
        @endif
        <br>
        <br>
        <div class="page-header text-center">
            <h1>{{__('msg.Problems')}}</h1> <br>

        </div>
        <div class="mr-4 ml-4 d-table @if(LaravelLocalization::getcurrentlocale() == 'ar') text-right @endif">
        @if (session()->get('admindata')->position == 'master')
        <p class="text-white"><strong>{{__('msg.Total')}}: </strong>{{$problemsdata->total()}}</p>
        {{-- {{basename($problemsdata->path())}} --}}
        <br>
        <br>
        @if($index == 'main')
        <div>
            <strong class="text-warning">{{__('msg.Problems Solved by Every Admin')}}<br></strong>
            @foreach ($adminsdata as $admin)
                <p class="text-white"><strong>{{$admin->name}}: </strong>{{session()->get($admin->name)}}</p>
                <br>
            @endforeach
        </div>
        @endif
        <br>
        <a href='{{ url('problem/unsolved-problems') }}' class='btn btn-primary m-1'>{{__('msg.Display the unsolved problems only')}}</a>
        <a href='{{ url('problem/solved-problems') }}' class='btn btn-primary m-1'>{{__('msg.Display the solved problems only')}}</a>
        <a href='{{ url('problem/problems') }}' class='btn btn-primary m-1'>{{__('msg.Display all problems')}}</a>
                                <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModal">
                            {{__('msg.Delete All')}}
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
                                {{__('msg.are you sure you want to delete all problems')}}
                                </div>
                                <div class="modal-footer">
                                    <a href='{{ url('problem/delete') }}' class='btn btn-danger'>{{__('msg.Delete')}}</a>
                                </div>
                            </div>
                            </div>
                        </div>
        <br><br>
        @endif
        </div>
        <!-- PHP code to read records will be here -->
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



            @foreach ($problemsdata as $fetchedData )


            <tr>
                    <td>{{ $fetchedData->id }}</td>
                    <td>{{ $fetchedData->title }}</td>
                    <td><p>{{ $fetchedData->content }}<p></td>
                    <td><p>{{ $fetchedData->answer }}</p></td>
                    <td>{{ $fetchedData->user }}</td>
                    <td>{{ $fetchedData->admin }}</td>
                    <td>{{ $fetchedData->created_at }}</td>
                    <td>{{ $fetchedData->updated_at }}</td>
                    </td>
                    <td>
                        @if (session()->get('admindata')->position == 'master')
                                                <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#exampleModal{{$fetchedData->id}}">
                            {{__('msg.Delete')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$fetchedData->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('msg.Delete Confirmation')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                {{__('msg.are you sure you want to delete this problem')}}
                                </div>
                                <div class="modal-footer">
                                    <a href='{{ url('problem/delete/'.$fetchedData->id) }}' class='btn btn-danger m-r-1em'>{{__('msg.Delete')}}</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- <a href='{{ url('problem/edit/'.$fetchedData->id) }}' class='btn btn-primary m-r-1em'>{{__('msg.Edit')}}</a> --}}
                        @endif
                        @if($fetchedData->answer == 'waiting for answer')
                        <a href='{{ url('problem/answer/'.$fetchedData->id) }}' class='btn btn-primary mb-1'>{{__('msg.Answer')}}</a>
                        @endif
                    </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {!!$problemsdata->links()!!}
        </div>
    </div>
    <!-- end .container -->

@endsection
