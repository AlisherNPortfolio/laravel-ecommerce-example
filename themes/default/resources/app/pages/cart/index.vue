<template>
    <breadcrumbs :links="breadcurmbLinks" />
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <CartTable @cart-items="calculate" />
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ totalPrice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">${{ shippingPrice }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>${{ allTotalPrice }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import Breadcrumbs from '~/components/common/Breadcrumbs.vue';
import CartTable from '~/components/pages/cart/CartTable.vue';
import type IBreadcrumbs from '~/contracts/common/IBreadcrumbs';
import type { ICart } from '~/contracts/pages/ICart';

const breadcurmbLinks: IBreadcrumbs[] = [
    {
        title: "Home",
        link: "/"
    },
    {
        title: "Shop",
        link: "/products"
    },
    {
        title: "Shopping cart"
    }
];

const totalPrice: Ref<number> = ref(0);
const shippingPrice: Ref<number> = ref(10);
const allTotalPrice = computed(() => {
    return totalPrice.value + shippingPrice.value;
})

function calculate(cartItems: ICart[]) {console.log(cartItems)
    if (cartItems.length) {
            totalPrice.value =  cartItems.reduce((a, b) => {
            b.total = (b.total as number) + (a.total as number);
            return b;
        }).total as number;
    }
}
</script>
