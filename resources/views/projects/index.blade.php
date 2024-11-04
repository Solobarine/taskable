@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Project</a>

        <ul class="mt-4 space-y-2">
            @foreach ($projects as $project)
                <li class="border p-4 rounded hover:bg-gray-100">
                    <a href="{{ route('projects.show', $project) }}"
                        class="text-lg font-semibold text-blue-700">{{ $project->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
