<?php

namespace App\Admin\Controllers;

use App\Entities\ExpertContactForm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExpertContactFormController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ExpertContactForm';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExpertContactForm());

        $grid->column('expert.unit_name', '永續實踐家');
        $grid->column('name', '姓名');
        $grid->column('unit_and_job_title', '單位 / 職稱');
        $grid->column('created_at', '建立時間');

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

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
        $show = new Show(ExpertContactForm::findOrFail($id));
        $show->field('expert.unit_name', '永續實踐家');
        $show->field('name', '姓名');
        $show->field('email', 'E-mail');
        $show->field('phone', '電話');
        $show->field('unit_and_job_title', '單位 / 職稱');
        $show->field('content', '內容');

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
            });;

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ExpertContactForm());

        return $form;
    }
}
