
<section class="min-h-full bg-white">

     <div class=" grid grid-cols-6 gap-4 mt-10  h-full p-10">

        <div class="col-start-1 col-span-5 bg-gray-100 rounded-lg shadow-xl ">
            <div class="h-24">
                <h2 class="mb-4 text-lg underline font-bold text-center">{{ __('Articals') }}</h2>

                <div class="col-start-2 col-span-3 row-start-2 row-span-1 bg-cyan-400 rounded-lg shadow-xl h-20 w-8/12 ml-5">

                </div>

            </div>
        </div>

        <div class="md:col-start-6 col-span-1 bg-gray-100 rounded-lg shadow-xl ">
            <div class="h-full">
            <h2 class="mb-4 text-lg underline font-bold text-center">{{ __('Categories') }}</h2>
            @foreach ($categories as $category)
            <button class="text-xl font-medium text-black p-3 bg-gray-400 rounded-full mb-3 ml-3" >{{ $category->name }}</button>
            @endforeach
            <hr class="mt-3">

            <h2 class="mb-4 mt-7 text-lg underline font-bold text-center">{{ __('Tags')}}</h2>
            @foreach ($tags as $tag)
            <button class="text-xl font-medium text-black p-3 bg-gray-400 rounded-full mb-3 ml-3" ># {{ $tag->name }}</button>
            @endforeach
            <hr>

            <h2 class="mb-4 mt-7 text-lg underline font-bold text-center">مقالات قد تهمك</h2>

            <button class="text-xl font-medium text-black p-3 mb-3 ml-3" ></button>

        </div>

    </div>

    </div>
</section>





