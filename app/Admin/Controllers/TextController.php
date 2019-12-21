<?php

namespace App\Admin\Controllers;

use App\wx\TextModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TextController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\wx\TextModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TextModel);

        $grid->column('tid', __('Tid'));
        $grid->column('word', __('Word'));

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
        $show = new Show(TextModel::findOrFail($id));

        $show->field('tid', __('Tid'));
        $show->field('word', __('Word'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TextModel);

        $form->text('word', __('Word'));

        return $form;
    }
}
