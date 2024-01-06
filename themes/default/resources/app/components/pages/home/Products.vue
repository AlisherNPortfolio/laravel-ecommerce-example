<template>
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5" v-if="list.length > 0">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" v-for="(product, index) in list" :key="index">
                <product-item :product="product" />
            </div>
        </div>
    </div>
    <!-- Products End -->
</template>
<script setup lang="ts">
import type { IProduct } from '~/contracts/pages/IProduct';
import ProductItem from './../products/ProductItem.vue';
import type { PropType } from 'vue';

const props = defineProps({
    list: {
        type: Object as PropType<IProduct[]>,
        required: true
    }
});
</script>
