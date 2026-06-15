<?php
namespace App\Services;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Collection;

class AttachmentService
{
    public function getAll(): Collection
    {
        return Attachment::all();
    }

    public function create(array $data): Attachment
    {
        return Attachment::create($data);
    }

    public function update(Attachment $attachment, array $data): bool
    {
        return $attachment->update($data);
    }

    public function delete(Attachment $attachment): bool
    {
        return $attachment->delete();
    }
}
