<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('phone', 20)->nullable();

            $table->string('subject', 200);
            $table->text('message');

            $table->string('status', 20)->default('new');
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index(
                ['status', 'created_at'],
                'contact_messages_status_created_idx'
            );

            $table->index(
                'email',
                'contact_messages_email_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
