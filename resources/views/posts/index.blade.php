@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Post</label>
                    <textarea type="text" name="body" id="body" cols="30" rows="4" placeholder="Write something"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body')
                               border-red-500 @enderror" value=""></textarea>

                    @error('body')
                    <div class="mt-2 text-red-500 mb-2 text-small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="mb-4 bg-blue-500 text-white px-4 py-3 rounded font-medium">
                        Post
                    </button>
                </div>
            </form>

            @if($posts->count())
                @foreach($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection
