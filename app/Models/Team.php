<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'titles', 'top_scorer', 'fifa_code', 'first_cup'];

    protected $casts = [
        'titles' => 'integer',
        'first_cup' => 'datetime',
    ];

    public function __toString()
    {
        return "<[{$this->id}] {$this->name} - {$this->fifa_code}>";
    }
}
