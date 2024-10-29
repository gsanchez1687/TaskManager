<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMailable;
use App\Mail\Notification;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){
        try {
            //obter el usuario actual logeado
            $user =  Auth::user();
            $taskUser = TaskUser::with(['task.statu'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

            $tasks = Task::orderBy('id', 'desc')->paginate(10);

            return view('task.admin', with([
                'taskUser' => $taskUser,
                'tasks'=>$tasks
            ]));

        } catch (\Throwable $th) {
            return view('task.admin', with(['message' => $th->getMessage()]));
        }
    }

    public function create(){

        $status = Status::whereIn('id', [1,2,3])->get();
        return view('task.create', with([
            'status' => $status
        ]));
    }

    public function show($id){

        $task = Task::findOrFail($id);
        return view('task.view',with([
            'task' => $task
        ]));
    }

    public function update($id){

        //listar usuarios con roles Usuario
        $adminRole = Role::findByName('admin');
        $nonAdminUsers = User::whereNotIn('id', $adminRole->users->pluck('id'))->get();

        $task = Task::findOrFail($id);
        $status = Status::whereIn('id', [1,3,4,5])->get();
        return view('task.update',with([
            'task' => $task,
            'status' => $status,
            'nonAdminUsers'=>$nonAdminUsers
        ]));
    }

    public function updateStatus(Request $request, $id){

        try {
            DB::beginTransaction();

            $this->validate($request, [
                'title' => 'required|min:5',
                'description' => 'required|min:5',
                'credit_for_task' => 'required|numeric',
                'expiration_date' => 'required|date',
                'status' => 'required'
            ]);
            $user = auth()->user();
            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->credit_for_task = $request->credit_for_task;
            $task->expiration_date = $request->expiration_date;
            $task->statu_id = $request->status;
            $task->save();

            if($request->status == 5){
                $TaskUser = TaskUser::where('user_id', $user->id)
                ->where('task_id', $id)
                ->first();
                if($TaskUser && $TaskUser->credit == 0){
                    $TaskUser->credit = $TaskUser->credit + $task->credit_for_task;
                    $TaskUser->save();
                }
            }

            if($request->nonAdminUsers){
                TaskUser::create([
                    'task_id' => $id,
                    'user_id' => $request->nonAdminUsers,
                    'credit'=> 0
                ]);
                //enviar correo de notificacion
                $data = TaskUser::with('user','task')
                ->where('user_id', $request->nonAdminUsers)
                ->where('task_id', $id)
                ->first();
                Mail::to($data->user->email)->send(new Notification($data));
            }

            DB::commit();
            return redirect()->route('update', $id)->with('success', 'Task Updated Successfully');

        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('update', $id)->with('error', 'Task Update Failed: '.$th->getMessage());
        }

    }

    public function store(Request $request){
        try {
            //iniciamos la transaccion en caso que falle algo se hace un rollback
            DB::beginTransaction();
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'credit_for_task' => 'required',
                'expiration_date' => 'required'
            ]);
            $user = auth()->user();
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->statu_id = 1;
            $task->credit_for_task = $request->credit_for_task;
            $task->expiration_date = $request->expiration_date;
            $task->hours_passed = 0;
            $task->save();
            DB::commit();
            return redirect()->route('create')->with('success', 'Task Created Successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('create')->with('error', 'Task Creation Failed');
        }
    }
}