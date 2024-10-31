<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        try {
            //obter el usuario actual logeado
            $user = Auth::user();
            $taskUser = TaskUser::with(['task.statu'])
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->paginate(10);

            $tasks = Task::orderBy('id', 'desc')->paginate(10);

            return view('task.admin', with([
                'taskUser' => $taskUser,
                'tasks' => $tasks,
            ]));

        } catch (\Throwable $th) {
            return view('task.admin', with(['message' => $th->getMessage()]));
        }
    }

    public function create()
    {

        $status = Status::whereIn('id', [1, 2, 3])->get();

        return view('task.create', with([
            'status' => $status,
        ]));
    }

    public function show($id)
    {

        $task = Task::findOrFail($id);

        return view('task.view', with([
            'task' => $task,
        ]));
    }

    public function update($id)
    {

        //listar usuarios con roles Usuario
        $adminRole = Role::findByName('admin');
        $nonAdminUsers = User::whereNotIn('id', $adminRole->users->pluck('id'))->get();

        $task = Task::findOrFail($id);
        $status = Status::whereIn('id', [1, 3, 4, 5])->get();

        return view('task.update', with([
            'task' => $task,
            'status' => $status,
            'nonAdminUsers' => $nonAdminUsers,
        ]));
    }

    public function updateStore(Request $request, $id)
    {

        try {
            $this->validate($request, [
                'title' => 'required|max:100',
                'description' => 'required|max:255',
                'expiration_date' => 'required|date',
                'status' => 'required|in:1,2,3,4,5,6',
                'credit_for_task' => 'integer',
                'nonAdminUsers' => 'integer',
                'credit_paid' => 'in:0,1',
            ]);

            //si encuentra la tarea la actualiza
            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->statu_id = $request->status;
            $task->credit_for_task = isset($request->credit_for_task) ? $request->credit_for_task : $task->credit_for_task;
            $task->credit_paid = isset($request->credit_paid) ? $request->credit_paid : $task->credit_paid;
            $task->expiration_date = $request->expiration_date;
            $task->save();

            if ($request->nonAdminUsers != 0) {
                $TaskUser = TaskUser::where('task_id', $task->id)->where('user_id', $request->nonAdminUsers)->first();
                if ($TaskUser) {
                    $TaskUser->task_id = $task->id;
                    $TaskUser->user_id = $request->nonAdminUsers;
                    $TaskUser->credit = $request->credit_for_task;
                    $TaskUser->save();
                } else {
                    $TaskUser = new TaskUser;
                    $TaskUser->task_id = $task->id;
                    $TaskUser->user_id = $request->nonAdminUsers;
                    $TaskUser->credit = $request->credit_for_task;
                    $TaskUser->save();
                    $this->sendemail($task->id, $request);
                }
                if ($request->status == 5) {
                    if ($TaskUser->credit == 0) {
                        $TaskUser->credit = $TaskUser->credit + $task->credit_for_task;
                        $TaskUser->save();
                    }
                } else {
                    if ($TaskUser->credit != 0) {
                        $TaskUser->credit = $TaskUser->credit - $task->credit_for_task;
                        $TaskUser->save();
                    }
                }
            }

            if ($request->nonAdminUsers == null) {
                $TaskUser = TaskUser::where('task_id', $task->id)->where('user_id', Auth::user()->id)->first();
                if ($request->status == 5) {
                    if ($TaskUser->credit == 0) {
                        $TaskUser->credit = $TaskUser->credit + $task->credit_for_task;
                        $TaskUser->save();
                    }
                } else {
                    if ($TaskUser->credit != 0) {
                        $TaskUser->credit = $TaskUser->credit - $task->credit_for_task;
                        $TaskUser->save();
                    }
                }
            }

            return redirect()->route('task.update', $id)->with('success', 'Task Updated Successfully');
        } catch (\Exception $th) {
            return redirect()->route('task.update', $id)->with('error', 'Task Update Failed: '.$th->getMessage());
        }

    }

    public function store(Request $request)
    {
        try {
            //iniciamos la transaccion en caso que falle algo se hace un rollback
            DB::beginTransaction();
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'credit_for_task' => 'required',
                'expiration_date' => 'required',
            ]);
            $user = auth()->user();
            $task = new Task;
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

    public function sendemail(int $id, Request $request)
    {
        $data = TaskUser::with('user', 'task')->where('user_id', $request->nonAdminUsers)->where('task_id', $id)->first();
        if ($data) {
            Mail::to($data->user->email)->send(new Notification($data));
        }
    }
}
