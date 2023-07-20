@extends("layouts.layoutAdmin")

@section("title")
Dashboard
@endsection

@section("script")
    @include('frontend.fixedAdmin.scriptAdminDashboard')
@endsection

@section("content")
    <div class="modal modal-response-dashboard" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close ik-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ik-modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ik-close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Users</h6>
                <div class="w-25 d-flex flex-row align-items-center justify-content-center">
                   <p>Search: </p><input type="text" id="usersSearch" class="form-control">
                </div>

            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0 ik-table">
                    <thead>
                    @if(session()->has("error"))
                        <tr>
                            <div class="alert alert-danger">
                                {{session()->remove("error")}}
                            </div>
                        </tr>
                    @endif
                    @if(session()->has("success"))
                        <tr>
                            <div class="alert alert-success">
                                {{session()->remove("success")}}
                            </div>
                        </tr>
                    @endif
                    <tr class="text-white">
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Num of posts</th>
                        <th scope="col">Num of comments</th>
                        <th scope="col">Email</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody class="ik-table-body">
                    @foreach($allUsers->users as $u)
                        <tr>
                            <td>{{$u->first_name}}</td>
                            <td>{{$u->last_name}}</td>
                            <td>{{$u->post->count()}}</td>
                            <td>{{$u->comment->count()}}</td>
                            <td>{{$u->email}}</td>
                            <td>
                                <form action="{{route("destroyUser")}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id_user" value="{{$u->id_user}}">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="..." class="mt-3">

                <ul class="pagination pagination-sm rounded-0 ik-dash-pag">
                @for($i=0;$i<$allUsers->numOfPages; $i++)
                    <li class="page-item">
                        <a class="page-link admin-pagination-btn" data-li="{{$i}}" href="#" tabindex="-1">{{$i+1}}</a>
                    </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div>
    <!-- Recent Sales End -->


    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Messages</h6>
                        <div class="w-25">
                            Search:<input type="text" class="form-control " id="messages-search">
                        </div>

                    </div>
                    <div class="admin-messages-container">
                        @foreach($messages->messages as $m)
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{asset("assets/images/user.jpg")}}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{$m->email}}</h6>
                                        <small>{{$m->created_at}}</small>
                                    </div>
                                    <span class="ik-text">{{$m->message}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav aria-label="..." class="mt-3">

                        <ul class="pagination pagination-sm rounded-0 ik-dash-pag-messages">
                            @for($i=0;$i<$messages->numOfPages; $i++)
                                <li class="page-item">
                                    <a class="page-link admin-pagination-btn-message" data-li="{{$i}}" href="#" tabindex="-1">{{$i+1}}</a>
                                </li>
                            @endfor
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Widgets End -->
@endsection
