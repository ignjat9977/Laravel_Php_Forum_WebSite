<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="{{asset("assets/js/ie10-viewport-bug-workaround.js")}}"></script>
<script src="{{asset("assets/js/masonry.pkgd.min.js")}}"></script>
<script src="{{asset("assets/js/theme.js")}}"></script>
<script>
    var token = "{{csrf_token()}}"
</script>
@yield("postScript")

