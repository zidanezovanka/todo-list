@extends('layouts.main')


@section('content')



<div class="row">
   <div class="col-md-12">
      <h3 class="text-center my-4">TO DO LIST</h3>
      <hr>
   </div>
   <div class="card border-0 shadow-sm rounded">
      <div class="card-body">
         @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif


         <a href="{{ route('todos.create') }}" class="btn btn-md btn-success mb-3">ADD TODO</a>
         <table class="table table-bordered">
            <thead>
               <tr class="text-center">
                  <th scope="col">TITLE</th>
                  <th scope="col">DESCRIPTION</th>
                  <th scope="col">STATUS</th>
                  <th scope="col" style="width: 20%">ACTIONS</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($todos as $todo)
               <tr class="align-middle">
                  <td>{{ $todo->title }}</td>
                  <td>{{ $todo->description }}</td>
                  <td class="text-center">{{ $todo->status ? 'selesai' : 'belum' }}</td>
                  <td class="text-center">
                     <form onsubmit="return confirm('Apakah Anda Yakin ?')" action="{{ route('todos.destroy', $todo->id) }}" method="post">
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                     </form>
                  </td>
               </tr>
               @empty
               <div class="alert alert-danger">
                  Data Todo belum ada.
               </div>
               <tr>
                  <td colspan="5" class="text-center">Data Not Found.</td>
               </tr>
               @endforelse
            </tbody>
         </table>
         {{ $todos->links() }}
      </div>
   </div>
</div>

@endsection