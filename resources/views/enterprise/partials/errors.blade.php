@php
  $notCounter = 0;
@endphp

@if(count($errors) > 0)
		@foreach($errors->all() as $error)
      <div class="notification" id="not{{ $notCounter }}">

        <img src="/images/001-sound.svg" alt="campana">
        <span>{{$error}}</span>
        <span style="float: right">
          <i class="fa fa-times closeNotification" aria-hidden="true" data-id="not{{ $notCounter }}"></i>
        </span>

      </div>
      @php
        $notCounter++;
      @endphp
    @endforeach
@endif


{{-- Flash messages --}}
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(Session::has($msg))
    <div class="notification" id="not{{ $notCounter }}">

      <img src="/images/001-sound.svg" alt="campana">
      <span>{{ Session::get($msg) }}</span>
      <span style="float: right">
        <i class="fa fa-times closeNotification" aria-hidden="true" data-id="not{{ $notCounter }}"></i>
      </span>

    </div>
    @php
      $notCounter++;
    @endphp
  @endif
@endforeach
