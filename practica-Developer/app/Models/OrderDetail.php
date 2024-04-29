<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_order', // ID de la orden asociada
        'fk_medical_test', // ID del examen médico asociado
        'price', // Precio del examen
    ];

    /**
     * Get the order associated with the order detail.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'fk_order');
    }

    /**
     * Get the medical test associated with the order detail.
     */
    public function medicalTest()
    {
        return $this->belongsTo(MedicalTest::class, 'fk_medical_test');
    }

    /**
     * Calculate the total price of the order detail.
     *
     * @return float
     */
    public function calculateTotalPrice()
    {
        // Puedes agregar lógica aquí para calcular el precio total
        // Puede ser la suma de todos los precios de los exámenes asociados
        // Recuerda manejar correctamente los precios si hay descuentos o promociones
        return $this->price;
    }

    /**
     * Format the price as currency.
     *
     * @return string
     */
    public function formattedPrice()
    {
        // Puedes agregar lógica aquí para formatear el precio como moneda
        return '$' . number_format($this->price, 2);
    }
}
