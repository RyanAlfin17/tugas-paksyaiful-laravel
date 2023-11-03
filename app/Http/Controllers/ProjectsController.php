<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return View('projects');
    }
}
