<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transactions_id', 'username', 'nationality', 'is_visa', 'is_vaksin', 'doe_passport'
    ];

    protected $hidden = [

    ];

    public function transaction(){
        return $this->belongsTo( Transaction::class, 'transactions_id', 'id' );
    }


}
