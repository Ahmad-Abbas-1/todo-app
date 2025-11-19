@extends('layouts.app')

@section('title', 'Alle taken')

@section('content')
<div class="px-4 sm:px-0">
    <h2 class="text-2xl font-bold text-white mb-6">Mijn taken</h2>

    @if($tasks->isEmpty())
        <div class="bg-gray-800 rounded-lg shadow p-8 text-center border border-gray-700">
            <p class="text-gray-400 mb-4">Je hebt nog geen taken aangemaakt.</p>
            <a href="{{ route('tasks.create') }}" 
               class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                Maak je eerste taak
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($tasks as $task)
                <div class="bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition border border-gray-700">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <form action="{{ route('tasks.toggleDone', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-6 h-6 rounded border-2 flex items-center justify-center
                                                   {{ $task->is_done ? 'bg-purple-600 border-purple-600' : 'border-gray-600 hover:border-purple-600' }}">
                                        @if($task->is_done)
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>

                                <h3 class="text-lg font-semibold text-white {{ $task->is_done ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->title }}
                                </h3>

                                @if($task->is_done)
                                    <span class="bg-purple-900 text-purple-200 text-xs px-2 py-1 rounded">Voltooid</span>
                                @endif
                            </div>

                            @if($task->description)
                                <p class="mt-2 text-gray-400 {{ $task->is_done ? 'line-through' : '' }}">
                                    {{ $task->description }}
                                </p>
                            @endif

                            <p class="mt-2 text-sm text-gray-500">
                                Aangemaakt: {{ $task->created_at->format('d-m-Y H:i') }}
                            </p>
                        </div>

                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('tasks.edit', $task) }}" 
                               class="text-purple-400 hover:text-purple-300 px-3 py-1 rounded hover:bg-gray-700">
                                Bewerken
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" 
                                  onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-400 hover:text-red-300 px-3 py-1 rounded hover:bg-gray-700">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-center text-gray-400">
            <p>Totaal: {{ $tasks->count() }} taken | Voltooid: {{ $tasks->where('is_done', true)->count() }}</p>
        </div>
    @endif
</div>
@endsection