<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;

class DeleteData extends Action
{

    public function html()
    {
        return view('admin.delete_data')->render();
    }
}