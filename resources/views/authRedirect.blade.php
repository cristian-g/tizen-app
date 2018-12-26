@extends('layouts.app')

@section('styles')
@endsection

@section('content')
@endsection

@section('scripts')
    <script>
        window.location = window.location.href.replace("authenticate", localStorage.getItem('redirect_code'));
    </script>
@endsection
