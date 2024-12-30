@extends('layouts.dashboard')

@section('title', 'Paket Berlangganan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Paket Berlangganan</h1>
        <a href="{{ route('subscription-plans.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 border border-transparent rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Paket
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Paket
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durasi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fitur
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($subscriptionPlans as $plan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $plan->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($plan->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $plan->formatted_price }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $plan->duration_in_days }} hari</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $plan->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <ul class="text-sm text-gray-900 list-disc list-inside">
                                    @foreach (json_decode($plan->features) as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('subscription-plans.edit', $plan) }}"
                                        class="text-gray-600 hover:text-gray-900">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('subscription-plans.destroy', $plan) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada paket berlangganan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($subscriptionPlans->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $subscriptionPlans->links() }}
            </div>
        @endif
    </div>
@endsection 