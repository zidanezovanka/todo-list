@extends('layouts.main')


@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card border-0 shadow-sm rounded">
         <div class="card-body">
            <form action="{{ route('todos.store') }}" method="post">
               @csrf

               <div class="form-group mb-3">
                  <label class="font-weight-bold">TITLE</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Product">

                  <!-- error message untuk title -->
                  @error('title')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
                  @enderror
               </div>

               <div class="form-group mb-3">
                  <label class="font-weight-bold">DESCRIPTION</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Description Product">{{ old('description') }}</textarea>

                  <!-- error message untuk description -->
                  @error('description')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
                  @enderror
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label class="font-weight-bold">STATUS</label>
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="0" id="status-false" name="status">
                           <label class="form-check-label" for="status-false">
                              Belum
                           </label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="1" id="status-true" name="status"
                              {{ old('status') ? 'checked="checked"' : '' }}>
                           <label class="form-check-label" for="status-true">
                              Selesai
                           </label>
                        </div>

                        <!-- error message untuk status -->
                        @error('status')
                        <div class="alert alert-danger mt-2">
                           {{ $message }}
                        </div>
                        @enderror
                     </div>
                  </div>
               </div>

               <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
               <button type="reset" class="btn btn-md btn-warning">RESET</button>
         </div>
         </form>
      </div>
   </div>
</div>
</div>

@endsection