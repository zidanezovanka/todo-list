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
                  <td class="text-center checkbox-row">
                     <div class="form-check">
                        <input class="form-check-input status-checkbox" type="checkbox" value="0" data-id="{{ $todo->id }}" id="status-false-{{ $todo->id }}" name="status"
                           {{ $todo->status ? '' : 'checked="checked"' }}>
                        <label class="form-check-label" for="status-false-{{ $todo->id }}">
                           Belum
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input status-checkbox" type="checkbox" value="1"
                           data-id="{{ $todo->id }}" id="status-true-{{ $todo->id }}" name="status"
                           {{ $todo->status ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="status-true-{{ $todo->id }}">
                           Selesai
                        </label>
                     </div>
                  </td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   $(document).ready(function() {
      $('.status-checkbox').on('change', function() {
         let current = $(this);
         let parent = current.closest('.checkbox-row');
         let id = current.data('id');
         let value = current.val();

         parent.find('.status-checkbox').not(current).prop('checked', false);

         $.ajax({
            url: '{{ route("todos.updateStatus") }}',
            method: 'POST',
            data: {
               _token: $('meta[name="csrf-token"]').attr('content'),
               id: id,
               status: value
            },
            success: function(response) {
               console.log('Status updated:', response.message);
            },
            error: function() {
               alert('Gagal update status.');
            }
         });
      });
   });
</script>

@endsection