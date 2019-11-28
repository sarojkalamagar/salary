@include('layout.meta')
@include('layout.js-files')
@include('layout.messages')

<!DOCTYPE html>

<html lang="en-US">
<head>
    @yield('meta-content')
    @yield('page-info')
    @yield('page-specific-css')
</head>
<body>
<div class="wrapper">
    @yield("messages-content")
    <div class="row">

        <div class="col-lg-12">
            @yield("main-content")
        </div>
    </div>
</div>
@yield('js-files')
@yield('page-specific-js')
</body>
</html>