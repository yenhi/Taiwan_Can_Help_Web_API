<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Entities\Epaper;
use Encore\Admin\Controllers\AdminController;

class EpaperController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '電子報訂閱名單';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Epaper());

        $grid->column('email', 'E-mail');
        $grid->column('created_at', '訂閱時間');

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
        $show = new Show(Epaper::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Epaper());

        $form->email('email', 'E-mail');

        return $form;
    }
}
