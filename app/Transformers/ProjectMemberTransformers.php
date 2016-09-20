<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 20/09/16
 * Time: 13:21
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformers extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name,
        ];
    }

}