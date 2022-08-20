@extends('components.layouts')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .invalid{
            color: red;
        }
    </style>
</head>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12  col-sm-6 col-md-12">
                <div class='d-flex justify-content-between mt-5 mb-3'>
                    <div class='fs-3'>User Records</div>
                    <div>
                        <!-- <a class="btn btn-success" href="create"> Add New</a> -->
                        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add
                            Employee</a>

                        <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                            aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered" >
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title " id="exampleModalToggleLabel">Add new record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="mod">
                                        <div class="row mt-3 mb-3 d-flex justify-content-center">
                                            <div class="col-lg-11 mt-5 mt-lg-0 d-flex align-items-stretch">

                                                <form action="{{ route('saveEMP') }}" method="post" role="form"
                                                    class="php-email-form" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="mb-3 row">
                                                        <label for="Email" class="col col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{old('email')}}"
                                                                id="email" placeholder="email@example.com">
                                                                @if ($errors->has('email'))
                                                                <span class="invalid feedback text-red-600 " role="alert">
                                                                    <strong>{{ $errors->first('email') }}.</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 mt-3 row">
                                                        <label for="name" class="col  col-form-label">Full Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                                                id="name" placeholder="Enter Your Name" value="{{old('name')}}">
                                                                @if ($errors->has('name'))
                                                                <span class="invalid feedback text-red-600 " role="alert">
                                                                    <strong>{{ $errors->first('name') }}.</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 mt-3 row">
                                                        <label for="date" class="col-sm-4  col-form-label"> Date of
                                                            Joining</label>
                                                        <div class="col-sm-5">
                                                            <input type="date" name="doj" onchange="clicked()" class="form-control {{ $errors->has('doj') ? ' is-invalid' : '' }}"
                                                                id="date" value="{{old('doj')}}">
                                                                @if ($errors->has('doj'))
                                                                <span class="invalid feedback text-red-600 " role="alert">
                                                                    <strong>{{ $errors->first('doj') }}.</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 mt-3 row ">
                                                        <div class=" col-sm-7form-check mt-2">
                                                            <label class="form-check-label" for="still">
                                                                Still Working
                                                                <input class="form-check-input" name="working" onchange="clicked()" type="checkbox" id="still" @if(old('working') == 'on') checked @endif>
                                                            </label>
                                                        </div>
                                                      <div id="dateOL" class="d-flex">
                                                        <label for="datel" class="col-sm-4  col-form-label"> Date of
                                                            leaving
                                                        </label>
                                                        <div class="col-sm-5">
                                                            <input type="date" name="dol" class="form-control {{ $errors->has('dol') ? ' is-invalid' : '' }}"
                                                            value="{{old('dol')}}"
                                                                id="datel">
                                                                @if ($errors->has('dol'))
                                                                <span class="invalid feedback text-red-600 " role="alert">
                                                                    <strong>{{ $errors->first('dol') }}.</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                      </div>

                                                    </div>
                                                    <div class="mb-3 mt-3 row">
                                                        <label for="file" class="col-sm-4 col-form-label">Upload
                                                            image</label>
                                                        <div class="col-sm-5 ">
                                                            <input type="file" name="avatar" id="file" class="form-control {{ $errors->has('avatar') ? ' is-invalid' : '' }}">
                                                            @if ($errors->has('avatar'))
                                                                <span class="invalid feedback text-red-600 " role="alert">
                                                                    <strong>{{ $errors->first('avatar') }}.</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-2"><button type="submit">Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <table class='table border'>
                        <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date of Joining</th>
                                <th>Date of Leaving</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emps as $emp)
                            <tr id="{{$emp->id}}">
                                <td> @if($emp->avatar !== null)
                                    <img src="{{asset('images/'.$emp->avatar)}}" widtd="50" height="40" > 
                                    @else
                                    <img src="{{asset('default.png')}}" widtd="50" height="40" > 
                                    @endif
                                </td>
                                <td>{{$emp->name}}</td>
                                <td>{{$emp->email}}</td>
                                <td>{{$emp->doj->format("d-m-Y")}}</td>
                                <td>{{$emp->dol == null ? "Still Working" : $emp->dol->format("d-m-Y")}}</td>
                                <td>
                                    <button class="btn btn-danger" onclick="remove('{{$emp->id}}')">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('jquery.js')}}">

</script>

<script>

$(document).ready(function () {
    @if ($errors->any())
    $("#exampleModalToggle").modal('show');
    @endif

    checkIftiked()
});

    function clicked() {
        checkIftiked()
    };

    function checkIftiked() {
        if($('#still').is(":checked")) {
            $("#dateOL").html("");
           
        } else {
            $("#dateOL").html("");
            $("#dateOL").append(
                `<label for="datel" class="col-sm-4  col-form-label"> Date of
                    leaving
                </label>
                <div class="col-sm-5">
                    <input type="date" required name="dol" class="form-control {{ $errors->has('dol') ? ' is-invalid' : '' }}"
                        id="datel">
                </div>`
            );
        }
    }

function remove(id) {
  let text = "Are you sure? You won't be able to revert this!";
  if (confirm(text) == true) {
    removeEmployee(id)
  } else {

  }
}

function removeEmployee(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "delete",
        url: "{{route('deleteEmp')}}",
        data: {
            id: id
        },
        dataType: "json",
        success: function (res) {
            $("#"+id).html("");
            $("#"+id).append(
                `
                <td style="color: green; background: rgb(208, 251, 208)" colspan="6" align="center">
                    Deleted
                </td>
                `
            );

            setTimeout(() => {
                $("#"+id).remove()
            }, 5000);
        }
    });
}


</script>
