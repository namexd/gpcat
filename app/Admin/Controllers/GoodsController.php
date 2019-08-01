<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ImportPost;
use App\Admin\Extensions\PostsExporter;
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
        $good=new Good;
        $grid = new Grid($good);
        $grid->actions(function ($action){
           $action->disableDelete();
        });
        $grid->column('id', __('Id'));
        $grid->column('brand', __('Brand'))->filter($good->getFilters('brand'))->sortable();
        $grid->column('image', __('Image'))->image();
        $grid->column('type', __('Type'))->filter($good->getFilters('type'));
        $grid->column('model', __('Model'))->filter($good->getFilters('model'));
        $grid->column('number', __('Number'))->sortable();
        $grid->column('unit', __('Unit'))->filter($good->getFilters('unit'));
        $grid->column('product_area', __('Product area'))->filter($good->getFilters('product_area'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('price_a', __('Price a'))->sortable();
        $grid->column('price_b', __('Price b'))->sortable();
        $grid->column('package', __('Package'))->sortable();
        $grid->column('supplier', __('Supplier'))->filter($good->getFilters('supplier'));
        $grid->column('repository', __('Repository'))->filter($good->getFilters('repository'));
        $grid->column('oil', __('Oil'))->sortable();
        $grid->column('size', __('Size'))->filter($good->getFilters('size'))->sortable();
        $grid->column('inner_diameter', __('Inner diameter'))->sortable();
        $grid->column('out_diameter', __('Out diameter'))->sortable();
        $grid->column('width', __('Width'))->sortable();
        $grid->column('weight', __('Weight'))->sortable();
        $grid->column('days', __('Days'))->filter($good->getFilters('days'))->sortable();
        $grid->column('comment', __('Comment'));
//        $grid->column('extra1', __('Extra1'));
//        $grid->column('extra2', __('Extra2'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportPost());
        });
        $grid->exporter(new PostsExporter());
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
        $show->field('image', __('Image'));
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
