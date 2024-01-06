<template>
<div class="product-item bg-light mb-4">
    <div class="product-img position-relative overflow-hidden">
        <img class="img-fluid w-100" :src="store.imgBaseUrl + (product.images as IProductMediaInDb[])[0].url" alt="">
        <div class="product-action">
            <button class="btn btn-outline-dark btn-square" @click="addToCart(product.id as number)"><i class="fa fa-shopping-cart"></i></button>
            <button class="btn btn-outline-dark btn-square pl-2" href=""><i class="far fa-heart"></i></button>
            <button class="btn btn-outline-dark btn-square pl-2" href=""><i class="fa fa-sync-alt"></i></button>
            <button class="btn btn-outline-dark btn-square pl-2" href=""><i class="fa fa-search"></i></button>
        </div>
    </div>
    <div class="text-center py-4">
        <nuxt-link class="h6 text-decoration-none text-truncate" :to="'/products/' + product.slug">{{ product.name }}</nuxt-link>
        <div class="d-flex align-items-center justify-content-center mt-2">
            <template v-if="(product.discounted_price as number) > 0">
                <h5>${{ product.discounted_price }}</h5>
                <h6 class="text-muted ml-2">
                    <del>${{ product.price }}</del>
                </h6>
            </template>
            <h5 v-else>${{ product.price }}</h5>
        </div>
        <div class="d-flex align-items-center justify-content-center mb-1">
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small>(99)</small>
        </div>
    </div>
</div>
</template>
<script setup lang="ts">
import type { PropType } from 'vue';
import type { IProduct, IProductMediaInDb } from '~/contracts/pages/IProduct';
// import {useCart} from '~/composables/pages/useCart'

const {addToCart} = useCart();
const store = useGlobalsStore();

const props = defineProps({
    product: {
        type: Object as PropType<IProduct>,
        required: true
    }
});


</script>
