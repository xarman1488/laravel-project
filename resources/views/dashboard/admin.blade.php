@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
    <div class="container">
        <h2 class="mb-4">Панель администратора</h2>

        <!-- Статистика -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Ожидающие запросы</h5>
                        <h2 class="card-text">{{ $pendingRequests }}</h2>
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-light btn-sm">
                            Посмотреть
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Всего запросов</h5>
                        <h2 class="card-text">{{ $totalRequests }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Пользователей</h5>
                        <h2 class="card-text">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Последние запросы -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Последние запросы</h5>
                <a href="{{ route('admin.requests.index') }}" class="btn btn-sm btn-primary">
                    Все запросы
                </a>
            </div>
            <div class="card-body">
                @if($recentRequests->isEmpty())
                    <p class="text-muted">Нет запросов</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Заголовок</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recentRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->user->name }}</td>
                                    <td>{{ Str::limit($request->title, 40) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                                            {{ $request->status == 'pending' ? 'Ожидает' : ($request->status == 'approved' ? 'Одобрено' : 'Отклонено') }}
                                        </span>
                                    </td>
                                    <td>{{ $request->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.requests.show', $request->id) }}"
                                           class="btn btn-sm btn-primary">
                                            Просмотр
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
