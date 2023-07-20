<div class="col-sm-4">
    <div class="sidebar">
        <div class="sidebar-section">
            <h5><span>Categories</span></h5>
            <ul style="list-none;">
                @foreach($categories as $c)
                    <div class="mb-3">
                        <li>Name: {{$c->title}}</li>
                        <p>About: {{$c->content}}</p>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="sidebar-section">
            <h5><span>Tags</span></h5>
            <ul style="list-none;">
                @foreach($tags as $t)
                    <div class="mb-3">
                        <li>Name: {{$t->title}}</li>
                        <p>About tag: {{$t->content}}</p>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>
