@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Edit Project</h1>

        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block font-semibold">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                    class="w-full border-gray-300 rounded" />
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block font-semibold">Description:</label>
                <textarea name="description" id="description" class="w-full border-gray-300 rounded">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Project</button>
        </form>
    </div>
@endsection
