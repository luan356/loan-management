<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContratoEmprestimoRepository;
use App\Models\Comissoes;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ValidationContratoRequest;


class ContratoEmprestimoController extends Controller
{
    protected $repositorio;

    public function __construct(ContratoEmprestimoRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function armazenar(ValidationContratoRequest $request) // request personalizada
    {
       /* $dados = $request->only(['cliente_id', 'valor', 'cargo_id']);
    
        $validado = validated($dados, [
            'cliente_id' => 'required|integer',
            'valor' => 'required|numeric',
            'cargo_id' => 'required|in:1,2,3', // Só pode ser 1, 2 ou 3
        ])->validate();*/
    

        $validado = $request->validated(); //  dados validados pela StoreContratoRequest

    
        $dadosContrato = [
            'cliente_id' => $validado['cliente_id'],
            'valor' => $validado['valor'],
            'gerente_comercial_id' => ($validado['cargo_id'] == 1) ? 1 : null,
            'gerente_regional_id' => ($validado['cargo_id'] == 2) ? 2 : null,
            'superintendente_id' => ($validado['cargo_id'] == 3) ? 3 : null,
        ];
    
        $contrato = $this->repositorio->criar($dadosContrato);
    
        $comissoes = [
            1 => ['percentual' => 0.06, 'cargo' => 'gerente_comercial'],
            2 => ['percentual' => 0.03, 'cargo' => 'gerente_regional'],
            3 => ['percentual' => 0.01, 'cargo' => 'superintendente'],
        ];
    
        $cargoInfo = $comissoes[$validado['cargo_id']];
        $comissaoValor = $contrato->valor * $cargoInfo['percentual'];
        $usuarioId = $validado['cargo_id']; 

        Comissoes::create([
            'contrato_emprestimo_id' => $contrato->id,
            'usuario_id' => $usuarioId,
            'cargo' => $cargoInfo['cargo'],
            'valor' => $comissaoValor,
        ]);
    
        return response()->json([
            'message' => 'Contrato e comissão criados com sucesso!',
            'contrato' => $contrato,
            'comissao' => [
                'cargo' => $cargoInfo['cargo'],
                'valor' => $comissaoValor,
            ],
        ]);
    }
    

    public function listar()
    {
        return response()->json($this->repositorio->obterTodos());
    }

    public function atualizarStatus(Request $request, $id)
    {
        $validado = $request->validate(['status' => 'required|in:pendente,aprovado,rejeitado']);
        return response()->json($this->repositorio->atualizar($id, $validado));
    }

    public function deletar($id)
    {
        return response()->json($this->repositorio->deletar($id));
    }



        public function obterCliente($clienteId)
        {
            try {
                $response = Http::get("https://jsonplaceholder.typicode.com/users/{$clienteId}");
        
                if ($response->successful()) {
                    return response()->json($response->json(), 200);
                }
        
                if ($response->clientError()) {
                    return response()->json([
                        'error' => 'client não encontrado.',
                        'details' => $response->json()
                    ], 404);  
                }
        
                if ($response->serverError()) {
                    return response()->json([
                        'error' => 'erro no servidor  api externa.',
                        'details' => $response->json()
                    ], 500);  
                }
        
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'erro  d conexao com a API .',
                    'message' => $e->getMessage()
                ], 500); 
            }
        }
        
    }

