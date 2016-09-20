<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 20/09/16
 * Time: 16:19
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformers;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenters extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectTransformers();
    }
}