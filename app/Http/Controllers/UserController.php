<?php

namespace App\Http\Controllers;

use App\Models\TaskUser;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Helpers\Helpers;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('user.admin', with([
            'users' => $users,
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
            'tasks' => $tasks,
        ]));
    }

    public function create()
    {

        $roles = Role::all();
        $types = Type::all();

        return view('user.create', with([
            'roles' => $roles,
            'types' => $types,
        ]));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validate($request, [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'required|min:8|max:16',
                'roles' => 'required',
                'type' => 'required|exists:types,id',
            ]);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->type_id = $request->type;
            $user->save();
            $user->assignRole($request->roles);

            DB::commit();

            return redirect()->route('admin')->with('success', 'User Created Successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin')->with('error', 'User Creation Failed: '.$th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        return view('user.changePassword');
    }

    public function changePasswordStore(Request $request)
    {

        try {

            $this->validate($request, [
                'password' => 'required|min:8',
                'confirmPassword' => 'required|min:8|same:password',
            ]);

            $user = Auth::user();
            $model = User::find($user->id);
            $model->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('changePassword')->with('success', 'Password Changed Successfully');
        } catch (\Exception $th) {
            return redirect()->route('changePassword')->with('error', 'Password Change Failed: '.$th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all();
        $types = Type::all();

        return view('user.update', with([
            'user' => $user,
            'roles' => $roles,
            'types' => $types,
        ]));
    }

    public function updatestore(Request $request)
    {

        try {
            $this->validate($request, [
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'roles' => 'required',
                'type' => 'required|exists:types,id',
            ]);
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'type_id' => $request->type,
            ]);
            $user->syncRoles($request->roles);
            if ($request->password) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            return redirect()->route('admin')->with('success', 'User Updated Successfully');
        } catch (\Exception $th) {
            return redirect()->route('admin')->with('error', 'User Update Failed: '.$th->getMessage());
        }
    }

    public function familynucleus(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Type::create([
                'name' => $request->name,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $th) {
            return response()->json(['success' => false]);
        }
    }

    public function transfer($id){

        $user = User::findOrFail($id);
        return view('user.transfer', with([
            'user' => $user,
        ]));
    }

    public function transferstore(Request $request){
        try {
            $request->validate([
                'current_amount_total_credit' => 'required|integer',
            ]);
            $user = User::findOrFail($request->id);
            if($request->current_amount_total_credit < $user->current_amount_total_credit){ 
                $user->update([
                    'current_amount_total_credit' => $user->current_amount_total_credit - $request->current_amount_total_credit,
                ]);
                Helpers::setHistoryCredit($request->id, 5, 'User Transfer:'.$request->current_amount_total_credit );
            }else{
                return redirect()->route('admin')->with('error', 'User Transfer Failed: ');
            }
                return redirect()->route('admin')->with('success', 'User Transfer Successfully');
        } catch (\Exception $th) {
            return redirect()->route('admin')->with('error', 'User Transfer Failed: '.$th->getMessage());
        }
    }
}
