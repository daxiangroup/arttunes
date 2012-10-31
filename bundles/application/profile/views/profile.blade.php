@layout('layouts.master')

@section('page-specific-js')
{{ HTML::script('js/profile.js') }}
@endsection

@section('page-specific-css')
{{ HTML::style('css/profile.css') }}
@endsection

@section('content') 
<div id="cntr-profile">
    <h1> profile: {{ $profile->full_name }} </h1>

    <div id="cntr-profile-name" class="row">
        <div class="cntr-display clearfix">
            <div class="span2">Name</div>
            <div class="span4">{{ $profile->full_name }}</div>
            <div class="span1">
                <div class="icon-pencil pull-right accordion-toggle"></div>
            </div>
        </div>
        <div class="cntr-edit clearfix">
            <div class="row">
                <div class="span2">Name</div>
                <div class="span2 tr">First:</div>
                <div class="span3">
                    {{ Form::text('profile-first-name') }}
                </div>
            </div>
            <div class="row">
                <div class="span2 offset2 tr">Last:</div>
                <div class="span3">
                    {{ Form::text('profile-last-name') }}
                </div>
            </div>
            <div class="row">
                <div class="span3 offset4">
                    {{ Form::submit('Save!', array('class'=>'btn btn-primary btn-mini')) }}
                </div>
            </div>
        </div>
    </div>

    <div id="cntr-profile-email" class="row">
        <div class="cntr-display clearfix">
            <div class="span2">Email</div>
            <div class="span4">{{ $profile->email }}</div>
            <div class="span1">
                <div class="icon-pencil pull-right accordion-toggle"></div>
            </div>
        </div>
        <div class="cntr-edit clearfix">
            <div class="span2">Email</div>
            <div class="span2 tr">Primary:</div>
            <div class="span3">
                {{ Form::text('profile-email') }}
            </div>
            <div class="row">
                <div class="span3 offset4">
                    {{ Form::submit('Save!', array('class'=>'btn btn-primary btn-mini')) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection