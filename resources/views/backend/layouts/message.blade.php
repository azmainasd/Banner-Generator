{{-- @if ($errors->any())
    <div class="alert alert-danger mb-0">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif --}}

@if(Session::has('success'))
    <div class="alert alert-success mb-0">
        <div>
            <p>{{Session::get('success')}}</p>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger mb-0">
        <div>
            <p>{{Session::get('error')}}</p>
        </div>
    </div>
@endif




