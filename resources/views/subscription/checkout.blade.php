@extends('layouts.dashboard')

@section('title', 'Checkout')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-8 space-y-8">
            <!-- Header -->
            <div class="border-b border-gray-100 pb-8">
                <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
                <p class="mt-2 text-sm text-gray-500">Selesaikan pembayaran untuk mengaktifkan paket berlangganan Anda</p>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6">
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>
                    
                    <div class="flex justify-between items-center py-4 px-6 bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $plan->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $plan->description }}</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">Rp{{ number_format($plan->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="space-y-3 py-4">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($plan->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>PPN (11%)</span>
                            <span>Rp{{ number_format($plan->price * 0.11, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-semibold text-gray-900 pt-3 border-t border-gray-100">
                            <span>Total</span>
                            <span>Rp{{ number_format($plan->price * 1.11, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Yang Anda Dapatkan</h3>
                    <ul class="space-y-3 bg-gray-50 rounded-lg p-6">
                        @foreach(json_decode($plan->features) as $feature)
                        <li class="flex items-start">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-sm text-gray-600">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Payment Button -->
                <div class="flex flex-col space-y-4 pt-8 border-t border-gray-100">
                    <button type="button" 
                            id="pay-button"
                            class="w-full rounded-lg border border-gray-900 bg-gray-900 py-2.5 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-colors">
                        Bayar Sekarang
                    </button>
                    <p class="text-center text-sm text-gray-500">
                        Dengan melanjutkan, Anda menyetujui <a href="#" class="font-medium text-gray-700 hover:text-gray-900">Syarat dan Ketentuan</a> kami
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route('dashboard') }}';
            },
            onPending: function(result) {
                alert('Pembayaran pending, silakan selesaikan pembayaran Anda');
            },
            onError: function(result) {
                alert('Pembayaran gagal, silakan coba lagi');
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran sebelum menyelesaikan pembayaran');
            }
        });
    });
</script>
@endpush 