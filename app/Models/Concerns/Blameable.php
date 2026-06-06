<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Rellena automaticamente created_by y updated_by con el id del usuario
 * autenticado cuando el modelo se crea o se actualiza.
 *
 * Solo aplicalo a tablas que tienen las columnas created_by / updated_by.
 *
 * @property-read int|null $created_by
 * @property-read int|null $updated_by
 */
trait Blameable
{
    public static function bootBlameable(): void
    {
        static::creating(function ($model) {
            $userId = Auth::id();
            if ($userId === null) {
                return;
            }
            if (! $model->isDirty('created_by') && empty($model->created_by)) {
                $model->created_by = $userId;
            }
            if (! $model->isDirty('updated_by') && empty($model->updated_by)) {
                $model->updated_by = $userId;
            }
        });

        static::updating(function ($model) {
            $userId = Auth::id();
            if ($userId !== null && ! $model->isDirty('updated_by')) {
                $model->updated_by = $userId;
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
