<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\SyncData;
use App\Models\ApiData;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApiDatasController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'API数据源';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ApiData);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('auth_url', __('Auth url'));
        $grid->column('data_url', __('Data url'));
        $grid->column('auth_params', __('Auth Params'))->table();
        $grid->column('data_params', __('Data Params'))->table();
        $grid->column('translate', __('Translate'))->table();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->add(new SyncData());
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
        $show = new Show(ApiData::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('auth_url', __('Auth url'));
        $show->field('data_url', __('Data url'));
        $show->field('auth_params', __('Auth Params'));
        $show->field('data_params', __('Data Params'));
        $show->field('translate', __('Translate'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ApiData);

        $form->text('name', __('Name'));
        $form->url('auth_url', __('Auth url'));
        $form->url('data_url', __('Data url'));
        $form->table('auth_params', __('Auth Params'),function ($table){
            $table->text('key');
            $table->text('value');
        });
        $form->table('data_params', __('Data Params'),function ($table){
            $table->text('key');
            $table->text('value');
        });
        $form->table('translate', __('Translate'),function ($table){
            $table->text('origin','原始参数');
            $table->text('local','转换参数');
        });

        return $form;
    }
}
