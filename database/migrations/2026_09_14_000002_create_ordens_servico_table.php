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
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();

            // Dados do cliente (preenchidos direto na OS, sem cadastro separado)
            $table->string('cliente_nome');
            $table->string('cliente_telefone')->nullable();
            $table->string('cliente_email')->nullable();

            // Dados do equipamento
            $table->string('tipo_equipamento')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('acessorios')->nullable();

            // Problema e serviços
            $table->text('descricao_problema')->nullable();
            $table->json('itens')->nullable(); // [{descricao, valor}, ...]
            $table->decimal('valor_total', 10, 2)->default(0);

            // Controle
            $table->enum('status', ['Aberta', 'Em andamento', 'Aguardando Peças', 'Concluída'])
                ->default('Aberta');
            $table->string('tecnico')->nullable();
            $table->date('data_entrada')->nullable();
            $table->date('previsao_entrega')->nullable();

            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens_servico');
    }
};
