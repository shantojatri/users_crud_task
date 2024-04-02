<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
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
                <div class="py-10 px-8 text-gray-900">
                    <div class="w-full mx-auto">
                        <form action="{{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="pb-5">
                                <img class="rounded w-36 h-36"
                                    src="{{ $user->avatar ? $user->avatar_url :'/config/default.png' }}" alt="avatar">
                            </div>

                            <div class="mb-5">
                                <label for="avatar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
                                <input type="file" id="avatar" name="avatar"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="Enter your name" autocomplete="off" />
                            </div>

                            <div class="mb-5">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="name" name="name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="Enter your name" autocomplete="off" value="{{ $user->name }}" />
                            </div>

                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" id="email" name="email"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="example@email.com" autocomplete="email" value="{{ $user->email }}" />
                            </div>

                            <div class="mb-5">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="tel" id="phone" name="phone"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="01XXX-XXXXXX" autocomplete="mobile" value="{{ $user->phone }}" />
                            </div>

                            <div class="mb-5">
                                <label for="status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select a Status</option>
                                    <option value="{{ App\Utils\GlobalConstant::STATUS_ACTIVE }}" {{
                                        App\Utils\GlobalConstant::STATUS_ACTIVE==$user->status ? 'selected' : ''
                                        }}>Active</option>
                                    <option value="{{ App\Utils\GlobalConstant::STATUS_INACTIVE }}" {{
                                        App\Utils\GlobalConstant::STATUS_INACTIVE==$user->status ? 'selected' : ''
                                        }}>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    password</label>
                                <input type="password" id="password" name="password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="Password" />
                            </div>

                            <div class="mb-5">
                                <label for="repeat-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat
                                    password</label>
                                <input type="password" id="repeat-password" name="password_confirmation"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    placeholder="Confirm password" />
                            </div>

                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                            <p class="text-lg font-medium text-gray-900 dark:text-white pb-3">User Adreess</p>

                            <div id="user_form">
                                @foreach ($user->address as $key=>$address)
                                    @php
                                        $addressCount = $key;
                                    @endphp
                                    @if ($key!=0)
                                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                                    @endif
                                    <div class="flex repeater">
                                        <div class="w-[90%]">
                                            <div class="mb-6">
                                                <label for="address"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address {{ ++$addressCount }}</label>
                                                <input type="text" name="addresses[{{ $key }}][address]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Enter address" value="{{ $address->address }}" />
                                            </div>
                                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                                <div>
                                                    <label for="country"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                                    <input type="text" name="addresses[{{ $key }}][country]"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Enter country" value="{{ $address->country }}" />
                                                </div>
                                                <div>
                                                    <label for="state"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                                                    <input type="text" name="addresses[{{ $key }}][state]"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Enter state" value="{{ $address->state }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-[10%]">
                                            <div class="py-5 px-3 mt-2 flex gap-1">
                                                <button onclick="addNewAddress()" type="button"
                                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Submit button -->
                            <x-common.submit-btn>
                                Update
                            </x-common.submit-btn>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function addNewAddress() {
            let addressElem = $('.repeater');
            let addressCount = addressElem.length;
            let addressLine = addressCount;

            let addressData = '';

            addressData = `<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="flex repeater">
                <div class="w-[90%]">
                    <div class="mb-6">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address ${++addressLine}</label>
                        <input type="text" name="addresses[${addressCount}][address]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter address" />
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="country"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" name="addresses[${addressCount}][country]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter country" />
                        </div>
                        <div>
                            <label for="state"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                            <input type="text" name="addresses[${addressCount}][state]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter state" />
                        </div>
                    </div>
                </div>
                <div class="w-[10%]">
                    <div class="py-5 px-3 mt-2 flex gap-1">
                        <button onclick="addNewAddress()" type="button"
                            class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Add</button>
                    </div>
                </div>
            </div>`;

            $('#user_form').append(addressData);
            addressCount++;
        }
    </script>
    @endpush
</x-app-layout>
