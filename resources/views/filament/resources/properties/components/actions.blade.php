<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">
        Property Actions
    </h2>

    <div class="flex flex-wrap gap-4">

<button
    type="button"
    onclick="window.open('{{ route('properties.pdf',$record) }}','_blank')"
    class="rounded-xl bg-red-600 hover:bg-red-700 px-6 py-3 text-white font-semibold">

    📄 Download PDF

</button>   

<button
    type="button"
    onclick="window.open('{{ route('properties.images', $record) }}', '_blank')"
    class="rounded-xl bg-gray-800 hover:bg-black px-6 py-3 text-white font-semibold transition">

    📦 Download Images

</button>



    </div>

</div>