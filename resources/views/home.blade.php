@extends('layouts.app')

@section('content')
<div class="container">
    @if(user_type() == 'master')
        <master-component></master-component>
    @else
        <slave-component slave="{{ user_id() }}"></slave-component>
    @endif
</div>
@endsection
