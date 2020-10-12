<?php

namespace App\Admin\Controllers;

use App\Entities\Project;
use App\Entities\SustainableDevelopmentGoalsTarget;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '永續行動';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project());

        $grid->column('unit_type', '單位類別');
        $grid->column('unit_name', '單位名稱');
        $grid->column('image_path', '圖片')->image();
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
        $show = new Show(Project::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Project());

        $form->multipleSelect('sustainableDevelopmentGoalsTargets', '符合的永續發展目標細項指標')
            ->options(
                SustainableDevelopmentGoalsTarget::all()
                    ->map(function($target) {
                        return [
                            'id' => $target->id,
                            'name' => $target->code . ' - ' . $target->name,
                        ];
                    })
                    ->pluck('name', 'id')
            )
            ->required();

        $form->text('unit_type', '單位類別')->required();
        $form->text('unit_name', '單位名稱')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->date('date', '日期')->required();
        $form->textarea('summary', '內容大綱')->required();
        $form->UEditor('content', '內容')->required();
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);

        return $form;
    }
}
