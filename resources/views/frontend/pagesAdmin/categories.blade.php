@extends("layouts.layoutAdmin")

@section("title")
    Categories
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
                <h6 class="mb-0">Categories</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0 ik-table">
                    <thead>
                    <tr class="text-white">
                        <th scope="col">Category Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody class="ik-table-body">
                    @foreach($categories as $c)
                        <tr>
                            <td>{{$c->title}}</td>
                            <td>
                                <form action="">
                                    <a class="btn btn-sm btn-primary ik-primary ik-modal-edit-btn"
                                       data-title="{{$c->title}}" data-content="{{$c->content}}"
                                       data-url="category" data-id="{{$c->id_category}}">Edit</a>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("categories.destroy", ["category"=>$c->id_category])}}" method="POST">
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
                    "route"=>"categories.store",
                    "name"=>"Add New Category"
        ])
        @endcomponent
    </div>
    <!-- Recent Tags End -->

@endsection
