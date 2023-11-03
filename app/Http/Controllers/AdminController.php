<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }

    public function dashboard()
    {
        return View('admin.dashboard');
    }

    public function editkontak()
    {
        return View('admin.editkontak');
    }

    public function editproject()
    {
        return View('admin.editproject');
    }
    public function editsiswa()
    {
        return View('admin.editsiswa');
    }
    public function masterkontak()
    {
        return View('admin.masterkontak');
    }
    public function masterproject()
    {
        return View('admin.masterproject');
    }

}


