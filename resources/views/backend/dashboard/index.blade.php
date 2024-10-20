@extends('backend.layouts.app')

@section('content')
    @if (auth()->user()->hasRole('superadmin'))
        @include('backend.dashboard.record.record-superadmin')        
    @else
        @include('backend.dashboard.record.record-admin')
    @endif
@endsection

@section('script_addon_footer')
    @if(auth()->user()->hasRole('superadmin'))
        @include('backend.dashboard.script-superadmin')
    @else
        @include('backend.dashboard.script-admin')
    @endif
@endsection
