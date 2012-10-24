@layout('layouts.master')

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
        <div class="span2">{{ Form::label($form_data['signup-about-me']['target'], $form_data['signup-about-me']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['signup-about-me']['name'], $form_data['signup-about-me']['value'], $form_data['signup-about-me']['extra']) }}</div>
    </div>
    <div class="row">
        <div class="span2">{{ Form::label($form_data['signup-general-statement']['target'], $form_data['signup-general-statement']['label']) }}</div>
        <div class="span3">{{ Form::text($form_data['signup-general-statement']['name'], $form_data['signup-general-statement']['value'], $form_data['signup-general-statement']['extra']) }}</div>
    </div>

    {{ Form::close() }} 
</div>
@endsection