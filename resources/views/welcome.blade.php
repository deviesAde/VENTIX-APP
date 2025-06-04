@extends('layouts.guest')

@section('content')
    <!-- Hero Section -->
    @include('components.sections.hero')

    <!-- About Section -->
    @include('components.sections.about')

    <!-- Features Section -->
    @include('components.sections.features')

    <!-- Steps Section -->
    @include('components.sections.steps')

    <!-- Why Choose Us Section -->
    @include('components.sections.why-choose-us')
@endsection
