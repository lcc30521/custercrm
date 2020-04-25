<?php

namespace App\Admin\Controllers;

use App\Repair;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
/* use Encore\Admin\Layout\{Column, Row, Content}; */
class RepairController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '报修列表';
    
    /**
     * show the index
     *
     * 
     */
   /*  public function index(Content $content){
        return redirect()->route('repair.grid');
    } */



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {  
        
        $grid = new Grid(new Repair());

        $grid->column('id', "ID");
        $grid->column('repair_num', "报单号");
        $grid->column('equipment_name', "设备名称");
       // $grid->column('equipment_id', "设备id");
        $grid->column('type', "故障类型");
        $grid->column('desc', "故障描述");
        $grid->column('image_path', "图片");
       // $grid->column('user_id', "报修人员id");
        $grid->column('status', "报单状态");
        $grid->column('is_auto_confirm', "是否自动确认");
        $grid->column('start_repair_time', "开始时间");
        $grid->column('end_repair_time', "结束时间");
        //$grid->column('service_id', "维修人员id");
        $grid->column('hangup', "挂起状态");
        $grid->column('created_at', "创建时间");
        $grid->column('updated_at', "更新时间");
        //dd($grid);
        $grid->disableCreateButton();  //禁用新增按钮
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
        $show = new Show(Repair::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('repair_num', __('Repair num'));
        $show->field('equipment_name', __('Equipment name'));
        $show->field('equipment_id', __('Equipment id'));
        $show->field('type', __('Type'));
        $show->field('desc', __('Desc'));
        $show->field('image_path', __('Image path'));
        $show->field('user_id', __('User id'));
        $show->field('status', __('Status'));
        $show->field('is_auto_confirm', __('Is auto confirm'));
        $show->field('start_repair_time', __('Start repair time'));
        $show->field('end_repair_time', __('End repair time'));
        $show->field('service_id', __('Service id'));
        $show->field('hangup', __('Hangup'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Repair());
      
        $form->text('报单号', __('Repair num'));
        $form->text('设备名称', __('Equipment name'));
        //$form->number('equipment_id', __('Equipment id'));
        $form->switch('故障类型', __('Type'));
        $form->textarea('故障描述', __('Desc'));
        $form->textarea('图片', __('Image path'));
        $form->number('报修人', __('User id'));
        $form->switch('当前状态', __('Status'));
        $form->switch('是否自动确认', __('Is auto confirm'));
        $form->number('开始维修时间', __('Start repair time'));
        $form->number('完成维修时间', __('End repair time'));
        $form->number('维修人员', __('Service id'));
        $form->switch('挂起状态', __('Hangup'));

        return $form;
    }
}
