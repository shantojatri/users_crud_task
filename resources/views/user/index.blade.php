<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <a href="{{ route('users.create') }}"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <i class="ri-add-line"></i>
                    Create
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Card -->
                    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl pb-5">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            All Users
                        </h2>
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <a href="#"
                            class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            <i class="ri-delete-bin-4-line"></i>
                            Trash
                        </a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>
