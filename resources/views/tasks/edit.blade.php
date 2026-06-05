<div style="max-w: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">Редактировать задачу #{{ $task->id }}</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Название задачи *</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            @error('title') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Описание</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">{{ old('description', $task->description) }}</textarea>
            @error('description') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Статус</label>
                <select name="status" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Ожидает</option>
                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>В работе</option>
                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Завершено</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Приоритет</label>
                <select name="priority" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Низкий</option>
                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Средний</option>
                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Высокий</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Срок выполнения</label>
            <input type="datetime-local" name="due_date" value="{{ old('due_date', $task->due_date ? date('Y-m-d\TH:i', strtotime($task->due_date)) : '') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            @error('due_date') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">Обновить задачу</button>
    </form>
</div>
