@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Checkout</h1>

    @if(empty($cart))
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-gray-600 text-lg">Your cart is empty. Please add some products before checking out.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300">Continue Shopping</a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Order Summary -->
            <div class="lg:w-1/2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Order Summary</h2>
                <div class="border-b border-gray-200 pb-4 mb-4">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                <div>
                                    <p class="font-medium">{{ $details['name'] }}</p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $details['quantity'] }}</p>
                                </div>
                            </div>
                            <span class="font-semibold">Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                        </div>
                        @php $total += $details['price'] * $details['quantity']; @endphp
                    @endforeach
                </div>
                <div class="flex justify-between items-center text-xl font-bold">
                    <span>Total:</span>
                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="lg:w-1/2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Shipping Information</h2>
                <form action="#" method="POST"> {{-- Replace # with your actual checkout processing route --}}
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                        <input type="text" id="address" name="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City:</label>
                        <input type="text" id="city" name="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-6">
                        <label for="zip" class="block text-gray-700 text-sm font-bold mb-2">Zip Code:</label>
                        <input type="text" id="zip" name="zip" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <h2 class="text-2xl font-semibold mb-4">Payment Information</h2>
                    <div class="mb-4">
                        <label for="card_number" class="block text-gray-700 text-sm font-bold mb-2">Card Number:</label>
                        <input type="text" id="card_number" name="card_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="**** **** **** ****" required>
                    </div>
                    <div class="mb-4 flex gap-4">
                        <div class="w-1/2">
                            <label for="expiry_date" class="block text-gray-700 text-sm font-bold mb-2">Expiry Date:</label>
                            <input type="text" id="expiry_date" name="expiry_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="MM/YY" required>
                        </div>
                        <div class="w-1/2">
                            <label for="cvv" class="block text-gray-700 text-sm font-bold mb-2">CVV:</label>
                            <input type="text" id="cvv" name="cvv" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="***" required>
                        </div>
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition duration-300 w-full text-lg font-semibold">Place Order</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
