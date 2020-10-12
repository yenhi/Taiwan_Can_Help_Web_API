<?php

namespace App\Admin\Controllers;

use App\Entities\Partner;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class PartnerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '合作夥伴';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Partner());

        $grid->column('id', 'ID');
        $grid->column('name', '夥伴名稱');
        $grid->column('image_path', '圖片')->image();
        $grid->column('url', '網址');
        $grid->column('display_order', '顯示排序')->sortable();

        $grid->model()->orderBy('display_order', 'ASC');

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
        $show = new Show(Partner::findOrFail($id));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Partner());

        $form->text('name', '夥伴名稱')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);
        $form->url('url', '點擊前往網址')->required();

        return $form;
    }
}
