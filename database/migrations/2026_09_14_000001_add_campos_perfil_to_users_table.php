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
        Schema::table('users', function (Blueprint $table) {
            $table->string('usuario')->unique()->after('name');
            $table->string('perfil')->default('Técnico')->after('email');
            $table->string('telefone')->nullable()->after('perfil');
            $table->string('celular')->nullable()->after('telefone');
            $table->string('endereco')->nullable()->after('celular');
            $table->string('bairro')->nullable()->after('endereco');
            $table->string('cidade')->nullable()->after('bairro');
            $table->string('estado', 2)->nullable()->after('cidade');
            $table->string('cep', 10)->nullable()->after('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'usuario', 'perfil', 'telefone', 'celular',
                'endereco', 'bairro', 'cidade', 'estado', 'cep',
            ]);
        });
    }
};
