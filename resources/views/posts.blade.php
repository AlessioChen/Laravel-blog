<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel blog </title>
</head>

<body>

    <!--  Data input Form -->
    <div class="p-4 border-2 border-black m-5 ">
        <h1 class="text-4xl mb-4"> Create Post </h1>

        <form method="POST" action={{ route('posts.store') }} class="space-y-2 max-w-full">
            @csrf
            <!-- Title -> required -->
            <div class="grid space-y-2">
                <label for="title"> Title </span> </label>
                <input required class="border-2 border-gray-200  " type="text" name="title" />
            </div>

            <!-- Description -->
            <div class="grid space-y-2">
                <label for="description"> Description </label>
                <textarea class="border-2 border-gray-200 h-500" name="description"> </textarea>
            </div>

            <!-- User id -->

            <div class="grid space-y-2">
                <label for="user_id"> User_id </label>
                <input required class="border-2 border-gray-200  " type="number" name="user_id" />
            </div>

            <!-- Submit Button -->
            <div class="space-y-2">
                <button type="submit" class="bg-blue-400  hover:bg-blue-700 hover:text-white rounded-lg p-2"> Submit
                </button>
            </div>
        </form>
    </div>

    <h1 class="text-center text-4xl text-red-500 font-semibold"> POSTS </h1>

    <!-- Post cards  -->

    <div class="p-4 space-y-2">
        @foreach ($posts as $post)
            <!-- Card -->

            <form method="POST" action={{route('posts.destroy', $post->id) }} >
                @method('DELETE')
                @csrf

                <div class="border p-2 border-blue-500 shadow-lg ">
                    <h2 class="text-left text-2xl mb-2 ">{{ $post->title }} </h2>
                    <span class="text-base font-serif ">    {{$post->user->name}}  </span>

                    <p class="text-xl"> {{ $post->description }} </p>
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 hover:text-white rounded-lg p-2 mt-1 inline-block"> Delete
                        </a>
                </div>
            </form>
        @endforeach


    </div>


</body>

</html>
