<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // indicar o nome da tabela 
    protected $table = 'bills';

    // indicar quais colunas podem ser cadastrado
    protected $fillable = ['name', 'bill_value', 'due_date']; 
}
