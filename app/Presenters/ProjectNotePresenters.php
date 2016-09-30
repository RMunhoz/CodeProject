<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 29/09/16
 * Time: 22:27
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectNoteTransformers;
use CodeProject\Transformers\ProjectTransformers;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectNotePresenters extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectNoteTransformers();
    }
}