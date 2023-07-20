<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="footer-widget">
                    <a href="contact.html">
                        <img src="{{asset("assets/images/logo-footer.png")}}" alt="logo footer">
                    </a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="footer-widget">
                    <h5 class="title">Documentacion</h5>
                    <ul>
                        <li><a target="_blank" href="#">Documentacion</a></li>
                        <li><a target="_blank" href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="footer-widget">
                    <h5 class="title">Pages</h5>
                    <ul>
                        @foreach($navItems as $n)
                            @if($n->text == "Create a Post")

                            @else
                                <li><a target="_blank" href="{{$n->route}}">{{$n->text}}</a></li>
                            @endif

                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="footer-widget textwidget">
                    <h5 class="title">Download</h5>
                    <p>
                        Download "Affiliates" theme and use it for your next project. If you have a question, a bug report, or if you simply want to say hi, <a href="https://www.wowthemes.net/support/">contact us here</a>.
                    </p>
                    <a href="https://gum.co/affiliates-html-template" target="_blank">Download</a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p class="pull-left">
                Copyright © 2018 Affiliates HTMT Template
            </p>
            <p class="pull-right">
                <!-- Leave credit to author unless you own a commercial license: https://www.wowthemes.net/freebies-license/ -->
                <a target="_blank" href="https://www.wowthemes.net/affiliates-free-bootstrap-template/">"Affiliates Template"</a> - Design & Code by WowThemes.net
            </p>
            <div class="clearfix">
            </div>
        </div>
    </div>
</footer>
