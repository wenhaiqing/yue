<?php
namespace App\Presenters\Admin;

class CategoryPresenter
{
	public function categoryNestable($categories)
	{
		if ($categories) {
			$item = '';
			foreach ($categories as $v) {
				$item.= $this->getNestableItem($v);
			}
			return $item;
		}
		return '暂无分类';
	}

	/**
	 * 返回分类HTML代码
	 * @author wenhaiqing
	 * @date   2017-09-04T11:05:21+0800
	 * @param  [type]                   $menu [description]
	 * @return [type]                         [description]
	 */
	protected function getNestableItem($category)
	{
		$icon = '';
		if ($category['child']) {
			return $this->getHandleList($category['id'],$category['name'],$icon,$category['child']);
		}
		$labelInfo = $category['pid'] == 0 ?  'label-info':'label-warning';
		return <<<Eof
				<li class="dd-item dd3-item" data-id="{$category['id']}">
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span class="label {$labelInfo}">{$icon}</span> {$category['name']} {$this->getActionButtons($category['id'])}</div>
                </li>
Eof;
	}
	/**
	 * 判断是否有子集
	 * @author wenhaiqing
	 * @date   2016-11-04T11:05:28+0800
	 * @param  [type]                   $id    [description]
	 * @param  [type]                   $name  [description]
	 * @param  [type]                   $child [description]
	 * @return [type]                          [description]
	 */
	protected function getHandleList($id,$name,$icon,$child)
	{
		$handle = '';
		if ($child) {
			foreach ($child as $v) {
				$handle .= $this->getNestableItem($v);
			}
		}

		$html = <<<Eof
		<li class="dd-item dd3-item" data-id="{$id}">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
            	<span class="label label-info">{$icon}</span> {$name} {$this->getActionButtons($id)}
            </div>
            <ol class="dd-list">
                {$handle}
            </ol>
        </li>
Eof;
		return $html;
	}

	/**
	 * 分类按钮
	 * @author wenhaiqing
	 * @date   2017-08-01T10:02:36+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	protected function getActionButtons($id)
	{
		$action = '<div class="pull-right">';
		$encodeId =  [encodeId($id, 'category')];
		if (haspermission('categorycontroller.show')) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips showInfo" data-href="'.route('category.show',  $encodeId).'" data-toggle="tooltip" data-original-title="'.trans('common.show').'"  data-placement="top"><i class="fa fa-eye"></i></a>';
		}
		if (haspermission('categorycontroller.edit')) {
			$action .= '<a href="javascript:;" data-href="'.route('category.edit', $encodeId).'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="'.trans('common.edit').'"  data-placement="top"><i class="fa fa-edit"></i></a>';
		}
		if (haspermission('categorycontroller.destroy')) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="'.trans('common.delete').'"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.route('category.destroy',  $encodeId).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
		}
		$action .= '</div>';
		return $action;
	}
	/**
	 * 根据用户不同的权限显示不同的内容
	 * @author wenhaiqing
	 * @date   2016-11-04T13:40:11+0800
	 * @return [type]                   [description]
	 */
	public function canCreateCategory()
	{
		$canCreateCategory = haspermission('permissioncontroller.create');

		$title = $canCreateCategory ?  trans('category.welcome'):trans('category.sorry');
		$desc = $canCreateCategory ? trans('category.description'):trans('category.description_sorry');
		$createButton = $canCreateCategory ? '<br><a href="javascript:;" class="btn btn-primary m-t create_menu">'.trans('category.create').'</a>':'';
		return <<<Eof
		<div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">{$title}</h3>
            <div class="error-desc">
                {$desc}{$createButton}
            </div>
        </div>
Eof;
	}
	/**
	 * 添加修改分类关系select
	 * @author wenhaiqing
	 * @date   2017-09-04T16:29:51+0800
	 * @param  [type]                   $menus [description]
	 * @param  string                   $pid   [description]
	 * @return [type]                          [description]
	 */
	public function topCategoryList($categories,$pid = '')
	{
		$html = '<option value="0">'.trans('category.topCategory').'</option>';
		if ($categories) {
			foreach ($categories as $v) {
				$html .= '<option value="'.$v['id'].'" '.$this->checkMenu($v['id'],$pid).'>'.$v['name'].'</option>';
			}
		}
		return $html;
	}

	public function checkMenu($menuId,$pid)
	{
		if ($pid !== '') {
			if ($menuId == $pid) {
				return 'selected="selected"';
			}
			return '';
		}
		return '';
	}
	/**
	 * 获取分类关系名称
	 * @author wenhaiqing
	 * @date   2016-11-04
	 * @param  [type]     $menus [所有菜单数据]
	 * @param  [type]     $pid   [菜单关系pid]
	 * @return [type]            [description]
	 */
	public function topCategoryName($categorys,$pid)
	{
		if ($pid == 0) {
			return '顶级分类';
		}
		if ($categorys) {
			foreach ($categorys as $v) {
				if ($v['id'] == $pid) {
					return $v['name'];
				}
			}
		}
		return '';
	}
	
}