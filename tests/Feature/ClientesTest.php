<?php

namespace Tests\Feature;

use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    private function os(string $nome, float $valor, ?string $tel = null, ?string $email = null): void
    {
        OrdemServico::create([
            'numero' => OrdemServico::proximoNumero(),
            'cliente_nome' => $nome,
            'cliente_telefone' => $tel,
            'cliente_email' => $email,
            'valor_total' => $valor,
            'status' => 'Aberta',
        ]);
    }

    private function usuario(): User
    {
        return User::create([
            'name' => 'Admin', 'usuario' => 'admin', 'email' => 'a@a.com',
            'password' => 'admin123', 'perfil' => 'Administrador',
        ]);
    }

    public function test_exige_login(): void
    {
        $this->get('/clientes')->assertRedirect('/login');
    }

    public function test_lista_agrupa_clientes_e_soma_valores(): void
    {
        $this->os('Maria Silva', 100, '11 99999-0000', 'maria@x.com');
        $this->os('Maria Silva', 50.5);
        $this->os('João Souza', 30);

        $resp = $this->actingAs($this->usuario())->get('/clientes');

        $resp->assertOk()
            ->assertSee('Maria Silva')
            ->assertSee('João Souza')
            ->assertSee('11 99999-0000')
            ->assertSee('R$ 150,50');
        $this->assertCount(2, $resp->viewData('clientes'));
        $this->assertEquals(2, $resp->viewData('totalClientes'));
        $this->assertEquals(3, $resp->viewData('totalOrdens'));
    }

    public function test_busca_por_nome_telefone_e_email(): void
    {
        $this->os('Maria Silva', 100, '11 99999-0000', 'maria@x.com');
        $this->os('João Souza', 30, '21 88888-1111', 'joao@y.com');
        $u = $this->usuario();

        $this->actingAs($u)->get('/clientes?busca=maria')->assertSee('Maria Silva')->assertDontSee('João Souza');
        $this->actingAs($u)->get('/clientes?busca=88888')->assertSee('João Souza')->assertDontSee('Maria Silva');
        $this->actingAs($u)->get('/clientes?busca=y.com')->assertSee('João Souza')->assertDontSee('Maria Silva');
        $this->actingAs($u)->get('/clientes?busca=zzz')->assertSee('Nenhum cliente encontrado');
    }

    public function test_tela_vazia(): void
    {
        $this->actingAs($this->usuario())->get('/clientes')
            ->assertOk()->assertSee('Nenhum cliente ainda');
    }

    public function test_detalhe_do_cliente(): void
    {
        $this->os('Maria Silva', 100);
        $this->os('Maria Silva', 50);
        $u = $this->usuario();

        $this->actingAs($u)->get('/clientes/ordens?nome=Maria Silva')
            ->assertOk()->assertSee('Maria Silva')->assertSee('R$ 150,00');
        $this->actingAs($u)->get('/clientes/ordens?nome=Inexistente')->assertNotFound();
    }

    public function test_paginacao(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $this->os(sprintf('Cliente %02d', $i), 10);
        }
        $this->actingAs($this->usuario())->get('/clientes')
            ->assertSee('Página 1 de 2')->assertDontSee('Cliente 20');
    }
}
