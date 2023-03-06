<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "item_number",
        "acronym",
        "status",
        "aquired_date",
        "person_accounted",
        "item_type",
        "expiration_date",
    ];
}
