<div
    x-data="{
        activeImage: '{{ $record->coverImage
            ? asset('storage/'.$record->coverImage->image)
            : '' }}'
    }"
    class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">

        Gallery

    </h2>

    {{-- Main Image --}}

    <div
        class="overflow-hidden rounded-2xl bg-gray-100">

        <img
            :src="activeImage"
            class="w-full h-[500px] object-cover transition duration-300">

    </div>

    {{-- Thumbnails --}}

    <div
        class="grid grid-cols-6 gap-4 mt-6">

        @foreach($record->images as $image)

            <button
                @click="activeImage='{{ asset('storage/'.$image->image) }}'">

                <img
                    src="{{ asset('storage/'.$image->image) }}"
                    class="rounded-xl h-24 w-full object-cover hover:opacity-80 transition">

            </button>

        @endforeach

    </div>

</div>