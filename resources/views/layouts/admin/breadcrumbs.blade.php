
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @hasSection ('title')
            @yield('title')
        @else
            Home
        @endif
    </h1>

    <ol class="breadcrumb">
        @section('breadcrumb')
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Home| {{$title}}</a></li>
        @show

    </ol>
</section>

