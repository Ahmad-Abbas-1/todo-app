@extends('layouts.app')

@section('title', 'Taak bewerken')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-0">
    <h2 class="text-2xl font-bold text-white mb-6">Taak bewerken</h2>

    <div class="bg-gray-800 rounded-lg shadow p-6 border border-gray-700">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                    Titel *
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $task->title) }}"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white
                              focus:ring-2 focus:ring-purple-500 focus:border-transparent
                              @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                    Omschrijving
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white
                                 focus:ring-2 focus:ring-purple-500 focus:border-transparent
                                 @error('description') border-red-500 @enderror">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" 
                        class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 font-medium">
                    Wijzigingen opslaan
                </button>
                <a href="{{ route('tasks.index') }}" 
                   class="bg-gray-700 text-gray-300 px-6 py-2 rounded-lg hover:bg-gray-600 font-medium">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
</div>
@endsection