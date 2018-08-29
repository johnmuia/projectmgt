<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ( !$projects->isEmpty() ) 
                    
                    @foreach ( $projects  as $project)
                      
                    <p><b>{{ $project->name }}</b></p>
                    <p>
                        {{ $project->description }}
                    </p>
                    <hr />
                    <h4>Display Comments</h4>
                    @foreach($project->comments as $comment)
                        <div class="display-comment">
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->description }}</p>
                        </div>
                    @endforeach
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form>
                </div>
                
            </div>
             @endforeach

             @endif
        </div>
    </div>
</div>
@endsection
