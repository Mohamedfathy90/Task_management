<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\equiStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        $tasks = (Auth::user()->role == 'admin') ? Task::where('execution_dep','aqelect')->orderby('due_date')
        :Task::where('assignment', Auth::user()->name)->orderby('due_date');
        
        if(request()->ajax()) {   
            return datatables()->of($tasks)
           
            ->addColumn('assignment', function($row){
                if(Auth::user()->role == 'admin'){
                    if($row['assignment']=='not assigned') { 
                    $actionBtn = '<a href="/task/assign/'.$row['id'].'" class="btn btn-primary">Assign to Employee</a>';
                    return $actionBtn;  
                    }
                    else{
                    return 'Assigned to :'.$row['assignment'].'' ;
                    }
                 }    
            
                else{ 
                    switch($row['status']){
                    case 'in progress':
                    $GLOBALS['actionBtn'] = '<a href="task/complete/'.$row['id'].'"  class="btn btn-success" >Complete</a>
                    <a href="task/pending/'.$row['id'].'"  class="btn btn-danger" >pending</a>';
                    break;

                    case 'pending':
                    $GLOBALS['actionBtn']= '<a href="task/complete/'.$row['id'].'"  class="btn btn-success" >Complete</a> 
                    <a href="task/progress/'.$row['id'].'"  class="btn btn-warning" >in-progress</a>';
                    break;

                    case 'completed':
                    $GLOBALS['actionBtn'] = '<a href="task/progress/'.$row['id'].'"  class="btn btn-warning" >in-progress</a>
                    <a href="task/pending/'.$row['id'].'"  class="btn btn-danger" >pending</a>';
                    break;
                    }

                    return $GLOBALS['actionBtn']; 
                }
            })

            ->addColumn('status', function($row){
                if($row['status']==='in progress')
                return '<span class="badge badge-warning">in progress</span>';
                if($row['status']==='completed')
                return '<span class="badge badge-success">completed</span>';
                if($row['status']==='pending')
                return '<span class="badge badge-danger">pending</span>';
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') != '') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('site') != '') {
                        $instance->where('site', $request->get('site'));
                    }
                    if ($request->get('type') != '') {
                        $instance->where('job_type', $request->get('type'));
                    }
                    if ($request->get('startdate') != '' && $request->get('enddate') == '' ) {
                        $instance->where( 'due_date' , '>' , $request->get('startdate'));
                    }
                    if ($request->get('enddate') != '' && $request->get('startdate') == '' ) {
                        $instance->where( 'due_date' , '<' , $request->get('enddate'));
                    }
                    if ($request->get('enddate') != '' && $request->get('startdate') != '' ) {
                        $instance->where([
                            ['due_date' , '<=' , $request->get('enddate')] ,
                            ['due_date' , '>=' , $request->get('startdate')] ,
                        ]);
                    }
                })
            
                ->addColumn('transaction_id', function($row){
                        $actionBtn = '<a href="transaction_details/'.$row['transaction_id'].'">'.$row['transaction_id'].'</a>';
                        return $actionBtn;  
                       
                     })

            ->rawColumns(['status','assignment','transaction_id'])
            ->addIndexColumn()
            ->make(true);
            } 
      return view('dashboard');
    }

    public function pending_view(Task $task){
        return view ('pending_task' , ['task'=>$task]);
    }

    public function pending_task(Task $task , Request $request){
        $task->update([
         'status'        =>'pending' , 
         'pending_cause' => $request->cause,
         'work_done' => null ,
        ]);
        return redirect('/dashboard');
     }
    
    public function complete_view(Task $task){
        return view ('complete_task' , ['task'=>$task]);
    }

    public function complete_task(Task $task , Request $request){
       $task->update([
        'status'    =>'completed' , 
        'work_done' => $request->work_done ,
        'pending_cause' => null
       ]);
       return redirect('/dashboard');
    }
    
    public function progress_task(Task $task){
        $task->update([
         'status'        =>'in progress' , 
         'work_done'     => null ,
         'pending_cause' => null ,
        ]);
        return redirect('/dashboard');
     }

    public function assign(Task $task){
        $today=date('Y-m-d');
        $attendees = Schedule::with('user')->where(['date'=>$today,'site'=>$task->site])->get();
        return view('assign_task',['task'=>$task , 'attendees'=>$attendees]);
    }

    public function assign_task(Task $task , Request $request){
        $task->update(['assignment'=>$request->employee]);
        return view('/dashboard');
    }

    public function issued_tasks(Request $request){
        $tasks =Task::where('request_dep','aqelect')->orderby('due_date');
        if(request()->ajax()) {   
            
            return datatables()->of($tasks)

                ->addColumn('status', function($row){
                    if($row['status']==='in progress')
                    return '<span class="badge badge-warning">in progress</span>';
                    if($row['status']==='completed')
                    return '<span class="badge badge-success">completed</span>';
                    if($row['status']==='pending')
                    return '<span class="badge badge-danger">pending</span>';
                    })
                
                ->addColumn('image', function($row){
                    if($row['image']!='')
                    return '<img src="'.$row['image'].'"></$row>' ;
                    else 
                    return '';
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') != '') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('site') != '') {
                        $instance->where('site', $request->get('site'));
                    }
                    if ($request->get('type') != '') {
                        $instance->where('job_type', $request->get('type'));
                    }
                    if ($request->get('startdate') != '' && $request->get('enddate') == '' ) {
                        $instance->where( 'due_date' , '>' , $request->get('startdate'));
                    }
                    if ($request->get('enddate') != '' && $request->get('startdate') == '' ) {
                        $instance->where( 'due_date' , '<' , $request->get('enddate'));
                    }
                    if ($request->get('enddate') != '' && $request->get('startdate') != '' ) {
                        $instance->where([
                            ['due_date' , '<=' , $request->get('enddate')] ,
                            ['due_date' , '>=' , $request->get('startdate')] ,
                        ]);
                    }
                })
            
            ->rawColumns(['status','image'])
            ->addIndexColumn()
            ->make(true);
            } 
      return view('issued_tasks');
    }

    public function add_task(){
        return view('add_task' ,['departments'=>Department::all()]);
    } 

    public function issue_task(Request $request){
        
        $request->validate([
            'tag'            => ['required' , 'exists:equipment,tag'] ,
            'remarks'        => ['required'],
            'execution_dep'  => ['required'],
            'image'          => ['image']
        ]);
        
        if($request->has('image')){
        $image_name = 'img_'.time().'.'.request('image')->getclientoriginalextension();
        request()->file('image')->storeAs('/workorder_images',$image_name);
        $image_location = "/storage/workorder_images/".$image_name ;
        }
        else{
        $image_location='';
        }
        Task::create([
            'site' => $request->site ,
            'execution_dep' => "$request->execution_dep" ,
            'request_dep' => $request->request_dep ,
            'equipment_tag' => $request->tag ,
            'task_desc' => $request->remarks ,
            'image' => $image_location ,
            'status'=>'in progress',
            'job_type' => "CM" ,
            'due_date' => date('Y-m-d') ,
        ]);

        return redirect('/task/issued');
    }

    public function get_task_data(Request $request){
        $data = Equipment::where('site',"$request->location")->where('tag','LIKE',"%{$request->term}%")->pluck('tag');
        return response()->json($data);
    }

    public function get_equip_desc(Request $request){
        $description = Equipment::where('tag',$request->tag)->first()->description;
        return response()->json(['description'=>$description]);
    }

    public function equip_status_index (){
        return view ('equip_status');
    }

    public function get_equip_status(Request $request){   
        $credentials = $request->validate([
            'tag'=> ["required" , "exists:equipment,tag"]
        ],['tag'=>"please enter equipment tag",'tag.exists'=>"Equipment Tag doesn't exist"]);
        
        return redirect('/show_equip_status/'.$request->tag);
    }
        
    
    public function show_equip_status(Equipment $equipment){
        $status_rows = equiStatus::where('equip_tag',$equipment->tag)->orderby('date')->get();
    
        if(request()->ajax()) {   
            return datatables()->of($status_rows)

            ->addColumn('status', function($row){
                if($row['status']==='in service')
                return '<span class="badge badge-success">In Service</span>';
                if($row['status']==='out of service')
                return '<span class="badge badge-danger">Out of Service</span>';
                })
        
            ->rawColumns(['status'])
            ->addIndexColumn()
            ->make(true);
            } 
            return view('show_equipment_status');
         }

    public function show_transaction_details ($transaction_id){
        $transactions = Transaction::where('transaction_id', $transaction_id);
        if(request()->ajax()) {   
            return datatables()->of($transactions)        
            ->addIndexColumn()
            ->make(true);
            } 
            return view('show_transaction_details');
         }
    }
    
    



    
