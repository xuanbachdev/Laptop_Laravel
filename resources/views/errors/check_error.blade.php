{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            @foreach ($errors->all() as $error)
                <li style="list-style: none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@if(Session::has('message'))
    <div class="alert alert-success text-center">
        {{  Session::get('message') }}
    </div>
@elseif(Session::has('error'))
    <div class="alert alert-danger text-center">
        {!! Session::get('error') !!}
{{--        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
{{--      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
    </div>
@endif
