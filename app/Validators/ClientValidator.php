<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 25/08/16
 * Time: 14:28
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name'          => 'required|max:255',
        'responsible'   => 'required|max:255',
        'email'         => 'required|email',
        'phone'         => 'required',
        'address'       => 'required'
    ];
}