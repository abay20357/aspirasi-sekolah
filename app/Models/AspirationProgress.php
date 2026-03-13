<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirationProgress extends Model
{
    use HasFactory;

    protected $table = 'aspiration_progress';

    protected $fillable = [
        'aspiration_id',
        'admin_id',
        'status',
        'progress_percentage',
        'notes',
    ];

    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
