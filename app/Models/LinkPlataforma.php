<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkPlataforma extends Model
{
    protected $table = 'links_plataforma';
    protected $fillable = ['link', 'professor_id'];
}