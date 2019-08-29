<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ImportPost;
use App\Admin\Extensions\PostsExporter;
use App\Models\Good;
use App\Models\Supplier;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class SuppliersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '供应商';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Supplier());
        $grid->disableExport();
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableTools();
        $grid->disableRowSelector();
        $grid->column('id', __('Id'));
        $grid->column('supplier', __('Supplier'));
        $grid->column('brand', __('BrandCount'))->display(function ($value) {
            $model = $this->brand_list;
            return view('admin.show_detail', compact('model', 'value'))->render();
        })->sortable();
        $grid->column('model', __('ModelCount'));
        $grid->column('number', __('Number'))->sortable();
        $grid->column('price', __('Price'))->sortable();
        $grid->column('repository', __('RepositoryCount'))->display(function ($value) {
            $model = $this->repository_list;
            return view('admin.show_detail', compact('model', 'value'))->render();
        });
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Good::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('brand', __('Brand'));
        $show->field('image', __('Image'))->image();
        $show->field('type', __('Type'));
        $show->field('model', __('Model'));
        $show->field('number', __('Number'));
        $show->field('unit', __('Unit'));
        $show->field('product_area', __('Product area'));
        $show->field('price', __('Price'));
        $show->field('price_a', __('Price a'));
        $show->field('price_b', __('Price b'));
        $show->field('package', __('Package'));
        $show->field('supplier', __('Supplier'));
        $show->field('repository', __('Repository'));
        $show->field('oil', __('Oil'));
        $show->field('size', __('Size'));
        $show->field('inner_diameter', __('Inner diameter'));
        $show->field('out_diameter', __('Out diameter'));
        $show->field('width', __('Width'));
        $show->field('weight', __('Weight'));
        $show->field('days', __('Days'));
        $show->field('comment', __('Comment'));
//        $show->field('extra1', __('Extra1'));
//        $show->field('extra2', __('Extra2'));
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
        $form = new Form(new Good);

        $form->text('brand', __('Brand'));
        $form->image('image', __('Image'));
        $form->text('type', __('Type'));
        $form->text('model', __('Model'));
        $form->number('number', __('Number'));
        $form->text('unit', __('Unit'));
        $form->text('product_area', __('Product area'));
        $form->decimal('price', __('Price'));
        $form->decimal('price_a', __('Price a'));
        $form->decimal('price_b', __('Price b'));
        $form->text('package', __('Package'));
        $form->text('supplier', __('Supplier'));
        $form->text('repository', __('Repository'));
        $form->text('oil', __('Oil'));
        $form->text('size', __('Size'));
        $form->decimal('inner_diameter', __('Inner diameter'));
        $form->decimal('out_diameter', __('Out diameter'));
        $form->decimal('width', __('Width'));
        $form->decimal('weight', __('Weight'));
        $form->text('days', __('Days'));
        $form->text('comment', __('Comment'));
//        $form->text('extra1', __('Extra1'));
//        $form->text('extra2', __('Extra2'));

        return $form;
    }
}
