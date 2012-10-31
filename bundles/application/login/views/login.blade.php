@layout('layouts.master')

@section('content') 
<div id="cntr-login">
    {{ Form::open('/login') }} 
    {{ Form::token() }} 

    <div class="row">
        <div class="span2">{{ Form::label($form_data['login-email']['target'], $form_data['login-email']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['login-email']['name'], $form_data['login-email']['value'], $form_data['login-email']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['login-password']['target'], $form_data['login-password']['label']) }}</div>
        <div class="span3">{{ Form::password($form_data['login-password']['name'], $form_data['login-password']['extra']) }}</div>
    </div>

    <div class="row">
        <div class="span2"></div>
        <div class="span3">{{ Form::submit($form_data['btn-submit']['value'], $form_data['btn-submit']['extra']) }}</div>
    </div>

    {{ Form::close() }} 
</div>
@endsection