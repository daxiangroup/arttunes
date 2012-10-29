@layout('layouts.master')

@section('content') 
<div id="cntr-dashboard">
    <h1> dashboard </h1>
    <?php echo '<pre>'.print_r(Auth::user(),true).'</pre>' ?>
</div>
@endsection