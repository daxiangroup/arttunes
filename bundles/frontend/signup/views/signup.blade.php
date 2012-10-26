@layout('layouts.master')

@section('page-specific-js')
{{ HTML::script('js/signup.js') }}
@endsection

@section('content') 
<div id="cntr-signup">
    {{ Form::open('/signup') }} 
    {{ Form::token() }} 

    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-first-name']['target'], $form_data['signup-first-name']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['signup-first-name']['name'], $form_data['signup-first-name']['value'], $form_data['signup-first-name']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-last-name']['target'], $form_data['signup-last-name']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['signup-last-name']['name'], $form_data['signup-last-name']['value'], $form_data['signup-last-name']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-email']['target'], $form_data['signup-email']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['signup-email']['name'], $form_data['signup-email']['value'], $form_data['signup-email']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-password']['target'], $form_data['signup-password']['label']) }}</div>
        <div class="span3">{{ Form::password($form_data['signup-password']['name'], $form_data['signup-password']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-password-verify']['target'], $form_data['signup-password-verify']['label']) }}</div>
        <div class="span3">{{ Form::password($form_data['signup-password-verify']['name'], $form_data['signup-password-verify']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2"></div>
        <div class="span3">
            {{ Form::radio($form_data['signup-type-1']['name'], $form_data['signup-type-1']['value'], $form_data['signup-type-1']['checked'], $form_data['signup-type-1']['extra']).Form::label($form_data['signup-type-1']['target'], $form_data['signup-type-1']['label']) }}
            {{ Form::radio($form_data['signup-type-2']['name'], $form_data['signup-type-2']['value'], $form_data['signup-type-2']['checked'], $form_data['signup-type-2']['extra']).Form::label($form_data['signup-type-2']['target'], $form_data['signup-type-2']['label']) }}
        </div>
    </div>

    <div class="cntr-signup-creator">
        <div class="row">
            <div class="span2">{{ Form::label($form_data['signup-about-me']['target'], $form_data['signup-about-me']['label']) }}</div>
            <div class="span3">{{ Form::text($form_data['signup-about-me']['name'], $form_data['signup-about-me']['value'], $form_data['signup-about-me']['extra']) }}</div>
        </div>
        <div class="row">
            <div class="span2">{{ Form::label($form_data['signup-general-statement']['target'], $form_data['signup-general-statement']['label']) }}</div>
            <div class="span3">{{ Form::text($form_data['signup-general-statement']['name'], $form_data['signup-general-statement']['value'], $form_data['signup-general-statement']['extra']) }}</div>
        </div>
    </div>

    <div class="row">
        <div class="span2"></div>
        <div class="span3">{{ Form::submit($form_data['btn-submit']['value'], $form_data['btn-submit']['extra']) }}</div>
    </div>
<?php echo print_r($errors,true); ?>
    {{ Form::close() }} 
</div>
@endsection