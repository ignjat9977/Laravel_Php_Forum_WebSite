


    <!-- Recent Tags Start -->

        <div class="bg-secondary text-center rounded p-4 mt-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">{{$name}}</h6>
            </div>
            <form action="{{route($route)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-6">
                        <input class="form-control" type="text" name="title" placeholder="Mega Title">
                    </div>
                    <div class="col-12 mt-4">
                        <textarea rows="8" class="form-control mb-3" name="content"  placeholder="Content"></textarea>

                    </div>
                </div>
                <input class="btn btn-success" type="submit" value="Create">


            </form>
        </div>
