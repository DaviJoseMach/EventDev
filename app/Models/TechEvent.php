<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechEvent extends Model
{
    protected $table = 'tech_events'; // Nome da tabela no banco de dados
    protected $fillable = [
        'nome_evento', 'localizacao', 'descricao', 'categoria', 'valor_entrada', 'data_inicio', 'data_fim'
    ]; // Campos que podem ser preenchidos
}
