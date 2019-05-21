@extends('layouts.app')

@section('error')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{ $_SESSION['message'] }}</h3></div>
            </div>
        </div>
    </div>
</div>
@endsection
{{ $_SESSION['message'] = ''}}