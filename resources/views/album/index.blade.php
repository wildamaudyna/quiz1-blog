@extends('layouts.app')

@section('content') 
    
    <div class="container">

        <h3>
            TAMBAH DATA ALBUM
            <a href="{{ url('/album/create') }}" class="btn btn-primary btn-sm float-right">Tambah Data</a>
        </h3>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>NAMA</th>
                <th>TEXT</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->text }}</td>
                    <td><a href="{{ url('album/' . $row->id . '/edit') }}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <form action="{{ url('/album/' . $row->id) }}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
@endsection