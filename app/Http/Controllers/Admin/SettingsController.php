<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::with('user')
            ->latest()
            ->take(20)
            ->get();

        return view('admin.settings', compact('activityLogs'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($request->only('name', 'email'));
        ActivityLog::log('update_profile', 'Admin memperbarui profil');

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        ActivityLog::log('update_password', 'Admin memperbarui password');

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function clearLogs()
    {
        ActivityLog::truncate();
        ActivityLog::log('clear_logs', 'Admin menghapus semua activity logs');

        return back()->with('success', 'Activity logs berhasil dihapus!');
    }
}
