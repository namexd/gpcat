<?php

namespace App\Admin\Controllers;

use App\Models\Good;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Good);

        $grid->column('id', trans('Id'));
        $grid->column('brand', trans('admin.Brand'));
        $grid->column('image', trans('admin.Image'));
        $grid->column('type', trans('admin.Type'));
        $grid->column('model', trans('admin.Model'));
        $grid->column('number', trans('admin.Number'));
        $grid->column('unit', trans('admin.Unit'));
        $grid->column('product_area', trans('admin.Product area'));
        $grid->column('price', trans('admin.Price'));
        $grid->column('price_a', trans('admin.Price a'));
        $grid->column('price_b', trans('admin.Price b'));
        $grid->column('package', trans('admin.Package'));
        $grid->column('supplier', trans('admin.Supplier'));
        $grid->column('repository', trans('admin.Repository'));
        $grid->column('oil', trans('admin.Oil'));
        $grid->column('size', trans('admin.Size'));
        $grid->column('inner_diameter', trans('admin.Inner diameter'));
        $grid->column('out_diameter', trans('admin.Out diameter'));
        $grid->column('width', trans('admin.Width'));
        $grid->column('weight', trans('admin.Weight'));
        $grid->column('days', trans('admin.Days'));
        $grid->column('comment', trans('admin.Comment'));
        $grid->column('extra1', trans('admin.Extra1'));
        $grid->column('extra2', trans('admin.Extra2'));
        $grid->column('created_at', trans('admin.Created at'));
        $grid->column('updated_at', trans('admin.Updated at'));

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

        $show->field('id', trans('admin.Id'));
        $show->field('brand', trans('admin.Brand'));
        $show->field('image', trans('admin.Image'));
        $show->field('type', trans('admin.Type'));
        $show->field('model', trans('admin.Model'));
        $show->field('number', trans('admin.Number'));
        $show->field('unit', trans('admin.Unit'));
        $show->field('product_area', trans('admin.Product area'));
        $show->field('price', trans('admin.Price'));
        $show->field('price_a', trans('admin.Price a'));
        $show->field('price_b', trans('admin.Price b'));
        $show->field('package', trans('admin.Package'));
        $show->field('supplier', trans('admin.Supplier'));
        $show->field('repository', trans('admin.Repository'));
        $show->field('oil', trans('admin.Oil'));
        $show->field('size', trans('admin.Size'));
        $show->field('inner_diameter', trans('admin.Inner diameter'));
        $show->field('out_diameter', trans('admin.Out diameter'));
        $show->field('width', trans('admin.Width'));
        $show->field('weight', trans('admin.Weight'));
        $show->field('days', trans('admin.Days'));
        $show->field('comment', trans('admin.Comment'));
        $show->field('extra1', trans('admin.Extra1'));
        $show->field('extra2', trans('admin.Extra2'));
        $show->field('created_at', trans('admin.Created at'));
        $show->field('updated_at', trans('admin.Updated at'));

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

        $form->text('brand', trans('admin.Brand'));
        $form->text('image', trans('admin.Image'));
        $form->text('type', trans('admin.Type'));
        $form->text('model', trans('admin.Model'));
        $form->number('number', trans('admin.Number'));
        $form->text('unit', trans('admin.Unit'));
        $form->text('product_area', trans('admin.Product area'));
        $form->decimal('price', trans('admin.Price'));
        $form->decimal('price_a', trans('admin.Price a'));
        $form->decimal('price_b', trans('admin.Price b'));
        $form->text('package', trans('admin.Package'));
        $form->text('supplier', trans('admin.Supplier'));
        $form->text('repository', trans('admin.Repository'));
        $form->text('oil', trans('admin.Oil'));
        $form->text('size', trans('admin.Size'));
        $form->decimal('inner_diameter', trans('admin.Inner diameter'));
        $form->decimal('out_diameter', trans('admin.Out diameter'));
        $form->decimal('width', trans('admin.Width'));
        $form->decimal('weight', trans('admin.Weight'));
        $form->text('days', trans('admin.Days'));
        $form->text('comment', trans('admin.Comment'));
        $form->text('extra1', trans('admin.Extra1'));
        $form->text('extra2', trans('admin.Extra2'));

        return $form;
    }
}
