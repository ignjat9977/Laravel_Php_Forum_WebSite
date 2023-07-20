<form action="{{route("posts.index")}}" method="GET">
    <div class="sidebar">
        <div class="sidebar-section">
            <h5><span>Search</span></h5>
            <input class="form-control" {{$keyword!=""?"value=$keyword":""}} placeholder="Search..." name="keyword" id="filter search"/>

        </div>
        <div class="sidebar-section">
            <h5><span>Posts per page</span></h5>
            <select name="perPage" class="form-control">
                <option {{$perPage == 4 ?"selected":""}} value="4">4</option>
                <option {{$perPage == 8 ?"selected":""}} value="8">8</option>
                <option {{$perPage == 12 ?"selected":""}} value="12">12</option>
            </select>

        </div>
        <div class="sidebar-section">
            <h5><span>Sort By</span></h5>
            <select name="sortBy" class="form-control">
                <option {{$sortBy=="1"?"selected":""}} value="1">Title name Asc</option>
                <option {{$sortBy=="2"?"selected":""}} value="2">Title name Desc</option>
                <option {{$sortBy=="3"?"selected":""}} value="3">Oldest</option>
                <option {{$sortBy=="4"?"selected":""}} value="4">Newest</option>
            </select>
        </div>
        <div class="sidebar-section">
            <h5><span>Categories</span></h5>
            <ul>
                @foreach($categories as $c)
                    <li><input type="checkbox" {{$checked != null ? in_array($c->id_category, $checked) ? "checked": "" : "" }}
                               id="inlineCheckbox-{{$c->id_category}}" name="id_category[]" value="{{$c->id_category}}" class="mr-3"/>{{$c->title}}</li>
                @endforeach
            </ul>
        </div>

        <input type="submit" class="ml-4 btn btn-success" value="Search"/>

    </div>

</form>
