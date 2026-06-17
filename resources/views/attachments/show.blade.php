@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Документ: {{ $attachment->file_name }}</h3>
                <a href="{{ route('attachments.index') }}" class="btn btn-secondary">Назад</a>
            </div>
            <div class="card-body">
                <p><strong>Путь:</strong> {{ $attachment->file_path }}</p>
                <p><strong>Размер:</strong> {{ number_format($attachment->file_size / 1024, 2) }} KB</p>
                <p><strong>Тип:</strong> {{ $attachment->mime_type }}</p>
                <p><strong>Описание:</strong> {{ $attachment->description }}</p>

                <div class="mt-3">
                    <a href="{{ route('attachments.edit', $attachment) }}" class="btn btn-warning">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
