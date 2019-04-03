@if(count($errors) > 0)
	<ul>
		@foreach($errors->all() as $error)
			<li class="alert alert-danger">{{$error}}</li>
		@endforeach
	</ul>
@endif

{{-- Flash messages --}}
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->