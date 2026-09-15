<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-indigo-500 font-semibold">Patient Portal</p>
                        <h3 class="mt-2 text-2xl font-bold text-gray-900">My appointment status</h3>
                    </div>
                    <a href="{{ route('myBookings') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-500 transition">
                        View all bookings
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">
                        <div class="text-sm text-blue-700 font-medium">Your bookings</div>
                        <div class="mt-2 text-3xl font-bold text-blue-900">{{ \App\Models\Booking::where('user_id', Auth::id())->count() }}</div>
                    </div>
                    <div class="rounded-2xl border border-amber-100 bg-amber-50 p-4">
                        <div class="text-sm text-amber-700 font-medium">Pending</div>
                        <div class="mt-2 text-3xl font-bold text-amber-900">{{ \App\Models\Booking::where('user_id', Auth::id())->where('taken', false)->count() }}</div>
                    </div>
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-4">
                        <div class="text-sm text-emerald-700 font-medium">Approved</div>
                        <div class="mt-2 text-3xl font-bold text-emerald-900">{{ \App\Models\Booking::where('user_id', Auth::id())->where('taken', true)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
