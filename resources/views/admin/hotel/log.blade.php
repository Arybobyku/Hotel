<x-app-layout>

    {{-- <div class="grid grid-rows-1 gap-2 grid-flow-col"> --}}
    <h1 class="mx-10 text-2xl font-bold">Log Aktivitas</h1>

 <div class="mx-10 my-10">
        <form method="GET" action="log">

           <div class="flex flex-warp gap-4">
            <select class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block     dark:focus:ring-blue-500 dark:focus:border-blue-500" name="id_hotel">
                @foreach ($hotels as $hotel)
                <option name="id_hotel" value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
                <button type="submit"
                    class="bg-blue-900 text-white py-2 px-6 mx-4 hover:opacity-75 rounded-lg flex gap-2 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>Filter</button>

            </div>

        </form>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">

        <div class="overflow-x-auto w-full">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Aktivitas</th>
                        <th class="px-4 py-3">Hotel</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($logs as $log)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $log->activity }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $log->namehotel->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
