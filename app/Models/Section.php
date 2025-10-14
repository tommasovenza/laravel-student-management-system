<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'name'];


    // relationship with students table
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    // relationship with students table
    public function class(): BelongsTo
    {
        return $this->BelongsTo(Classes::class);
    }
}
