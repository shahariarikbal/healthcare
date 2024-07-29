@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                         <h4 class="hc-header-title">
                            Department Add
                         </h4>
                         <a href="{{ route('department.manage') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('department.store') }}" method="post">
                              @csrf
                              <div class="input-group mb-3">
                                   <input type="text" class="form-control" name="name[]" value="{{ old('name.0') }}" placeholder="Enter departname name..."/>
                                   <span class="input-group-text append-btn" id="addDepartment" onclick="addNewField()" title="Add more">Add</span>
                              </div>
                              <span class="text-danger">{{ $errors->has('name.0') ? $errors->first('name.0') : ' ' }}</span>
                                <div id="addNewInputField"></div>
                                
                                   @for ($i = 1; $i < count(old('name', [])); $i++)
                                        <div class="input-group mb-3">
                                             <input type="text" class="form-control" name="name[]" value="{{ old('name.'.$i) }}" placeholder="Enter departname name..."/>
                                             <span class="input-group-text danger-btn" title="Remove" onclick="removeField(this)"><i class="fa-solid fa-circle-minus"></i></span>
                                        </div>
                                        <span class="text-danger">{{ $errors->has('name.'.$i) ? $errors->first('name.'.$i) : ' ' }}</span>
                                   @endfor
                              <button type="submit" class="btn btn-submit">Submit</button>
                         </form>
                    </div>
               </div>
          </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
               document.getElementById('addNewInputField').addEventListener('click', function(event) {
               
                    if (event.target && event.target.matches('.danger-btn')) {
                         
                         let inputGroup = event.target.closest('.input-group');
                         
                         inputGroup.remove();
                    }
               });
          });

          function addNewField() {
          let container = document.getElementById('addNewInputField');
          let newFieldId = 'inputField_' + Date.now();
          let newFields = document.createElement('div');
          newFields.innerHTML = `
               <div class="input-group mb-3">
                    <input type="text" id="${newFieldId}" class="form-control" name="name[]" placeholder="Enter departname name...">
                    <span class="input-group-text danger-btn" title="Remove" data-target="${newFieldId}"><i class="fa-solid fa-circle-minus"></i></span>
               </div>
          `;
               container.appendChild(newFields);
          }

    </script>
@endpush