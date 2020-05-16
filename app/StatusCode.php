<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class StatusCode extends Model
{
    /**
     * {@inheritdoc}
     */
    public $primaryKey = 'code';

    /**
     * {@inheritdoc}
     */
    public $timestamps = false;
}
