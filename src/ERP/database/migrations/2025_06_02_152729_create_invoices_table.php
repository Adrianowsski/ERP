<?php
// database/migrations/2025_06_05_000001_create_invoices_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Uruchomienie migracji: tworzymy tabelę invoices
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Połączenie z zamówieniem: order_id (cascade on delete)
            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            // Numer faktury (unikalny)
            $table->string('invoice_number')->unique();

            // Data wystawienia
            $table->date('issue_date');

            // Data płatności
            $table->date('due_date');

            // Całkowita kwota faktury
            $table->decimal('total', 12, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Cofnięcie migracji: usuwamy tabelę invoices
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
