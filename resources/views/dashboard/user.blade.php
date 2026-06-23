@extends('layouts.app')

@section('title', 'Моя панель')

@section('content')
    <div class="container">
        <h2 class="mb-4">Добро пожаловать, {{ Auth::user()->name }}!</h2>

        <!-- Статистика -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Всего запросов</h5>
                        <h2 class="card-text">{{ $requestsCount }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Ожидают рассмотрения</h5>
                        <h2 class="card-text">{{ $pendingCount }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Одобрено</h5>
                        <h2 class="card-text">{{ $approvedCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Мои запросы -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Мои запросы</h5>
                        <a href="#" class="btn btn-sm btn-primary">Создать запрос</a>
                    </div>
                    <div class="card-body">
                        @if($myRequests->isEmpty())
                            <p class="text-muted">У вас пока нет запросов</p>
                        @else
                            <div class="list-group">
                                @foreach($myRequests as $request)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $request->title }}</h6>
                                                <p class="mb-1 small text-muted">
                                                    {{ Str::limit($request->description, 60) }}
                                                </p>
                                                <small class="text-muted">
                                                    {{ $request->created_at->format('d.m.Y H:i') }}
                                                </small>
                                            </div>
                                            <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                                            {{ $request->status == 'pending' ? 'Ожидает' : ($request->status == 'approved' ? 'Одобрено' : 'Отклонено') }}
                                        </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Мои задачи -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Мои задачи</h5>
                        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary">Все задачи</a>
                    </div>
                    <div class="card-body">
                        @if($myTasks->isEmpty())
                            <p class="text-muted">У вас пока нет задач</p>
                        @else
                            <div class="list-group">
                                @foreach($myTasks as $task)
                                    <a href="{{ route('tasks.show', $task->id) }}"
                                       class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $task->title }}</h6>
                                                <small class="text-muted">
                                                    {{ $task->due_date ? $task->due_date : 'Без срока' }}
                                                </small>
                                            </div>
                                            <div>
                                            <span class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                {{ $task->status }}
                                            </span>
                                                <span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'info') }}">
                                                {{ $task->priority }}
                                            </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Быстрые действия -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Быстрые действия</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> Создать задачу
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('attachments.create') }}" class="btn btn-outline-success w-100 mb-2">
                            <i class="bi bi-file-earmark-plus"></i> Загрузить документ
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-info w-100 mb-2">
                            <i class="bi bi-list-task"></i> Все задачи
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('attachments.index') }}" class="btn btn-outline-warning w-100 mb-2">
                            <i class="bi bi-folder"></i> Документы
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
