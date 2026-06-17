@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Документы</h2>
            <a href="{{ route('attachments.create') }}" class="btn btn-primary">Загрузить документ</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Файл</th>
                <th>Размер</th>
                <th>Тип</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($attachments as $attachment)
                <tr>
                    <td>{{ $attachment->id }}</td>
                    <td>{{ $attachment->file_name }}</td>
                    <td>{{ number_format($attachment->file_size / 1024, 2) }} KB</td>
                    <td>{{ $attachment->mime_type }}</td>
                    <td>
                        <a href="{{ route('attachments.show', $attachment) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('attachments.edit', $attachment) }}" class="btn btn-sm btn-warning">Изменить</a>
                        <form action="{{ route('attachments.destroy', $attachment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Нет документов</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
