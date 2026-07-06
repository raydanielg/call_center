@extends('layouts.dashboard')
@section('title', 'Redirecting...')
@section('page_title', 'Redirecting...')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-primary-200 border-t-primary-600 mb-4"></div>
        <p class="text-sm text-gray-500">Redirecting to your dashboard...</p>
    </div>
</div>
@endsection
