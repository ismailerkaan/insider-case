<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())')); // Benzersiz ID
            $table->text('content'); // Mesaj içeriği
            $table->string('recipient', 15); // Alıcı telefon numarası
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending'); // Gönderim durumu
            $table->string('message_id')->nullable(); // Gönderim sonrası dönen ID
            $table->timestamp('sent_at')->nullable(); // Gönderim zamanı
            $table->timestamps(); // created_at ve updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
