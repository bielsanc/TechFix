<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordens_servico';

    protected $fillable = [
        'numero',
        'cliente_nome',
        'cliente_telefone',
        'cliente_email',
        'tipo_equipamento',
        'marca',
        'modelo',
        'numero_serie',
        'acessorios',
        'descricao_problema',
        'itens',
        'valor_total',
        'status',
        'tecnico',
        'data_entrada',
        'previsao_entrega',
        'usuario_id',
    ];

    protected function casts(): array
    {
        return [
            'itens' => 'array',
            'valor_total' => 'decimal:2',
            'data_entrada' => 'date',
            'previsao_entrega' => 'date',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Gera o próximo número sequencial de OS (00001, 00002, ...).
     */
    public static function proximoNumero(): string
    {
        $ultimo = static::orderByDesc('id')->value('id') ?? 0;

        return str_pad((string) ($ultimo + 1), 5, '0', STR_PAD_LEFT);
    }
}
