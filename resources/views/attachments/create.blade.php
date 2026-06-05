<div style="max-w: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">Загрузить новый документ</h2>

    <form action="{{ route('attachments.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Имя файла *</label>
            <input type="text" name="file_name" value="{{ old('file_name') }}" placeholder="document.pdf" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            @error('file_name') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Путь к файлу *</label>
            <input type="text" name="file_path" value="{{ old('file_path') }}" placeholder="uploads/document.pdf" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            @error('file_path') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Размер (в байтах)</label>
                <input type="number" name="file_size" value="{{ old('file_size') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                @error('file_size') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">MIME-тип</label>
                <input type="text" name="mime_type" value="{{ old('mime_type') }}" placeholder="application/pdf" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                @error('mime_type') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
            </div>
        </div>
/
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Описание документа</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">{{ old('description') }}</textarea>
            @error('description') <p style="color: red; font-size: 14px; margin: 5px 0 0 0;">{{ $message }}</p> @enderror
        </div>

        <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">Сохранить документ</button>
    </form>
</div>
