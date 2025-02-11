@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">إنشاء طلب جديد</h1>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                             class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text"><strong>السعر:</strong> {{ $product->price }} $</p>
                            <p class="card-text"><strong>الكمية المتوفرة:</strong> {{ $product->stock }}</p>

                            <div class="input-group mb-2">
                                <input type="number" class="form-control quantity-input" min="1" max="{{ $product->stock }}" placeholder="الكمية" id="qty_{{ $product->id }}">
                                <button class="btn btn-success add-to-cart" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">إضافة إلى السلة</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="my-4">السلة</h3>
        <ul id="cart-list" class="list-group mb-3"></ul>

        <form action="{{ route('orders.store') }}" method="POST" id="order-form">
            @csrf
            <input type="hidden" name="products" id="cart-data">
            <button type="submit" class="btn btn-primary">إتمام الطلب</button>
        </form>
    </div>

    <script>
        let cart = [];

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                let productId = this.getAttribute('data-id');
                let productName = this.getAttribute('data-name');
                let productPrice = this.getAttribute('data-price');
                let quantity = document.getElementById('qty_' + productId).value;

                if (quantity <= 0 || quantity === '') {
                    alert('يرجى إدخال كمية صحيحة');
                    return;
                }

                let existingProduct = cart.find(item => item.id === productId);
                if (existingProduct) {
                    existingProduct.quantity = quantity;
                } else {
                    cart.push({ id: productId, name: productName, price: productPrice, quantity: quantity });
                }

                updateCartView();
            });
        });

        function updateCartView() {
            let cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';

            cart.forEach(item => {
                let listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerHTML = `${item.name} (x${item.quantity}) - ${item.price * item.quantity} $ <button class="btn btn-sm btn-danger" onclick="removeFromCart('${item.id}')">حذف</button>`;
                cartList.appendChild(listItem);
            });

            document.getElementById('cart-data').value = JSON.stringify(cart);
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartView();
        }
    </script>
@endsection
