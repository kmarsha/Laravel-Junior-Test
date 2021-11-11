@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          @if ($message = Session::get('error'))
            <div class="alert alert-danger">
              <p>{{ $message }}</p>
            </div>
          @endif

          @if ($type == 'company')

            <form action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <input type="text" class="form-control mb-4" name="name" id="name" placeholder="Name" value="{{ $company->name }}" required>
              <input type="email" class="form-control mb-4" name="email" id="email" placeholder="Email" value="{{ $company->email }}" required>
              <input type="file" class="form-control mb-4" name="logo" id="logo" accept="image/*" placeholder="logo">
              @error('logo')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <input type="text" class="form-control mb-4" name="website" id="web" placeholder="Website" value="{{ $company->website }}" required>

              <a href="{{ route('company.index') }}" class="btn btn-primary">Back</a>
              <button type="submit" class="btn btn-success">Update</button>
            </form>

          @elseif ($type == 'employee')

            <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="col-6">
                <div class="input-group mb-4">
                  <input type="text" name="fname" id="fname" class="form-control" value="{{ $employee->fName }}" placeholder="First Name" required>
                  <input type="text" name="lname" id="lname" class="form-control" value="{{ $employee->lName }}" placeholder="Last Name" required>
                </div>
                <div class="mb-4">
                  <select class="form-control" name="company" id="company" required>
                    {{-- {{ $comp = App\Models\Company::where('id', $employee->company)->get() }}
                      @foreach ($comp as $item)
                        <option value="{{ $employee->company }}" disabled>{{ $item->name }}</option>
                      @endforeach --}}
                      <option value="{{ $employee->company }}">{{ $employee->company->name }}</option>
                    @foreach ($companies as $company)
                      <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                  </select>
                </div>
                <input type="email" name="email" id="email" class="form-control mb-4" value="{{ $employee->email }}" placeholder="Email (example@gmail.com)">

                <input type="tel" name="phone" id="phone" class="form-control mb-4" value="{{ $employee->phone }}" placeholder="+628123456789">

                <a href="{{ route('employee.index') }}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>

          @endif

        </div>
      </div>
    </div>
@endsection