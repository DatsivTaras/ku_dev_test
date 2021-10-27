@extends('layouts.app')
@section('content')
    <div class='container'>    
        <h4 align='center'>{{__('blog.blogs')}}</h4>
        <div align='right'>     
            <a href={{route('admin.blogs.create')}} class='btn btn-success'>{{__('blog.add')}}</a>
        </div>    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{__('blog.title')}}</th>
                        <th scope="col">{{__('blog.status')}}</th>
                        <th scope="col">{{__('blog.create')}}</th>
                        <th scope="col">{{__('blog.update')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td><a href='{{$blog->getLink()}}'>{{$blog->title}}</a></td>
                            <td>{{$blog->getStatus()}}</td>
                            <td>{{$blog->created_at}}</td>
                            <td>{{$blog->updated_at}}</td>
                            <td><a href={{route('admin.blogs.edit', $blog->id)}} class='btn btn-primary'>{{__('blog.update')}}</a></td>
                            <td>
                                <form method="POST" action="{{route('admin.blogs.destroy', $blog->id)}}">
                                    @method('DELETE')    
                                    @csrf
                                    <button class='btn btn-danger'>{{__('blog.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection 