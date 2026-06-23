@extends('layouts.app')

@section('title', 'Ожидающие запросы')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Запросы в статусе ожидания</h2>
            <span class="badge bg-warning text-dark">{{ $requests->count() }} запросов</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($requests->isEmpty())
            <div class="alert alert-info">
                Нет запросов, ожидающих рассмотрения
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Дата создания</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $request->user_id) }}"
                                   class="text-decoration-none">
                                    {{ $request->user->name }}
                                </a>
                            </td>
                            <td>{{ $request->title }}</td>
                            <td>{{ Str::limit($request->description, 50) }}</td>
                            <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
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
@endsection
