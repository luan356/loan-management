<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('contratos_emprestimos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id'); // ID do cliente vindo da API externa
            $table->decimal('valor', 15, 2);
            $table->unsignedBigInteger('gerente_comercial_id')->nullable();
            $table->unsignedBigInteger('gerente_regional_id')->nullable();
            $table->unsignedBigInteger('superintendente_id')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->timestamps();
            
            $table->foreign('gerente_comercial_id')->references('id')->on('users');
            $table->foreign('gerente_regional_id')->references('id')->on('users');
            $table->foreign('superintendente_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('contratos_emprestimos');
    }
};
