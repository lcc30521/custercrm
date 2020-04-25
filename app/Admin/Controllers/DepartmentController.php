<?php

namespace App\Admin\Controllers;

use App\Departmemt;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\{Column, Row, Content};
use Encore\Admin\{Tree};
use Encore\Admin\Widgets\Box;
use Illuminate\Http\RedirectResponse;
use Request;
class DepartmentController extends AdminController
{   

    use HasResourceActions;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '部门管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Departmemt());
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
        $show = new Show(Departmemt::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Departmemt());
        $form->display('id', 'ID');
        $form->select('parent_id', __('上级部门'))->options(Departmemt::selectOptions());
        $form->text('name', __('部门名称'))->required();
        $form->number('sort', __('排序值'))->default(99)->help('越小越靠前');
        return $form;
    }


     /**
     * 首页
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {  
        return $content->title('部门列表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('departmemts'));
                   // $form->method();
                    $form->select('parent_id', __('上级部门'))->options(Departmemt::selectOptions());
                    $form->text('name', __('部门名称'))->required();
                    $form->number('sort', __('排序'))->default(99)->help('越小越靠前');
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('新建部门'), $form))->style('success'));
                });
 
            });
    }


    /**
     * 树状视图
     * @return Tree
     */
    protected function treeView()
    {
        return  Departmemt::tree(function (Tree $tree){
            $tree->disableCreate(); // 关闭新增按钮
            $tree->branch(function ($branch) {
                return "<strong>{$branch['name']}</strong>"; // 标题添加strong标签
            });
        });
    }

    /**
     * 详情页
     * @param $id
     * @return RedirectResponse
     */
   /*  public function show($id)
    {
        return redirect()->route('departments.edit', ['id' => $id]);
    } */

       /**
     * 编辑
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content->title(__('编辑部门'))
            ->description(__('edit'))
            ->row($this->form()->edit($id));
    }
}
