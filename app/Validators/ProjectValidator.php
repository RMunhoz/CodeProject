<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 26/08/16
 * Time: 19:52
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'name'          => 'required|max:255',
        'description'   => 'required|max:255',
        'progress'      => 'required',
        'status'        => 'required',
        'due_date'      => 'required',
        'owner_id'     => 'required',
        'client_id'     => 'required'

    ];


}