<?php

// app/Models/Patient.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address',
    ];

    /**
     * Relación con las órdenes.
     *
     * Un paciente puede tener muchas órdenes.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
