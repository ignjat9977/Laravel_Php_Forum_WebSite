@extends("layouts.layoutAdmin")

@section("title")
    User Activity
@endsection

@section("content")
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">User Activity</h6>
                <form action="{{route("userActivity")}}" method="GET">
                    <select name="time" id="" class="form-control">

                        <option value="timeDesc">Fiter by Time Descending</option>
                        <option value="timeAsc">Filter by Time Ascending</option>
                    </select>
                    <input type="submit" value="Filter" class="btn btn-primary ik-btn-primary" name="submit">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0 ik-table">

               <thead>
               <tr class="text-white">
                   <th scope="col">Date</th>
                   <th scope="col">Page Visited</th>
                   <th scope="col">Url</th>
               </tr>
               </thead>
               <tbody class="ik-table-body">
               @foreach($activity as $a)
                   @if(!$a->user_id=="")
                   <tr>
                       <td>
                           {{$a->date}}
                       </td>
                       <td>
                           {{$a->page}}
                       </td>

                       <td>
                           {{$a->ip_adress}}
                       </td>
                   </tr>
                   @endif
               @endforeach

               </tbody>

           </table>
           <nav aria-label="..." class="mt-3">
               {{$activity->links()}}
           </nav>

        </div>
    </div>
    </div>

@endsection
