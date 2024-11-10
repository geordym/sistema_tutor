<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenLog extends Model
{
    use HasFactory;

    protected $table = 'tokens_log';

    protected $fillable = [
        'user_id',
        'description',  
        'tokens',
        'type',        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
