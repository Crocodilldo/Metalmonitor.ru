<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingRecipient extends Model
{
    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];
}
