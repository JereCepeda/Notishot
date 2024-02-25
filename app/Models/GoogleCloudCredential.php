<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleCloudCredential extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'private_key_id', 'private_key', 'client_email', 'client_id'];
    
}
