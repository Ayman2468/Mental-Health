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
        <div class="page-header text-center">
            <h1>{{__('msg.users')}}</h1> <br>

        </div>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered text-center'>
            <!-- creating our table heading -->
            <tr>
                <th>{{__('msg.ID')}}</th>
                <th>{{__('msg.Name')}}</th>
                <th>{{__('msg.Email')}}</th>
                <th>{{__('msg.Age')}}</th>
                <th>{{__('msg.College')}}</th>
                <th>{{__('msg.Division')}}</th>
                <th>{{__('msg.Mobile')}}</th>
                <th>{{__('msg.Action')}}</th>
            </tr>



    @foreach ($usersdata as $fetchedData )


           <tr>
                <td>{{ $fetchedData->id }}</td>
                <td>{{ $fetchedData->name }}</td>
                <td>{{ $fetchedData->email }}</td>
                <td>{{ $fetchedData->age }}</td>
                <td>{{ $fetchedData->college }}</td>
                <td>{{ $fetchedData->division }}</td>
                <td>{{ $fetchedData->mobile }}</td>
                </td>
                 <td>
                                             <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#exampleModal{{$fetchedData->id}}">
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
                                    <a href='{{ url('user/delete/'.$fetchedData->id) }}' class='btn btn-danger'>{{__('msg.Delete')}}</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    <a href='{{ url('user/edit/'.$fetchedData->id) }}' class='btn btn-primary mb-1'>{{__('msg.Edit')}}</a>
                    @if (App\Models\admins::select('email')->where('email',$fetchedData->email)->get()->isEmpty())
                    <a href='{{ url('admin/register/'.$fetchedData->id) }}' class='btn btn-primary mb-1'>{{__('msg.Make Admin')}}</a>
                    @endif
                </td>
           </tr>
     @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!!$usersdata->links()!!}
        </div>
    </div>
    <!-- end .container -->

@endsection

