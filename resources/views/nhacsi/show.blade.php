@extends('layouts.master')
@section('title')
    Chi tiết nhạc sĩ
@endsection

@section('content')
<ul>
    <li>ID: {{$model->id}}</li>
    <li>Tên: {{$model->ten}}</li>
</ul>
<ul>
    @foreach(collect($model)->toArray() as $key => $value)
        <li>{{$key}} : {{$value}} </li>
    @endforeach
</ul>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Nhạc sĩ</th>
            <th>Mô tả</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listAmNhac as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->ten}}</td>
                <td>{{$item->ten_nhacsi}}</td>
                <td>{{$item->mota}}</td>
            </tr>
        @endforeach

    </tbody>
</table>
@endsection
