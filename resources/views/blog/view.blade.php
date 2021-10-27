@extends('layouts.app')

@section('content')
    <div class='container'>    
        <h4 align='center'>{{$blog->title}}</h4>
        <h6>{!!$blog->getDescriptionWithLink()!!}</h6>
        <h4 align='center'>{{__('comment.comments')}}</h4>
        {{ Form::open(['class' => 'js-comment-form']) }}
            <div class="input-group mb-3">
                {{ Form::text('comment', '', [
                    'id' => 'inputcomment',
                    'class' => 'js-input-comment form-control', 
                    'placeholder'=>__('comment.leaveAComment')
                ]) }}
                {{ Form::submit(__('comment.leaveAComment'), ['data-id' => $blog->id, 'class' => 'js-add-comment btn btn-primary'])}}
            </div>
            <p class="error-block error-text" style="color:red;"></p>
        {{ Form::close() }}
        <div class="js-get-comments"></div>
    </div>

<script>
    var blogView = {
        id: '{{$blog->id}}',
        routers: {
            create: '/comments',
            index: '/comments',
            delete: '/comments',
        },
        init: function() {
            let app = this;
            
            app.getAllComments();

            $(document).on('click', '.js-delete', function() {
                var id = $(this).data('id');
                app.deleteComment(id);
            });

            $(document).on('keyup', '.js-comment-form input', function(e) {
                e.preventDefault();
                $('.js-comment-form .error-block').text('')
            })

            $(document).on('click', '.js-add-comment', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var comment = $('#inputcomment').val();
                app.addComment(id, comment);
            });
        },

        addComment: function(id, comment) {
            let app = this;
            $.ajax({
                method: 'POST',
                url: app.routers.create,
                data:{
                    blog_id: id,
                    text: comment,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
            }).done(function(result) {
                $('.js-input-comment').val('');
                $('.js-get-comments').prepend(app.generateTemplateComment(result));
            }).fail(function(jqXHR, textStatus) {
                app.addErrorsToForm(jqXHR.responseJSON.errors)
            });
        },

        addErrorsToForm: function (errors) {
            $.each(errors, function(field, fieldErrors) {
                $('.js-comment-form .error-' + field).text(fieldErrors.join(", "))
            });
        },

        deleteComment: function(id) {
            let app = this;
            $.ajax({
                method: 'DELETE',
                url:  app.routers.delete + '/' + id,
                data:{
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
            }).done(function(result) {
                $('.js-comment-delete-' + id).remove();
            });
        },

        getAllComments: function() {
            let id = this.id;
            let app = this;
            $.ajax({
                method: 'get',
                url: app.routers.index,
                data:{
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
            }).done(function(result) {
                let comments = $('.js-get-comments');
                $.each(result, function(index, value) {
                    comments.prepend(app.generateTemplateComment(value));
                });   
            });
        },

        generateTemplateComment: function(comment) {
            return '<div class="js-comment-delete-' + comment['id'] + ' js-comment">'+
                        '<div align=right>'+
                            '<svg data-id=' + comment['id'] + ' class="js-delete" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"> <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/> </svg>' +
                        '</div>' +
                        '<i>' + comment['created_at'] + '</i>' +
                        '<p>' + comment['text'] + '</p>'+
                        '<hr>' +
                    '</div>';
        }
    }

    $(function() {
        blogView.init();
    });
</script>

@endsection 