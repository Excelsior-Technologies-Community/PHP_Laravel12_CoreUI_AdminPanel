<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // ✅ LIST + SEARCH
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // ✅ DELETE (Soft Delete)
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User moved to trash');
    }

    // ✅ TRASH LIST
    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('users'));
    }

    // ✅ RESTORE
    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'User restored successfully');
    }

    // ✅ TOGGLE STATUS
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return back()->with('success', 'Status updated');
    }
}