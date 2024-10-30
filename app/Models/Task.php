<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
    ];

    public function getStatusDisplayAttribute (){
        
        $statuses = [
                'not-started' => 'Not Started',
                'in-progress' => 'In Progress',
                'completed' => 'Completed',
                'on-hold' => 'On Hold',
        ];

        return $statuses[$this->status] ?? null;
    }
}
