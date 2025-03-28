<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comissoes extends Model {
    use HasFactory;

    protected $fillable = [
        'contrato_emprestimo_id', 'usuario_id', 'cargo', 'valor'
    ];
}
