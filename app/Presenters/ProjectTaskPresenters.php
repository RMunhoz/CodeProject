<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 29/09/16
 * Time: 22:39
 */

namespace CodeProject\Presenters;


use CodeProject\Transformers\ProjectTaskTransformers;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectTaskPresenters extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTaskTransformers();
    }
}