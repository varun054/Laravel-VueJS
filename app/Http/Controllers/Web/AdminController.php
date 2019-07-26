<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Employer;

class AdminController extends Controller
{

    public function test($id) {
        $employer = Employer::with('user')->where('user_id', $id)->firstOrFail();

        return view('web.admin.employerdetail', compact('employer'));
    }
}
