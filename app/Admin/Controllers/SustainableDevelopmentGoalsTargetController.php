<?php

namespace App\Admin\Controllers;

use App\Entities\SustainableDevelopmentGoal;
use App\Entities\SustainableDevelopmentGoalsTarget;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SustainableDevelopmentGoalsTargetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '永續發展目標 - 細項指標';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SustainableDevelopmentGoalsTarget());

        $grid->column('sustainableDevelopmentGoal.name', '隸屬發展目標');
        $grid->column('code', '代號');
        $grid->column('name', '目標名稱');
        $grid->column('image_path', '圖片')->image();
        $grid->column('display_order', '顯示排序')->sortable();
        $grid->model()->orderBy('display_order', 'ASC');
        $grid->model()->orderBy('code', 'ASC');

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
        $show = new Show(SustainableDevelopmentGoalsTarget::findOrFail($id));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SustainableDevelopmentGoalsTarget());

        $form->select('sustainable_development_goal_id', '隸屬發展目標')
            ->options(SustainableDevelopmentGoal::all()
                ->pluck('name', 'id')
            )->required();
        $form->text('code', '代號')->required();
        $form->text('name', '細項指標名稱')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->textarea('content', '內容')->required();
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);

        return $form;
    }
}
