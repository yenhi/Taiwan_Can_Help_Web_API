<?php

namespace App\Admin\Controllers;

use App\Entities\SustainableDevelopmentGoal;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SustainableDevelopmentGoalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '永續發展目標';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SustainableDevelopmentGoal());

        $grid->column('code', '代號');
        $grid->column('name', '目標名稱');
        $grid->column('image_path', '圖片')->image();
        $grid->column('color_code', '代表色');
        $grid->column('display_order', '顯示排序')->sortable();

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
        $show = new Show(SustainableDevelopmentGoal::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SustainableDevelopmentGoal());

        $form->text('code', '代號')->required();
        $form->text('name', '目標名稱')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->color('color_code', '代表色')->required();
        $form->text('title', '標題')->required();
        $form->textarea('summary', '內容大綱')->required();
        $form->UEditor('content', '內容')->required();
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);


        return $form;
    }
}
