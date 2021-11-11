@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12 margin-tb">

          @if ($type == 'company')

          <div class="company">
            <div class="pull-left">
              <h2>Companies</h2>
              <hr>
            </div>
            <div class="pull-right">
              @if (Auth::user()->user_type == 'admin')
                <a href="{{ route('company.create') }}" class="btn btn-success">Create New</a>
              @endif
              <a href="{{ route('employee.index') }}" class="btn btn-warning">Look at Employees</a>
            </div>
            <hr>
            @if ($msg = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $msg }}</p>
                </div>
            @endif
  
            <table class="table table-bordered mt-4">
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Employee</th>
                @if (Auth::user()->user_type == 'admin')
                  <th colspan="2">Action</th>
                @endif
              </tr>
            @foreach ($companies as $company)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>
                  <img src="{{ $company->logo }}" alt="{{ $company->name }}" style="height: 100px; width: 100px">
                </td>
                <td>{{ $company->website }}</td>
                <td>
                  <ul style="list-style-type: circle">
                    @foreach ($company->employee as $employee)
                        <li>{{ $employee->fName . " " . $employee->lName }}</li>
                    @endforeach
                  </ul>
                </td>
                @if (Auth::user()->user_type == 'admin')
                  <td>
                    <form action="{{ route('company.destroy', $company->id) }}" method="post">
                      <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                @endif
              </tr>
            @endforeach
            </table>
            {!! $companies->links() !!}
          </div>

          @elseif ($type == 'employee')

          <div class="employee">
            <div class="pull-left">
              <h2>Employees</h2>
              <hr>
            </div>
            <div class="pull-right">
              @if (Auth::user()->user_type == 'admin')
                <a href="{{ route('employee.create') }}" class="btn btn-success">Create New</a>
              @endif
              <a href="{{ route('company.index') }}" class="btn btn-warning">Look at Company</a>
            </div>
            <hr>
            @if ($msg = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $msg }}</p>
                </div>
            @endif
  
            <table class="table table-bordered mt-4">
              <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                @if (Auth::user()->user_type == 'admin')
                  <th colspan="2">Action</th>
                @endif
              </tr>
            @foreach ($employees as $employee)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee->fName }}</td>
                <td>{{ $employee->lName }}</td>
               {{-- <div class="myCompany" style="display: none">
                   {{ $company = App\Models\Company::where('id', $employee->company)->get() }}
                </div>
                @foreach ($company as $item)
                <td>{{ $item->name }}</td>
                @endforeach --}}
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                @if (Auth::user()->user_type == 'admin')
                  <td>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="post">
                      <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                @endif
              </tr>
            @endforeach
            </table>
            {!! $employees->links() !!}
          </div>

          @endif

        </div>
      </div>
    </div>
@endsection