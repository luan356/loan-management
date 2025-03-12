<?php

namespace App\Repositories;

use App\Models\ContratoEmprestimo;

class ContratoEmprestimoRepository {
    public function criar(array $dados) {
        return ContratoEmprestimo::create($dados);
    }

    public function obterTodos($porPagina = 5) {
        return ContratoEmprestimo::paginate($porPagina);
    }

    public function obterPorId($id) {
        return ContratoEmprestimo::find($id);
    }

    public function atualizar($id, array $dados) {
        $contrato = ContratoEmprestimo::find($id);
        if ($contrato) {
            $contrato->update($dados);
            return $contrato;
        }
        return null;
    }

    public function deletar($id) {
        return ContratoEmprestimo::destroy($id);
    }
}
