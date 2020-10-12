<?php

namespace App\Admin\Controllers;

use App\Entities\HomepageCarousel;
use App\Generators\FilenameGenerator;
use App\Transformers\FilenameTransformer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class HomepageCarouselController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '首頁輪播圖片';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HomepageCarousel());

        $grid->column('id', 'ID');
        $grid->column('title', '標題');
        $grid->column('image_path', '圖片')->image();
        $grid->column('url', '網址');
        $grid->column('release_start_at', '上架時間')->sortable();
        $grid->column('release_end_at', '下架時間')->sortable();
        $grid->column('display_order', '顯示排序')->sortable();
        $grid->column('enabled', '啟用狀態')->display(function ($enabled) {
            return $enabled ? '啟用' : '停用';
        });;

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
        $show = new Show(HomepageCarousel::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new HomepageCarousel());

        $form->text('title', '標題')->required();
        $form->image('image_path', '圖片')
            ->help('建議長寬：')
            ->name(FilenameTransformer::get())
            ->required();
        $form->url('url', '點擊前往網址')->required();
        $form->datetimeRange(
            'release_start_at',
            'release_end_at',
            '上下架時間'
        )->default([
            'start' => now()->startOfDay(),
            'end' => now()->addMonth()->endOfDay()
        ])->required();
        $form->number('display_order', '顯示排序')
            ->help('數字越小越前面')
            ->default(0);
        $form->switch('enabled', '啟用狀態')->default(false);

        return $form;
    }
}
