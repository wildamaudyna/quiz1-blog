<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Photos::all();
        return view('photos.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'date' => 'bail|required|unique:tb_photos',
                'title' => 'required',
                'text' => 'required'
            ],
            [
                'date.required' => 'Tanggal wajib diisi',
                'title.required' => 'Judul wajib diisi',
                'text.unique' => 'Isi text apa saja'
            ]
        );
            
        Photos::create([
            
            'date' => $request->date,
            'title' => $request->title,
            'text' => $request->text
        ]);
        
        return redirect('/photos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Photos::findOrFail($id); 
        return view('photos.edit', compact('row'));
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
        $request->validate(
            [
                'date' => 'required',
                'title' => 'required',
                'text' => 'required'
            ],
            [
                'date.required' => 'Tanggal wajib diisi',
                'title.required' => 'Judul wajib diisi',
                'text.required' => 'Isi Text apa saja'
            ]
        );
            
        $row = Photos::findOrFail($id);
        $row->update([
            'date' => $request->date,
            'title' => $request->title,
            'text' => $request->text
            ]); 

            return redirect('/photos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Photos::findOrFail($id);
        $row->delete();

        return redirect('/photos');
    }
}
