<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'fk_patient',
        'fk_doctor',
        'user_id',
        // Agrega aquí más campos si es necesario
    ];

    // Relación con el paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'fk_patient');
    }

    // Relación con el médico
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'fk_doctor');
    }

    // Relación con los detalles de la orden (exámenes, etc.)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'fk_order');
    }
}
