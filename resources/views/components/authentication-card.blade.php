<div class="flex min-h-screen flex-col items-center justify-center bg-canvas px-4 py-10">
    <div>
        {{ $logo }}
    </div>

    <div class="mt-6 w-full overflow-hidden rounded-2xl border border-line bg-white px-6 py-6 shadow-card sm:max-w-md">
        {{ $slot }}
    </div>
</div>
