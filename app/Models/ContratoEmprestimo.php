<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoEmprestimo extends Model {
    use HasFactory;

    protected $table = 'contratos_emprestimos'; 

    protected $fillable = [
        'cliente_id', 'valor', 'gerente_comercial_id', 
        'gerente_regional_id', 'superintendente_id', 'status'
    ];

    public function comissoes() {
        return $this->hasMany(Comissoes::class);
    }
}
