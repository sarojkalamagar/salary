@section('messages-content')
@if(Session::has('success_msg') || Session::has('fail_msg') || Session::has('info_msg'))
    <p class="messages mt-4">
        @if(Session::has('success_msg'))
            <span class="successMessage">{{ Session::get('success_msg') }}</span>
        @endif
        @if(Session::has('fail_msg'))
            <span class="failMessage">{{ Session::get('fail_msg') }}</span>
        @endif
        @if(Session::has('info_msg'))
            <span class="infoMessage">{{ Session::get('info_msg') }}</span>
        @endif
        <span class="closeParent"><i class="fa fa-times" aria-hidden="true"></i></span>
    </p>
@endif
@endsection