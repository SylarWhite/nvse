<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Schema;

class ArticleController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $article = new Article();
        $grid = new Grid($article);
        $lang = $article->getTable();

        foreach ($article->Columns() as $column){
            switch ($column){
                case 'id':
                    break;
                case 'content':
                case 'title':
                    $grid->column($column,trans("$lang.$column"))->limit(10);
                    break;
                case 'cover':
                    $grid->column($column,trans("$lang.$column"))->image('',100,100);
                    break;
                case 'type':
                    $grid->column($column,trans("$lang.$column"))->implode(',');
                    break;
                default:
                    $grid->column($column,trans("$lang.$column"));
                    break;
            }
        }



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
        $show = new Show(Article::findOrFail($id));

        $show->id('ID');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $article = new Article();
        $form = new Form($article);
        $lang = $article->getTable();


        foreach ($article->Columns() as $column){
            switch ($column){
                case 'title':
                case 'desc':
                    $form->text($column,trans("$lang.$column"))->rules(['required']);
                    break;
                case 'price':
                    $form->currency($column,trans("$lang.$column"))->symbol('￥');
                    break;
                case 'type':
                    $form->multipleSelect($column,trans("$lang.$column"))->options($article->cate)->rules(['required']);
                    break;
                case 'content':
                    $form->textarea($column,trans("$lang.$column"));
                    break;
                case 'allow_comment':
                    $form->switch($column,trans("$lang.$column"))->states($this->STATES)->default(1);
                    break;
                case 'cover':
                    $form->file($column,trans("$lang.$column"))
                        ->uniqueName()
                        ->move('public/uploads/cover/')
                    ->removable()
                        ->rules('mimes:jpg,png,jpeg');
                    break;
                default:
                    break;
            }

        }



        return $form;
    }
}
