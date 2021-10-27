@extends('layouts.app')

@section('content')
<div class='container'>
    <h3 align='center'>{{__('blog.blogs')}}</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">{{__('blog.title')}}</th>
                <th scope="col">{{__('blog.status')}}</th>
                <th scope="col">{{__('blog.create')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td><a href='{{$blog->getLink()}}'>{{$blog->title}}</a></td>
                    <td>{{$blog->getStatus()}}</td>
                    <td>{{$blog->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 