<?php

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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->date('date_of_sale');
            $table->unsignedBigInteger('pawned_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->unsignedBigInteger('debtor_id');
            $table->unsignedBigInteger('car_id');
            $table->float('total_price');
            $table->float('first_batch');
            $table->float('monthly_installment');
            $table->date('first_installment_date');
            $table->integer('status')->default(0);
            $table->integer('delete')->default(0);

            $table->foreign('pawned_id')->references('id')->on('pawned');
            $table->foreign('debtor_id')->references('id')->on('debtor');
            $table->foreign('sponsor_id')->references('id')->on('sponsor');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
