<div id="alert-{{ $key }}"
    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
    role="alert">
    <i class="ri-error-warning-line"></i>
    <div class="ms-3 text-sm font-medium">
        {{ $error }}
    </div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
        data-dismiss-target="#alert-{{ $key }}" aria-label="Close">
        <i class="ri-close-line"></i>
    </button>
</div>
