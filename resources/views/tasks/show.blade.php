@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Задача: {{ $task->title }}</h3>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад</a>
            </div>
            <div class="card-body">
                <p><strong>Описание:</strong> {{ $task->description }}</p>
                <p><strong>Статус:</strong> {{ $task->status }}</p>
                <p><strong>Приоритет:</strong> {{ $task->priority }}</p>
                <p><strong>Срок:</strong> {{ $task->due_date }}</p>

                <div class="mt-3">
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
