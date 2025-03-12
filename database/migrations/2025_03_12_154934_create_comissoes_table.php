<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('comissoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_emprestimo_id');
            $table->unsignedBigInteger('usuario_id');
            $table->enum('cargo', ['gerente_comercial', 'gerente_regional', 'superintendente']);
            $table->decimal('valor', 15, 2);
            $table->timestamps();

            $table->foreign('contrato_emprestimo_id')->references('id')->on('contratos_emprestimos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('comissoes');
    }
};
