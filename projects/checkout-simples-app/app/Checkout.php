<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = ['cliente', 'email', 'cupom_id', 'forma_pagamento_id', 'valor_desconto', 'total'];
}