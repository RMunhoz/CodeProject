<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 29/09/16
 * Time: 22:18
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ClientTransformers;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenters extends FractalPresenter
{

    public function getTransformer()
    {
        return new ClientTransformers();
    }
}