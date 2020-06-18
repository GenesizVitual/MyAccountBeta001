@if(!empty(Session::get('message_success')))
    <div class="card bg-success text-white shadow">
        <div class="card-body">
            Info
            <div class="text-white-50 small">{{ Session::get('message_success') }}</div>
        </div>
    </div>
@endif


@if(!empty(Session::get('message_fail')))
    <div class="card bg-danger text-white shadow">
        <div class="card-body">
            Info
            <div class="text-white-50 small">{{ Session::get('message_fail') }}</div>
        </div>
    </div>
@endif
<p></p>