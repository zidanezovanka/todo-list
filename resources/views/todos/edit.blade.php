@extends('layouts.main')

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card border-0 shadow-sm rounded">
         <div class="card-body">
            <form action="{{ route('todos.update', $todo->id) }}" method="POST">
               @csrf
               @method('PUT')

               <div class="form-group mb-3">
                  <label class="font-weight-bold">TITLE</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $todo->title) }}" placeholder="Masukkan Judul Product">

                  <!-- error message untuk title -->
                  @error('title')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
                  @enderror
               </div>

               <div class="form-group mb-3">
                  <label class="font-weight-bold">DESCRIPTION</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Description Product">{{ old('description', $todo->description) }}</textarea>

                  <!-- error message untuk description -->
                  @error('description')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
                  @enderror
               </div>

               <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
               <a href="{{ route('todos.index') }}" class="btn btn-md btn-danger">BACK</a>

            </form>
         </div>
      </div>
   </div>
</div>

@endsection