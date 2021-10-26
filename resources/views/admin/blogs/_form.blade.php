@if(!$blog->id)
    {{ Form::open(['route' =>  'admin.blogs.store', 'method' => 'post']) }}
@else
    {{ Form::open(['route' => ['admin.blogs.update', $blog->id], 'method' => 'put']) }}
@endif

    <div class="mb-3">
        {{ Form::label('text', __('blog.title'), ['class' => 'form-label']) }}
        {{ Form::text('title', $blog->title, ['class' => 'form-control']) }}
        @error('title')
            <h7 style='color:red'>{{$message}}</h7>
        @enderror
    </div>
    <div class="mb-3">
        {{ Form::label('text', __('blog.description'), ['class' => 'form-label']) }}
        {{ Form::text('description', $blog->description, ['class' => 'form-control']) }}
        @error('description')
            <h7 style='color:red'>{{$message}}</h7>
        @enderror
    </div>
    <div class="mb-3">
        {{ Form::label('text', __('blog.status'), ['class' => 'form-label']) }}
        {{ Form::select('status', $status, $blog->status, ['class' => 'form-select']) }}
    </div>
    <div align='center'>
        {{ Form::submit(!$blog->id ? __('blog.create') : __('blog.Update'), ['class' => 'btn btn-primary'])}}
    </div>
{{ Form::close() }}
