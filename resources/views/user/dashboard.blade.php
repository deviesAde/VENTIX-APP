
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
            Logout
        </button>
    </form>
</div>
@endsection
