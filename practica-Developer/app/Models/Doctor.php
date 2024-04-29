<?php

// app/Models/Doctor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'specialty',
    ];

    /**
     * Relación con las órdenes.
     *
     * Un doctor puede estar asociado a muchas órdenes.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
