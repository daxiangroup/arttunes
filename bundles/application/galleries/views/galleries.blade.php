@layout('layouts.master')

@section('page-specific-js')
@endsection

@section('page-specific-css')
@endsection

@section('content') 
<div id="cntr-galleries">
    <h1> gallery: {{ $profile->full_name }} </h1>

</div>
@endsection