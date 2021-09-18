@extends('layouts.app')
@section('content')

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
            <h1>{{__('msg.My Problems')}}</h1> <br>

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
                                                {{-- <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$fetchedData->id}}">
                            {{__('msg.Delete')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$fetchedData->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
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
                        </div> --}}
                        @if($fetchedData->answer == 'waiting for answer')
                        <a href='{{ url('problem/edit/'.$fetchedData->id) }}' class='btn btn-primary'>{{__('msg.Edit')}}</a>
                        @endif
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

