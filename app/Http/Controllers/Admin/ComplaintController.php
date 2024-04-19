<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    function index()
    {
        $complaints = Complaint::all();
        $complaints = ComplaintResource::collection($complaints)->resolve();
        return inertia("Admin/Complaint/Index", compact("complaints"));
    }
}
