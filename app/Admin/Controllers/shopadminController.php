<?php

namespace App\Admin\Controllers;

use App\shopadmin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class shopadminController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\shopadmin';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new shopadmin);

        $grid->column('sid', __('Sid'));
        $grid->column('name', __('Name'));
        $grid->column('price', __('Price'));
        $grid->column('create_at', __('Create at'));
        $grid->column('update_at', __('Update at'));
        $grid->column('num', __('Num'));
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
        $show = new Show(shopadmin::findOrFail($id));

        $show->field('sid', __('Sid'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('create_at', __('Create at'));
        $show->field('update_at', __('Update at'));
        $show->field('num', __('Num'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new shopadmin);

        $form->text('name', __('Name'));
        $form->decimal('price', __('Price'));
        $form->datetime('create_at', __('Create at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('update_at', __('Update at'))->default(date('Y-m-d H:i:s'));
        $form->number('num', __('Num'));

        return $form;
    }
}
