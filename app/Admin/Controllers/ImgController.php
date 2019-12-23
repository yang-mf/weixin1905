<?php

namespace App\Admin\Controllers;

use App\wx\ImgModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ImgController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\wx\ImgModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ImgModel);

        $grid->column('iid', __('Iid'));
        $grid->column('img', __('img'))->display(function ($img){
            return '<img src='.$img.'>';
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ImgModel::findOrFail($id));

        $show->field('iid', __('Iid'));
        $show->field('img', __('Img'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ImgModel);

        $form->image('img', __('Img'));

        return $form;
    }
}
