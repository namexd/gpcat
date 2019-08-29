<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ImportPost;
use App\Admin\Extensions\PostsExporter;
use App\Models\Brand;
use App\Models\Good;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class BrandsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '品牌';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Brand);
        $grid->disableExport();
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableTools();
        $grid->disableRowSelector();
        $grid->column('id', __('Id'));
        $grid->column('brand', __('Brand'))->sortable();
        $grid->column('model', __('ModelCount'));
        $grid->column('number', __('Number'))->sortable();
        $grid->column('price', __('Price'))->sortable();
        $grid->column('supplierCount', '对接供应商家数')->sortable();
        $grid->column('supplier', __('Supplier'))->display(function ($supplier) {

            return explode(',',$supplier);

        })->label();
        $grid->column('repository', __('RepositoryCount'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

}
