<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::all('id', 'name');
        return view('admin.masterproject', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function add($id)
    {
        $siswa = Siswa::find($id);
        return view('admin.tambahproject', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'project_name' => 'required|min:5',
            'project_date' => 'required',
            'photo' => 'required|image',
        ]);

        $image = $request->file('photo')->store('photo', 'public');
        $siswaid = $request->input('siswa_id');

        Project::create([
            'siswa_id' => $siswaid,
            'project_name' => $request->project_name,
            'project_date' => $request->project_date,
            'photo' => $image,
        ]);

        return redirect()->route('resource.index')->with('message', 'project berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswas = Siswa::find($id)->projects()->get();
        return view('admin.showproject', compact('siswas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('admin.editproject', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $project = Project::find($id);
        $request->validate([
            'project_name' => 'required|min:5',
            'project_date' => 'required',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            if ($project->photo) {
                Storage::disk('public')->delete($project->photo);
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->nama . '_' . uniqid() . '.' . $extension;

            $image = $file->storeAs('photo', $fileName, 'public');

            $project->update([
                'siswa_id' => $request->siswa_id,
                'project_name' => $request->project_name,
                'project_date' => $request->project_date,
                'photo' => $image,
            ]);
        } else {
            $project->update([
                'siswa_id' => $request->siswa_id,
                'project_name' => $request->project_name,
                'project_date' => $request->project_date,
            ]);
        }

        // Redirect back or to any other page as needed
        return redirect()->route('resource.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $project = Project::find($id);

        // if (!$project) {
        //     return redirect()->route('resource.index')->with('error', 'Project tidak ditemukan');
        // }

        // // Hapus foto dari sistem penyimpanan sebelum menghapus data dari database
        // if ($project->photo) {
        //     Storage::delete('public/' . $project->photo);
        // }

        // $project->delete();

        // return redirect()->route('resource.index')->with('message', 'Project berhasil dihapus');
    }

    public function delete($id)
    {
        Project::destroy($id);
        return redirect()->route('resource.index')->with('message', 'Data berhasil dihapus');
    }
}
