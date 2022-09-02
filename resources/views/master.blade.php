<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-<ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .image {
            height: 200px;
            object-fit: cover
        }
 
    </style>
</head>

<body>
    <div class="container-fluid p-0 overflow-hidden">
      <header>
        <nav id="navbar_top" class="navbar navbar-expand-lg bg-primary fixed p-3">
          <div class="container-fluid">
              <a class="navbar-brand headerBrand text-bg-primary text-bold" href="#">
                 <b> Shopping Cart</b>
              </a>
              <div class=" d-flex justify-content-end" id="navbarNavDropdown">
                {{-- <a href="{{ route('checkout') }}" id="order" class="btn btn-success">
                  Orders
              </a> --}}
              &nbsp;&nbsp;&nbsp;
                  <a href="{{ route('cart') }}" id="home" class="btn btn-success">
                    Home
                      
                  </a>
                  &nbsp;&nbsp;&nbsp;
                  <form action="{{ route('wishlist') }}">
                    <button id="wishlist" class="btn btn-success position-relative">
                        <i class="fa-solid fa-heart" style="color:white"></i>
                        {{-- <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            @if (Cart::instance('wishlist')->count() > 0)
                                {{ Cart::instance('wishlist')->count() }}
                            @else
                                0
                            @endif
                        </span> --}}
                    </button>
                </form>
                  &nbsp;&nbsp;&nbsp;
                    <button id="cart" class="btn btn-success position-relative" onclick="location='{{ route('cartlist') }}'">
                      <i class="fas fa-cart-plus" style="color:white"></i>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          @if (Cart::instance('shoppingcart')->count() > 0)
                              {{ Cart::instance('shoppingcart')->count() }}
                          @else
                              0
                          @endif
                      </span>
                  </button>
              </div>
          </div>
      </nav>
      </header>
        <main class="container mb-4" style="min-height: 82.3vh;max-height:100%;">
            @yield('content')
        </main>
        <footer>
          <nav class="navbar bottom navbar-dark bg-dark">
           <div class="container" >
             <div class="row w-100 d-flex justify-content-center align-items-center p-4">
               <div class="col-12 col-md-3 text-white">
                 <h6 class="py-2"><b>POPULAR</b></h6>
                 <h6>Iphone 12</h6>
                 <h6>Vivo Y62</h6>
                 <h6>Samsaung Gallaxy 20</h6>
                 <h6>Redmi 12</h6>
               </div>
               <div class="col-12 col-md-3 text-white">
                <h6 class="py-2"><b>BRAND</b></h6>
                <h6>Oppo</h6>
                <h6>Vivo</h6>
                <h6>Samsaung</h6>
                <h6>Real me</h6>
              </div>
              <div class="col-12 col-md-3 text-white">
                <h6 class="py-2"><b>ABOUT US</b></h6>
                <h6>Our Team</h6>
                <h6>Company</h6>
                <h6>Services</h6>
                <h6>Policy</h6>
              </div>
              <div class="col-12 col-md-3 text-white">
               <div class="d-flex justify-content-between align-items-center">
                <i class="fab fa-cc-paypal" style="font-size:50px;margin-left:10px"></i>
                <i class="fab fa-cc-mastercard" style="font-size:50px;margin-left:10px"></i>
                <i class="fab fa-cc-visa" style="font-size:50px; margin-left:10px"></i>
               </div>
              </div>
             </div>
           </div>
          </nav>
        </footer>
      </div>

</body>
<script>
  document.addEventListener("DOMContentLoaded", function() {

      window.addEventListener('scroll', function() {

          if (window.scrollY > 60) {
              document.getElementById('navbar_top').classList.add('fixed-top');
              // add padding top to show content behind navbar
              navbar_height = document.querySelector('.navbar').offsetHeight;
              document.body.style.paddingTop = navbar_height + 'px';
          } else {
              document.getElementById('navbar_top').classList.remove('fixed-top');
              // remove padding top from body
              document.body.style.paddingTop = '0';
          }
      });
  });
  const pathname=window.location.pathname;
  const home=document.getElementById('home');
  const wishlist=document.getElementById('wishlist');
  const cart=document.getElementById('cart');
  const order=document.getElementById('order');
  if(pathname === '/products/cart'){
    home.classList.remove('btn-success');
    home.classList.add('btn-info')
    home.classList.add('text-white')
  }else if(pathname === '/products/wishlist'){
    wishlist.classList.remove('btn-success');
    wishlist.classList.add('btn-info')
  }else if(pathname === '/products/cartlist'){
    cart.classList.remove('btn-success');
    cart.classList.add('btn-info')
  }else if(pathname === '/products/checkout'){
    order.classList.remove('btn-success');
    order.classList.add('btn-info');
    home.classList.add('text-white')
  }
</script>
</html>
