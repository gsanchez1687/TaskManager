<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){

        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('user.admin', with([
            'users' => $users
        ]));
    }

    public function profile()
    {
        $auth = Auth::user();
        $user = User::find($auth->id);
        $credit = TaskUser::where('user_id', $auth->id)->sum('credit');

        $tasks = TaskUser::with(['task.statu'])
        ->join('tasks', 'tasks_users.task_id', '=', 'tasks.id')
        ->where('tasks.statu_id', 5)
        ->where('user_id', $auth->id)
        ->get();

        return view('user.profile', with([
            'user' => $user,
            'credit' => $credit,
            'tasks' => $tasks
        ]));
    }

    public function changePassword(Request $request)
    {
       return view('user.changePassword');
    }

    public function changePasswordStore(Request $request){

        try {

            $this->validate($request, [
                'password' => 'required|min:8',
                'confirmPassword' => 'required|min:8|same:password'
            ]);

            $user = Auth::user();
            $model = User::find($user->id);
            $model->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('changePassword')->with('success', 'Password Changed Successfully');
        } catch (\Exception $th) {
            return redirect()->route('changePassword')->with('error', 'Password Change Failed: '.$th->getMessage());
        }
    }

    public function update(Request $request, $id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        //model_has_roles
        
        return view('user.update',with([
            'user' => $user,
            'roles' => $roles
        ]));
    }

    public function updatestore(Request $request){

        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
            ]);
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if($request->password){
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            return redirect()->route('admin')->with('success', 'User Updated Successfully');
        } catch (\Exception $th) {
            return redirect()->route('admin')->with('error', 'User Update Failed: '.$th->getMessage());
        }
    }
}
