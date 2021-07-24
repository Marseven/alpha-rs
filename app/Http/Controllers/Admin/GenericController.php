<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenericController extends Controller
{
    protected  $model;

    /**
     * GenericController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getListView($view_params=null){

        $view_data = ['model'=>$this->model];

        if($view_params!=null){
            while ($key = key($view_params)) {
                $view_data[$key] = $view_params[$key];
                next($view_params);
            }
        }

        return view($this->model->getViewList(),$view_data);
    }

    public function showForm(Request $request, $parent_id=null,$_id=null){
        if($_id==null)  $_id = $parent_id;
        $model_class = get_class($this->model);
        if($_id!=null){
            $this->model =$model_class::find($_id);
        }
        $titles = array_values($this->model->getFields());
        $columns = array_keys($this->model->getFields());

        return view($this->model->getViewForm(),['titles'=>$titles,'columns'=>$columns,'model'=>$this->model]);
    }

    public function create($request){
        $primaryKey = $this->model->getPrimaryKey();
        $model_class = get_class($this->model);
        $methode_v = $this->model->getValidateMethode();
        $v = $model_class::$methode_v($request);


        if(!$v->passes()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        $fields = $this->model->getFields();
        $belongsTos = $this->model->getBelongsTo();
        $belongsToManys = $this->model->getBelongsToMany();
        $otherModels = $this->model->getOtherModels();

        while ($field = key($fields)) {
            if(!in_array($field,array_keys($belongsTos)) && !in_array($field,array_keys($belongsToManys)) && !in_array($field,$this->model->getHiddens()) && !in_array($field,$this->model->getFieldsHiddens())){
                if(in_array($field,$this->model->getFiles()) || in_array($field,$this->model->getImages())){
                    if($request->hasFile($field)){
                        $imagefile = $request->file($field);
                        $ext = $imagefile->getClientOriginalExtension();
                        $file = uniqid() . '.' . $ext;
                        $imagefile->move($this->model->getUploadsFolder(), $file);
                        $this->model->$field = $this->model->getUploadsFolder().$file;
                    }elseif ($this->model->$primaryKey!=null && $request->has('old_'.$field)){
                        $this->model->$field = null;
                    }
                }
                elseif(in_array($field,$this->model->getPasswords())){
                    if($request->get($field)!='' && $request->has($field)) $this->model->$field = Hash::make($request->get($field));
                }elseif (in_array($field,array_keys($this->model->getSelectsMultiple()))){
                    $str='';
                    if($request->has($field)){
                        foreach ($request->get($field) as $data){
                            $str.='~'.$data;
                        }
                        $this->model->$field = $str;
                    }
                } elseif (in_array($field,$this->model->getDates())){
                    if($request->has($field) && !empty($request->get($field))){
                        $this->model->$field =  date('Y-m-d',strtotime(str_replace('/','-',$request->get($field))));
                    }
                }  elseif (in_array($field,$this->model->getDatetimes())){
                    if($request->has($field) && !empty($request->get($field) )){
                        $this->model->$field =  date('Y-m-d H:i:s',strtotime(str_replace('/','-',$request->get($field))));
                    }
                } else{
                    if($request->has($field))
                        $this->model->$field = $request->get($field);
                    else
                        $this->model->$field = null;
                }

            }
            next($fields);
        }

        foreach ($belongsTos as $belongsTo=>$references){
            if(!in_array($belongsTo,$this->model->getFieldsHiddens()) && in_array($belongsTo, array_keys($fields))){
                $fkKey = $references[1];
                $this->model->$fkKey = $request->get($fkKey);
            }
        }


        if($this->model->save()){

            foreach ($belongsToManys as $belongsToMany=>$references){
                if(!in_array($belongsToMany,$this->model->getFieldsHiddens()) && in_array($belongsToMany, array_keys($fields))){
                    $fkRelationShip = $references[1];
                    $this->model->$fkRelationShip()->detach();
                    if(!empty($request->get($fkRelationShip))){
                        foreach ($request->get($fkRelationShip) as $value){
                            $this->model->$fkRelationShip()->attach($value);
                        }
                    }
                }
            }

            if($request->has('redirectTo')){
                return redirect($request->get('redirectTo'))->with('success','Operation performed successfully');
            }
            if(!empty($this->model->getFormRedirect())){
                return redirect($this->model->getFormRedirect())->with('success','Operation performed successfully');
            }
            return redirect()->back()->with('success','Operation performed successfully');
        }
        else return redirect()->back()->with('error',"Error during operation")->withInput();
    }

    public function delete(Request $request, $parent_id=null,$_id=null){
        if($_id==null) $_id = $parent_id;
        $model_class = get_class($this->model);
        $data = $model_class::find($_id);
        if($data!=null)
            $data->delete();
        return 1;
    }

    public function setNull(Request $request){
        $model_class = get_class($this->model);
        $data = $model_class::find($request->get('data_id'));
        $column =  $request->get('data_column');
        if($data!=null){
            $data->$column = null;
            $data->save();
        }
        return 1;
    }

    public function edit(Request $request, $parent_id=null,$_id=null){
        if($_id==null)  $_id = $parent_id;
        $primaryKey = $this->model->getPrimaryKey();
        $object=DB::table($this->model->getTable())->where($primaryKey, '=', $_id)->first();
        return response()->json([
            'model'=>$object
        ],200);
    }

    public function dataList(Request $request, $wheres=null,$orderBys=null, $whereIns = null){
        $model_class = get_class($this->model);
        $fields = $this->model->getFields();

        $list = $model_class::select('*');
        if($wheres!=null){
            foreach ($wheres as $where){
                $list = $list->where($where[0],$where[1],$where[2]);
            }
        }

        if($whereIns!=null){
            foreach ($whereIns as $whereIn){
                $list = $list->whereIn($whereIn[0],$whereIn[1]);
            }
        }

        $totalRecords = $list->count();

        $search_array = $request->get('search');
        if(!empty($search_array) && !empty($search_array['value'])){
            $search = $search_array['value'];
            $list = $list->where(function ($query) use ($search, $fields) {
                $first_column = true;
                foreach ($fields as $column=>$value){
                    if(
                        !in_array($column,array_keys($this->model->getBelongsTo()))
                        && !in_array($column,array_keys($this->model->getBelongsToMany()))
                        && !in_array($column,$this->model->getUnexceptFiledsSearch())
                    ){
                        if($first_column) {
                            $query->where($column,'like', '%'.$search.'%');
                            $first_column = false;
                        }else{
                            $query->orWhere($column,'like', '%'.$search.'%');
                        }
                    }
                }
            });
        }

        if(!empty($request->get('start'))){
            $list = $list->skip($request->get('start'));
        }

        if(!empty($request->get('length'))){
            $list = $list->take($request->get('length'));
        }

        foreach ($this->model->getOrderBys() as $column=>$order){
            $list = $list->orderBy($column, $order);
        }

        if($orderBys!=null){
            foreach ($orderBys as $orderBy){
                $list = $list->orderBy($orderBy[0],$orderBy[1]);
            }
        }

        $list = $list->get();

        $data = [];
        foreach ($list as $item){
            $line = [];
            foreach ($fields as $column=>$value){
                if(!in_array($column,$this->model->getColumnsHiddens())){
                    if(array_key_exists($column,$this->model->getCustomColumns())){
                        $customFunc = $this->model->getCustomColumns()[$column];
                        $line[] = $item->$customFunc();
                    }
                    elseif(in_array($column,$this->model->getNumbers())){
                        if($item->$column!=null){
                            $line[] = '<div style="width: 100%; text-align: right">'. number_format($item->$column,0,'',' ').'</div>';
                        }else{
                            $line[] = '';
                        }
                    }
                    elseif(in_array($column,$this->model->getDates())){
                        $line[] = $item->$column!=null? date('d-m-Y', strtotime($item->$column)) : '';
                    }
                    elseif(in_array($column,$this->model->getDatetimes())){
                        $line[] = $item->$column!=null? date('d-m-Y H:i', strtotime($item->$column)) : '';
                    }
                    elseif(in_array($column,$this->model->getColors())){
                        $line[] = '<span style="background-color: '.$item->$column.'; padding: 2px 20px; "></span>';
                    }
                    elseif (in_array($column,$this->model->getImages())){
                        if(!empty($item->$column))
                            $line[] = '<a href="'.url($item->$column).'" target="_blank"><img src="'.url($item->$column).'" style="width: 50px;" alt=""></a>';
                        else $line[]='';
                    }
                    elseif (in_array($column,$this->model->getFiles())){
                        $line[] = ' <a href="'.url($item->$column).'" target="_blank"><i class="fa fa-download"></i></a>';
                    }
                    elseif (in_array($column,array_keys($this->model->getBelongsTo()))){
                        $refrences = $this->model->getBelongsTo()[$column];
                        $label = $refrences[2];
                        if($item->$column!=null){
                            $line[] = $item->$column->$label;
                        }else{
                            $line[] = $item->$column;
                        }
                    }else{
                        $val = $item->$column;
                        $line[] = $val.'';
                    }
                }
            }

            if(count($this->model->getActions())!=0 || count($this->model->getCustomBouttons())!=0){
                $is_modal = empty($this->model->getViewForm());
                $current_path = $request->get('current_path');
                $primaryKey = $this->model->getPrimaryKey();

                $actionBtns = '';
                $actions = '';
                //$actions = '<button data-toggle="dropdown" class="btn btn-secondary btn-sm btn-block" type="button">Options <i class="icon ion-ios-arrow-down tx-11"></i></button><div class="dropdown-menu">';
                foreach($this->model->getCustomBouttons() as $btn){
                    $actions.= $item->$btn();
                }
                if(in_array('edit',$this->model->getActions())){
                    $class_btn_edit = $is_modal? 'btn-edit-record' : '';
                    $actions.='<a href="'.url($current_path.'/edit/'.$item->$primaryKey).'" class="dropdown-item '.$class_btn_edit.' text-primary">Edit</a>';
                }
                if(in_array('delete',$this->model->getActions())){
                    $actions.='<a href-redirect="'.$current_path.'" href="'.url($current_path.'/delete/'.$item->$primaryKey).'" class="dropdown-item btn-remove-record text-danger">Delete</a>';
                }
                $actionBtns.=$actions;

                $line [] = $actionBtns;
            }else{
                $line [] = '';
            }

            $data[] = $line;
        }


        return response()->json([
            'data'=>$data,
            'draw'=> $request->get('draw'),
            'recordsTotal'=> $totalRecords,
            'recordsFiltered'=> $totalRecords,
        ]);
    }

}
