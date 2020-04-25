<?php

namespace App;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Departmemt extends Model
{   

    use ModelTree; 
    use AdminBuilder;
    //
    protected $fillable = [
        'name', 'parent_id', 'sort','is_show','updated_at','created_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn('parent_id');  // 父ID
        $this->setOrderColumn('sort'); // 排序
        $this->setTitleColumn('name'); // 标题
    }
    /**
     * 该部门下的子部门
     */
    public function child()
    {
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }
 
    /**
     * 该部门的上级部门
     */
    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parent_id');
    }

      /**
     * 该部门下的员工
     */
    public function users()
    {
        return $this->hasMany('User', 'id', 'department_id');
    }
}
