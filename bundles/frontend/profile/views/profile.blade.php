@layout('layouts.master')

@section('content') 
<div id="cntr-profile">
    <h1> profile: {{ $profile->full_name }} </h1>

    <div class="row">
        <div class="span2">Name</div>
        <div class="span4">{{ $profile->full_name }}</div>
        <div class="span1">
            <div class="icon-pencil pull-right edit"></div>
        </div>
    </div>
    <div class="row">
        <div class="span2">Email</div>
        <div class="span4">{{ $profile->email }}</div>
        <div class="span1">
            <div class="icon-pencil pull-right edit"></div>
        </div>
    </div>
</div>
@endsection