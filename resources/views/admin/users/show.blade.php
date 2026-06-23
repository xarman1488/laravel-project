@extends('layouts.app')

@section('title', 'Пользователь: ' . $user->name)

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Профиль пользователя</h4>
                <a href="{{ route('admin.requests.index') }}" class="btn btn-secondary btn-sm">
                    Назад к запросам
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Имя:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Дата регистрации:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Всего запросов:</strong> {{ $requests->count() }}</p>
                        <p><strong>Ожидающих:</strong> {{ $requests->where('status', 'pending')->count() }}</p>
                        <p><strong>Одобренных:</strong> {{ $requests->where('status', 'approved')->count() }}</p>
                        <p><strong>Отклоненных:</strong> {{ $requests->where('status', 'rejected')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>История запросов пользователя</h5>
            </div>
            <div class="card-body">
                @forelse($requests as $request)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6>{{ $request->title }}</h6>
                                    <p class="mb-2">{{ Str::limit($request->description, 150) }}</p>
                                    <small class="text-muted">
                                        {{ $request->created_at->format('d.m.Y H:i') }}
                                    </small>
                                </div>
                                <div class="text-end">
                                <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ $request->status == 'pending' ? 'Ожидает' : ($request->status == 'approved' ? 'Одобрено' : 'Отклонено') }}
                                </span>
                                </div>
                            </div>

                            <!-- Комментарии к запросу -->
                            @if($request->comments->count() > 0)
                                <hr>
                                <div class="ms-3">
                                    <strong>Комментарии:</strong>
                                    @foreach($request->comments as $comment)
                                        <div class="mt-2 p-2 bg-light rounded">
                                            <div class="d-flex justify-content-between">
                                                <small><strong>{{ $comment->user->name }}:</strong></small>
                                                <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                            </div>
                                            <p class="mb-0 small">{{ $comment->content }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-3">
                                <a href="{{ route('admin.requests.show', $request->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Просмотреть детально
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">У пользователя пока нет запросов</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
