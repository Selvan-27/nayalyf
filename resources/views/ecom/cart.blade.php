
@extends('layout')
@section('content')


    <!-- header start -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <i class="iconsax" data-icon="text-align-left"></i>
                </a>
                <h3>Nayalyf SHOP</h3>
                
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- cart section starts -->
    <section class="section-sm-t-space">
        <div class="custom-container">
            <div class="row gy-3 gx-0">
                
                           
                @foreach($data as $item)
                  @if(!$is_active)
                        @php  $discount = $discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                        @endphp
                @endif  
                
                   @if($is_active?? false)
                                
                                
                                   
                                                                   
                <div class="col-12">
                    <div class="product-box vertical-product product-item"
             data-id="{{$item->id}}"
             data-name="{{$item->name}}"
              data-mrp="{{$item->mrp}}"  data-dc="{{$item->dc}}"
              data-price="{{$item->price}}">
                      
            <a href="product-details.html" class="product-img">
                <img src="https://admin.nayalyf.com/storage/app/public/{{$item->image_url}}" class="img-fluid" alt="">
            </a>
            <div class="product-content">
                <h6 class="content-color">{{$item->category}}</h6>
                <a href="product-details.html" class="product-top">
                    <h5 class="title-color white-nowrap">{{$item->name}}</h5>
                </a>
                <div class="bottom-content cart-content">
                @if($is_active)
                   <h5 class="price">₹ {{$item->price}}</h5>
                @else
             
                                
                                
                <h5 class="price">₹ {{$offer_price}}</h5>
                @endif
              
                   
                    <input type="hidden" class="pv" value="{{$item->pv}}" >
                        
                    <div class="plus-minus">
                        <i class="iconsax icon sub" data-icon="minus"></i>
                        <input type="number" class="quantity" disabled value="0" step="0" min="0" max="100">
                        <i class="iconsax icon add" data-icon="add"></i>
                    </div>
                </div>
            </div>
        </div>
                        
                    </div>
                    
                    
                                @else
                                @php  $discount = $item->discount ??  '0'; 
                                      $offer_price = $item->mrp - ($item->mrp*($discount/100)); 
                                @endphp
                                
                                
                                                     
                                                                   
                <div class="col-12">
                    <div class="product-box vertical-product product-item"
             data-id="{{$item->id}}"
             data-name="{{$item->name}}"
              data-mrp="{{$item->mrp}}"  data-dc="{{$item->dc}}"
              data-price="{{$offer_price}}">
                      
            <a href="product-details.html" class="product-img">
                <img src="https://admin.nayalyf.com/storage/app/public/{{$item->image_url}}" class="img-fluid" alt="">
            </a>
            <div class="product-content">
                <h6 class="content-color">{{$item->category}}</h6>
                <a href="product-details.html" class="product-top">
                    <h5 class="title-color white-nowrap">{{$item->name}}</h5>
                </a>
                <div class="bottom-content cart-content">
                @if($is_active)
                   <h5 class="price">₹ {{$item->price}}</h5>
                @else
             
                                
                                
                <h5 class="price">₹ {{$offer_price}}</h5>
                @endif
              
                   
                    <input type="hidden" class="pv" value="{{$item->pv}}" >
                        
                    <div class="plus-minus">
                        <i class="iconsax icon sub" data-icon="minus"></i>
                        <input type="number" class="quantity" disabled value="0" step="0" min="0" max="100">
                        <i class="iconsax icon add" data-icon="add"></i>
                    </div>
                </div>
            </div>
        </div>
                        
                    </div>
                    
                               
                                           
                                @endif
                                

               
                 @endforeach

           
            </div>
        </div>
    </section>

     <section>
        <div class="custom-container">
     
    <!--        <div class="promo-code position-relative">
                <input type="email" class="form-control code-form-control" placeholder="Apply promo code" disabled>
                <a href="#" class="btn btn-small theme-btn apply-btn fw-medium mt-0 disabled">Apply</a>
            </div> -->
        </div>
    </section>

    <section>
        <div class="custom-container">
            <div class="title mb-2">
                <h3>Price Details</h3>
            </div>
            <div class="bill-box">
                <div class="bill-box-content">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-medium content-color">Total Items</h5>
                        <h5 class="fw-medium title-color" id="qty-total" >0 Items</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <h5 class="fw-medium content-color">Actual Price</h5>
                        <h5 class="fw-medium title-color"  id="cart-mrp_total">₹ 0.00</h5>
                    </div>
                    

                    <div class="total-amount">
                        <h5 class="fw-medium title-color">Total Payable Amount</h5>
                        <h4 class="fw-medium theme-color"  id="cart-total">₹ 0.00</h4>
                    </div>
                

                </div>
            </div>
            <h6 class="color-theme-color fw-medium mt-2">You save ₹ <span id="diss"></span> on this Order!</h6>
        </div>
    </section>

    <div class="secure-payment-wrapper mt-24">
        <img class="img-fluid" src="assets/images/svg/secure.svg" alt="secure">
        <p>Safe and secure payments. 100% Authentic products.</p>
    </div><br><br><br><br>

    

    <!-- cart buttons start -->
    <div class="cart-btns">
        
        <div>
            <!--<h6 class="content-color fw-medium"><del>₹ 1000.00</del></h6>-->
            <h4 class="fw-medium title-color" id="cart-total1">₹ 0.00</h4>
        </div>
                <a href="#" onclick="move_to_checkout()" class="btn btn-small theme-btn">
            <i class="iconsax me-2" data-icon="bank-card"></i>
            Place Order
        </a>
        

        <!--<a href="/Checkout" class="btn btn-small theme-btn">-->
        <!--    <i class="iconsax me-2" data-icon="bank-card"></i>-->
        <!--    Place Order Phonepe-->
        <!--</a>-->
        
        
    </div>
    <!-- cart buttons end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function(){

    // Load cart values from localStorage on page load
    loadItemsFromLocalStorage();

    function loadItemsFromLocalStorage() {
        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        
           // 1. Hide ALL rows first
    $(".product-item").hide();
    
          cart.forEach(item => {
            let productRow = $(".product-item[data-id='" + item.id + "']");
        
            // Hide all rows first
            productRow.hide();
        
            // If qty >= 1 → show and update quantity
            if (item.qty >= 1) {
                productRow.show();
                productRow.find(".quantity").val(item.qty);
            }
        });

       
 
        updateCartTotal();
    }

    // Increase quantity
    $(".add").click(function(){
        let product = $(this).closest(".product-item");
        let input = product.find(".quantity");
        let qty = parseInt(input.val()) || 0;
// alert(qty);
        if (qty < 100) {
            // qty++;
            input.val(qty);
            updateCart(product);
        }
    });

    // Decrease quantity
    $(".sub").click(function(){
        let product = $(this).closest(".product-item");
        let input = product.find(".quantity");
        let qty = parseInt(input.val()) || 0;

        if (qty >=0) {
            // qty--;
            input.val(qty);
            updateCart(product);
        }
    });
    
    function calculateDeliveryCost(delivery_charges_weight) {
    const priceBreakdown = [
        { weight: 1000, cost: 50 },
        { weight: 1500, cost: 80 },
        { weight: 2000, cost: 100 },
        { weight: 2500, cost: 120 },
        { weight: 3000, cost: 150 },
        { weight: 3500, cost: 170 },
        { weight: 4000, cost: 200 },
        { weight: 4500, cost: 220 },
        { weight: 4500, cost: 250 },
        { weight: 5500, cost: 290 },
        { weight: 6500, cost: 340 }
    ];

    let cost = 0;
    let remainingWeight = delivery_charges_weight;

    // Loop through the priceBreakdown to calculate the cost
    for (let i = priceBreakdown.length - 1; i >= 0; i--) {
        const currentWeight = priceBreakdown[i].weight;
        const currentCost = priceBreakdown[i].cost;

        if (remainingWeight >= currentWeight) {
            cost += currentCost;
            remainingWeight -= currentWeight;
            break;
        }
    }

    // Handle remaining weight, assuming the 500g increment price (20 or 30 or 40 based on the breakdown)
    if (remainingWeight > 0) {
        const additionalCost = Math.ceil(remainingWeight / 500) * 20; // You can modify this logic to match the exact pricing scheme
        cost += additionalCost;
    }
    if(cost==20){
        cost=50;
    }
    return cost;
}

    // Update cart item in localStorage
    function updateCart(productItem){
        let id = productItem.data("id");
        let name = productItem.data("name");
        let price = parseFloat(productItem.data("price"));
        let mrp = parseFloat(productItem.data("mrp"));
        let dc = parseFloat(productItem.data("dc"));
        let qty = parseInt(productItem.find(".quantity").val()) || 0;
        let pv = parseInt(productItem.find(".pv").val()) || 0;

        let total = price * qty;
        let mrp_total = mrp * qty;
        let dc_total = dc * qty;
        let pv_total = pv * qty;

        let product = {
            id: id,
            name: name,
            mrp: mrp,
            price: price,
            qty: qty,
            pv: pv_total,
            dc: dc_total,
            total: total,
            mrp_total: mrp_total
        };

        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];
        let index = cart.findIndex(item => item.id === id);

        if (index !== -1) {
            cart[index] = product;
        } else {
            cart.push(product);
        }
// alert(qty);
        // Remove if qty is 0
        if (qty === 0) {
            cart = cart.filter(item => item.id !== id);
        }

        localStorage.setItem("Ecart", JSON.stringify(cart));
        updateCartTotal();
    }

    // Update totals
    function updateCartTotal(){
        let cart = JSON.parse(localStorage.getItem("Ecart")) || [];

        let totalPrice = 0;
        let totalMrp = 0;
        let totalPV = 0;
        let totalDc = 0;
        let ttotal = 0;
        let qty_total = 0;

        cart.forEach(item => {
            totalPrice += item.total;
            totalMrp += item.mrp_total;
            totalPV += item.pv;
            totalDc += item.dc;
            qty_total += item.qty;
        });


        //dc calculate
        const dc_cost = calculateDeliveryCost(totalDc);
console.log(`Total Delivery Cost for ${totalDc}g: ₹${dc_cost}`);


        let cartTotal = {
            total_mrp: totalMrp,
            delivery_charge: totalDc,
            dc_cost:dc_cost,
            wallet: 0,
            ttotal: totalPrice+dc_cost,
            totalPV: totalPV,
            total_price: totalPrice,
            grand_total: totalPrice+dc_cost
        };

        localStorage.setItem("Ecart_total", JSON.stringify(cartTotal));

        // Update UI
        $("#cart-total").text("₹ " + totalPrice.toFixed(2));
        $("#cart-total1").text("₹ " + totalPrice.toFixed(2));
        $("#qty-total").text(qty_total + " Items");
        $("#diss").text((totalMrp - totalPrice).toFixed(2));
        $("#cart-mrp_total").text("₹ " + totalMrp.toFixed(2));

        // console.log("Cart Total:", cartTotal);
    }

});
</script>


<script>
function move_to_checkout(){

const cart = JSON.parse(localStorage.getItem("Ecart")) || [];

    if (cart.length === 0) {
         Swal.fire({
                icon: 'error',
                title: 'Your Cart Is Empty!',
                // text: "You have select Delivery Address.",
                confirmButtonText: 'Add Products'
      });  
      //alert("Cart is empty!");
      return;
    }
    
     window.location.assign("https://nayalyf.com/Checkout")
}
</script>


    

       <script src="{{ asset('js/cart.js') }}"></script>

    <!-- remove-item js -->
    <script src="assets/js/remove-item.js"></script>

    <!-- quantity js -->
    <script src="assets/js/quantity.js"></script>

    <!-- script js -->
      
   
@endsection