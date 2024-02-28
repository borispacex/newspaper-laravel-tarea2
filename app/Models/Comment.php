<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'text',
        'sending_date',
        'publication_date',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'content_id',
        'user_id'
    ];


    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
