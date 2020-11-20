<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }


    public function index(Request $request)
    {
        /* if ($request->search) {dd($request->all());} */

        /* method 1 for search */
        /* if ($request->search) {
             $users = User::where('first_name', 'like', '%' . $request->search . '%')
                 ->orwhere('last_name', 'like', '%' . $request->search . '%')
                 ->whereRoleIs('admin')
                 ->get();
         } else {
             $users = User::whereRoleIs('admin')->get();
         }
         return view('dashboard.users.index', compact('users'));
         */

        /* method 2 for search */
        $users = User::whereRoleIs('admin')->when($request->search, function ($query) use ($request) {

            return $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orwhere('last_name', 'like', '%' . $request->search . '%')
                ->whereRoleIs('admin');

        })->latest()->paginate(5);

        return view('dashboard.users.index', compact('users'));

    }/* end of index */

    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {
        /* dd($request->all()); */

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $request_data = $request->except('password', 'password_confirmation', 'permissions', 'image');

        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $user = User::create($request_data);

        $user->attachRole('admin');

        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');

    }/* end of store */


    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $request_data = $request->except('permissions');

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.users.index');

    }


    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');


    }/* end of destroy */
}//end of Controller
