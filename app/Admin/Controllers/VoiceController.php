<?php

namespace App\Admin\Controllers;

use App\wx\VoiceModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VoiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\wx\VoiceModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VoiceModel);

        $grid->column('vid', __('Vid'));
        $grid->column('voice', __('Voice'));

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
        $show = new Show(VoiceModel::findOrFail($id));

        $show->field('vid', __('Vid'));
        $show->field('voice', __('Voice'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VoiceModel);

        $form->text('voice', __('Voice'));

        return $form;
    }
}
