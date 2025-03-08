@extends('employee/layouts/app')

@section('contents')
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-2 shadow-lg rounded bg-white">
            <div class="flex items-center mx-8 mt-10">
                <h3 class="font-semibold text-xl text-blueGray-700">
                    Setting
                </h3>
            </div>

            <div class="block w-full overflow-x-auto p-8">
                <form method="POST" action="{{ route('setting.update', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-6">
                        <label for="text_color" class="block mb-2 text-sm font-medium text-gray-900">Text Color</label>
                        <select class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                name="text_color" id="text_color">
                            @foreach ($textColors as $item)
                                <option value="{{ $item->name }}" {{ $item->name == Auth::user()->text_color ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="header_bg_color" class="block mb-2 text-sm font-medium text-gray-900">Header Color</label>
                        <select class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                name="header_bg_color" id="header_bg_color">
                            @foreach ($bgColors as $item)
                                <option value="{{ $item->name }}" {{ $item->name == Auth::user()->header_bg_color ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="sidebar_bg_color" class="block mb-2 text-sm font-medium text-gray-900">Sidebar Color</label>
                        <select class="form-select bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5"
                                name="sidebar_bg_color" id="sidebar_bg_color">
                            @foreach ($bgColors as $item)
                                <option value="{{ $item->name }}" {{ $item->name == Auth::user()->sidebar_bg_color ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Upload Background Image -->
                    <div class="mb-6">
                        <label for="background_image" class="block mb-2 text-sm font-medium text-gray-900">Background Image</label>
                        <input type="file" name="background_image" id="background_image"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                        @if(Auth::user()->background_image)
                            <p class="mt-2 text-sm text-gray-600">Current background: 
                                <img src="{{ asset('storage/' . Auth::user()->background_image) }}" alt="Current Background" class="mt-2 w-32 h-auto rounded-lg">
                            </p>
                        @endif
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
