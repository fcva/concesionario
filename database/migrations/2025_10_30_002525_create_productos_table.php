<?php

use App\Models\Producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Producto::create([
            'codigo'    => '1001',
            'nombre'    => 'CAMIONETA',
            'marca'     => 'HYU PV LCV',
            'modelo'    => 'GRAND CRETA'
        ]);

        Producto::create([
            'codigo'    => '1002',
            'nombre'    => 'CAMIONETA',
            'marca'     => 'GEELY',
            'modelo'    => 'COOLRAY'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
