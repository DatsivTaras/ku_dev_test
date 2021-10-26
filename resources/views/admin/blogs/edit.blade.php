@extends('layouts.app')
@section('content')
   <div class='container'>
        <h3 align='center'>{{__('blog.updateDescription')}}</h3>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @include('/admin/blogs/_form')
            </div>
        </div>
    </div>
@endsection 