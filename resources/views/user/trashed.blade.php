<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <x-common.page-top-link :href="route('users.index')">
                    <i class="ri-arrow-left-line"></i>
                    Back
                </x-common.page-top-link>
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
                            All Trashed Users
                        </h2>
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
