<?php

namespace App\Admin\Controllers;

use App\Entities\Expert;
use App\Entities\SustainableDevelopmentGoal;
use App\Entities\UnitType;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExpertController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '永續實踐家';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Expert());

        $grid->column('unitType.name', '單位類別');
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
        $show = new Show(Expert::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Expert());
        $form->multipleSelect('sustainableDevelopmentGoals', '符合的永續發展目標項目')
            ->options(
                SustainableDevelopmentGoal::all()
                    ->pluck('name', 'id')
            )
            ->required();
        $form->select('unit_type_id', '單位類別')
            ->options(UnitType::all()->pluck('name', 'id'))
            ->required();
        $form->text('unit_name', '單位名稱')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->date('date', '日期')->required();
        $form->textarea('summary', '內容大綱')->required();
        $form->textarea('intro', '組織介紹')->required();
        $form->textarea('solution', '解決方案')->required();
        $form->url('url', '官方網站');
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);

        return $form;
    }
}
