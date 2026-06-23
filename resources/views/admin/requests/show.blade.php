@extends('layouts.app')

@section('title', 'Запрос #' . $request->id)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Запрос #{{ $request->id }}</h4>
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-secondary btn-sm">
                            Назад к списку
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="mb-3">
                            <strong>Пользователь:</strong>
                            <a href="{{ route('admin.users.show', $request->user_id) }}">
                                {{ $request->user->name }}
                            </a>
                            ({{ $request->user->email }})
                        </div>

                        <div class="mb-3">
                            <strong>Заголовок:</strong> {{ $request->title }}
                        </div>

                        <div class="mb-3">
                            <strong>Описание:</strong>
                            <p class="mt-2">{{ $request->description }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Статус:</strong>
                            <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                            {{ $request->status == 'pending' ? 'Ожидает' : ($request->status == 'approved' ? 'Одобрено' : 'Отклонено') }}
                        </span>
                        </div>

                        <div class="mb-3">
                            <strong>Дата создания:</strong> {{ $request->created_at->format('d.m.Y H:i') }}
                        </div>

                        <hr>

                        <!-- Форма управления статусом -->
                        <form action="{{ route('admin.requests.updateStatus', $request->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="form-label"><strong>Изменить статус:</strong></label>
                                <div class="btn-group w-100" role="group">
                                    <button type="submit" name="status" value="approved"
                                            class="btn btn-success"
                                            onclick="return confirm('Одобрить запрос?')">
                                        Одобрить
                                    </button>
                                    <button type="submit" name="status" value="rejected"
                                            class="btn btn-danger"
                                            onclick="return confirm('Отклонить запрос?')">
                                        Отклонить
                                    </button>
                                    <button type="submit" name="status" value="pending"
                                            class="btn btn-warning">
                                        Вернуть в ожидание
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Комментарии -->
                <div class="card">
                    <div class="card-header">
                        <h5>Комментарии ({{ $request->comments->count() }})</h5>
                    </div>
                    <div class="card-body">
                        @forelse($request->comments as $comment)
                            <div class="mb-3 p-3 border rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        @empty
                            <p class="text-muted">Комментариев пока нет</p>
                        @endforelse

                        <hr>

                        <!-- Форма добавления комментария -->
                        <form action="{{ route('admin.requests.storeComment', $request->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="content" class="form-label">
                                    <strong>Добавить комментарий для пользователя:</strong>
                                </label>
                                <textarea
                                    name="content"
                                    id="content"
                                    class="form-control @error('content') is-invalid @enderror"
                                    rows="4"
                                    required
                                    placeholder="Введите ваш комментарий..."></textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Отправить комментарий
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Боковая панель -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Информация о пользователе</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Имя:</strong> {{ $request->user->name }}</p>
                        <p><strong>Email:</strong> {{ $request->user->email }}</p>
                        <p><strong>Всего запросов:</strong> {{ $request->user->requests->count() }}</p>
                        <a href="{{ route('admin.users.show', $request->user_id) }}"
                           class="btn btn-info btn-sm w-100">
                            Просмотреть профиль
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
