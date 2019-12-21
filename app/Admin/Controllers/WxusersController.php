<?php

namespace App\Admin\Controllers;

use App\wxmodel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WxusersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户后台管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new wxmodel);

        $grid->column('uid', __('Uid'));
        $grid->column('sub_time', __('Sub time'))->display(function ($time){
            return date('Y-m-d H:i:s',$time);
        });
        $grid->column('sex', __('Sex'))->display(function ($sex){
            if($sex==1){
                return '男';
            }else if($sex==2){
                return '女';
            }else if($sex==0){
                echo '保密';
            }
        });
        $grid->column('nickname', __('Nickname'));
        $grid->column('create_at', __('Create at'));
        $grid->column('update_at', __('Update at'));
        $grid->column('openid', __('Openid'));
        $grid->column('img', __('img'))->display(function ($img){
            return '<img src='. $img .' height="50">';
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
        $show = new Show(wxmodel::findOrFail($id));

        $show->field('uid', __('Uid'));
        $show->field('sub_time', __('Sub time'));
        $show->field('sex', __('Sex'));
        $show->field('nickname', __('Nickname'));
        $show->field('create_at', __('Create at'));
        $show->field('update_at', __('Update at'));
        $show->field('openid', __('Openid'));
        $show->field('style', __('Style'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new wxmodel);

        $form->text('sub_time', __('Sub time'));
        $form->switch('sex', __('Sex'));
        $form->text('nickname', __('Nickname'));
        $form->datetime('create_at', __('Create at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('update_at', __('Update at'))->default(date('Y-m-d H:i:s'));
        $form->text('openid', __('Openid'));
        $form->text('style', __('Style'));

        return $form;
    }
}
