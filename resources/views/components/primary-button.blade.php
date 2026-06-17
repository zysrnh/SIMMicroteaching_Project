<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-4 py-3 bg-primary-600 border border-transparent rounded-xl font-bold text-sm text-white tracking-wide hover:bg-primary-500 hover:shadow-lg hover:shadow-primary-500/30 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 ease-out']) }}>
    {{ $slot }}
</button>
