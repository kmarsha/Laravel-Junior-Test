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

            <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="text" class="form-control mb-4" name="name" id="name" placeholder="Name">
              <input type="email" class="form-control mb-4" name="email" id="email" placeholder="Email">
              <input type="file" class="form-control mb-4" name="logo" id="logo" accept="image/*" placeholder="logo">
              @error('logo')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <input type="text" class="form-control mb-4" name="website" id="web" placeholder="Website">

              <a href="{{ route('company.index') }}" class="btn btn-primary">Back</a>
              <button type="submit" class="btn btn-success">Save</button>
            </form>

          @elseif ($type == 'employee')

            <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="col-6">
                <div class="input-group mb-4">
                  <input type="text" name="fname" id="fname" aria-label="First Name" class="form-control" placeholder="First Name">
                  <input type="text" name="lname" id="lname" aria-label="Last Name" class="form-control" placeholder="Last Name">
                </div>
                <div class="mb-4">
                  <select class="form-control" name="company_id" id="company_id" aria-placeholder="Company">
                    <option value="" disabled>Select Company</option>
                    @foreach ($companies as $company)
                      <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                  </select>
                </div>
                <input type="email" name="email" id="email" class="form-control mb-4" placeholder="Email (example@gmail.com)">

                <input type="tel" name="phone" id="phone" class="form-control mb-4" placeholder="+628123456789">

                <a href="{{ route('employee.index') }}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>

          @endif

        </div>
      </div>
    </div>
@endsection