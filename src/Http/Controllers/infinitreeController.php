<?php

namespace Encore\infinitree\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;


use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class infinitreeController extends Controller
{
    
    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
        ->title("infinitree")
        ->description("无限级分类")
        ->row(function (Row $row) {
            $row->column(6, $this->treeView()->render());
            
            $row->column(6, function (Column $column) {
                $form = new \Encore\Admin\Widgets\Form();
                $form->action(admin_url('infinitree'));
                
                //$menuModel = config('admin.database.menu_model');
                $menuModel = new \Encore\infinitree\Http\Models\infinitreeModel();
                
                $form->select('parent_id', trans('admin.parent_id'))->options($menuModel::selectOptions());
                $form->text('title', trans('admin.title'))->rules('required');

                $form->hidden('_token')->default(csrf_token());
                
                $column->append((new Box(trans('admin.new'), $form))->style('success'));
            });
        });
    }
    
    /**
     * Redirect to edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->route('admin.auth.menu.edit', ['menu' => $id]);
    }
    
    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        $menuModel = new \Encore\infinitree\Http\Models\infinitreeModel();
        
        return $menuModel::tree(function (Tree $tree) {
            $tree->disableCreate();
            
            $tree->branch(function ($branch) {
                return "<strong>{$branch['title']}</strong>";
            });
        });
    }
    
    /**
     * Edit interface.
     *
     * @param string  $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
        ->title(trans('admin.menu'))
        ->description(trans('admin.edit'))
        ->row($this->form()->edit($id));
    }
    
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $menuModel = new \Encore\infinitree\Http\Models\infinitreeModel();

        
        $form = new Form(new $menuModel());
        
        $form->display('id', 'ID');
        
        $form->select('parent_id', trans('admin.parent_id'))->options($menuModel::selectOptions());
        $form->text('title', trans('admin.title'))->rules('required');

        
        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));
        
        return $form;
    }
    
    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->form()->update($id);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->form()->store();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }
}