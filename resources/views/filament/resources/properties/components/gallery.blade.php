<div
    x-data="{
        activeImage: '{{ $record->images->first()
            ? asset('storage/' . $record->images->first()->image)
            : '' }}'
    }"
>

    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">
        Gallery
    </h2>

    {{-- Main Image --}}

    <div class="overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800">

        <template x-if="activeImage">
            <img
                :src="activeImage"
                class="w-full h-[500px] object-cover transition duration-300"
                alt="Property Image"
            >
        </template>

        @if(!$record->images->count())
            <div class="flex h-[500px] items-center justify-center text-gray-400 dark:text-gray-500">
                No images available.
            </div>
        @endif

    </div>

    {{-- Thumbnails --}}

    @if($record->images->count())

        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4 mt-6">

            @foreach($record->images as $image)

                @php
                    $imageUrl = asset('storage/' . $image->image);
                @endphp

                <button
                    type="button"
                    @click="activeImage = '{{ $imageUrl }}'"
                    class="focus:outline-none"
                >

                    <img
                        src="{{ $imageUrl }}"
                        class="rounded-xl h-24 w-full object-cover hover:opacity-80 transition"
                        alt="Property Image"
                    >

                </button>

            @endforeach

        </div>

    @endif

</div>