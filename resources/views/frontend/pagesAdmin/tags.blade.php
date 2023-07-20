@extends("layouts.layoutAdmin")

@section("title")
    Tags
@endsection

@section("script")
    @include('frontend.fixedAdmin.tagCategoryScript')
@endsection

@section("modal")
    @include("frontend.fixedAdmin.modal")
@endsection

@section("content")


    <!-- Recent Tags Start -->

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
                @if(session()->has("error"))
                    <div class="alert alert-danger">
                        {{session()->get("error")}}
                    </div>
                @endif
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tags</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0 ik-table">
                    <thead>
                    <tr class="text-white">
                        <th scope="col">Tag Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody class="ik-table-body">
                    @foreach($tags as $t)
                        <tr>
                            <td>{{$t->title}}</td>
                            <td>
                                <form action="">
                                    <a class="btn btn-sm btn-primary ik-primary ik-modal-edit-btn"
                                       data-title="{{$t->title}}" data-content="{{$t->content}}"
                                       data-url="tag" data-id="{{$t->id_tag}}">Edit</a>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("tags.destroy", ["tag"=>$t->id_tag])}}" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                </form>
                            </td>


                        </tr>

                    @endforeach



                    </tbody>
                </table>
            </div>
        </div>
        @component("components.addNewTagOrCategory",[
                   "route"=>"tags.store",
                   "name"=>"Add New Tag"
       ])
        @endcomponent
    </div>
    <!-- Recent Tags End -->

@endsection
