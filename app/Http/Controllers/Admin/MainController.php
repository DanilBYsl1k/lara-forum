<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Branch;
use App\Models\Messages;
use App\Models\Theme;
use App\Models\User;

class MainController extends Controller
{
    function index()
    {
        $stats = [
            [
                "title" => "branches",
                "count" => Branch::count()
            ],
            [
                "title" => "themes",
                "count" => Theme::count()
            ],
            [
                "title" => "Messages",
                "count" => Messages::count(),
            ],
            [
                "title" => "users",
                "count" => User::count()
            ],
        ];

        return inertia('Admin/Main/Index', compact('stats'));
    }
}
