<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutIten extends Model
{
    protected $fillable = ['descricao', 'checkout_id', 'produto_id'];
}