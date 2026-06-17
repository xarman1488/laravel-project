@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Список задач</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Создать задачу</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($tasks as $task)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <p class="card-text">{{ Str::limit($task->description, 100) }}</p>
                            <p>
                        <span class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ $task->status }}
                        </span>
                                <span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'info') }}">
                            {{ $task->priority }}
                        </span>
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">Просмотр</a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Изменить</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Нет задач</p>
            @endforelse
        </div>
    </div>
@endsection
