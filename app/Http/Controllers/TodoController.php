<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
   public function index()
   {
      // Ambil data terbaru dari tabel TODO
      $todos = Todo::latest()->paginate(10);

      // Kembalikan index dengan variabel data todos
      return view('todos.index', compact('todos'));
   }

   public function create()
   {
      // Kembali ke view folder todos file create
      return view('todos.create');
   }

   public function store(Request $request)
   {
      //validate form
      $request->validate([
         'title' => 'required|min:5',
         'description'   => 'required|min:10',
         'status'         => 'required',
      ]);


      //create Todo
      Todo::create([
         'title'         => $request->title,
         'description'   => $request->description,
         'status'         => $request->status,
      ]);

      // kembali ke index
      return redirect()->route('todos.index')->with(['success' => 'Data Berhasil Disimpan!']);
   }

   public function edit(string $id)
   {
      //Ambil todo berdasarkan ID
      $todo = Todo::findOrFail($id);

      //kembali ke view edit
      return view('todos.edit', compact('todo'));
   }

   public function update(Request $request, $id)
   {
      //validate form
      $request->validate([
         'title'         => 'required|min:5',
         'description'   => 'required|min:10',
         'status'         => 'required',
      ]);

      //get todo berdasarkan ID
      $todo = Todo::findOrFail($id);

      // update todo
      $todo->update([
         'title'         => $request->title,
         'description'   => $request->description,
         'status'         => $request->status
      ]);

      //kembali ke index
      return redirect()->route('todos.index')->with(['success' => 'Data Berhasil Diubah!']);
   }

   public function destroy($id)
   {
      //get todo berdasarkan ID
      $todo = Todo::findOrFail($id);

      //delete todo
      $todo->delete();

      //kembali ke index
      return redirect()->route('todos.index')->with(['success' => 'Data Berhasil Dihapus!']);
   }
}
