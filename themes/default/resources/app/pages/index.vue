<template>
    <!-- Carousel -->
    <PagesHomeCarousel />

    <!-- Featured -->
    <PagesHomeFeatures />


    <!-- Categories -->
    <PagesHomeCategories :list="categories" />


    <!-- Products -->
    <PagesHomeProducts v-if="featuredProducts.length > 0" :list="featuredProducts" />

    <!-- Offer -->
    <PagesHomeOffer />


    <!-- Recent Products -->
    <PagesHomeRecentProducts v-if="latestProducts.length > 0" :list="latestProducts" />

    <!-- Vendor -->
    <PagesHomeVendor />
</template>
<script setup lang="ts">
import { useHttpFetch } from '~/composables/useHttpFetch';
import type { IProduct } from '~/contracts/pages/IProduct';
import type { ICategory } from '~/contracts/pages/ICommon';

let featuredProducts: Ref<IProduct[]> = ref([]);
let latestProducts: Ref<IProduct[]> = ref([]);
let categories: Ref<ICategory[]> = ref([]);

function getProducts() {
   useHttpFetch().get('home-products')
    .then((res: any) => {
        if (res.success) {
            const dataWrapper = res.data;console.log(res.data)
            featuredProducts.value = dataWrapper.products.featured as IProduct[];
            latestProducts.value = dataWrapper.products.latest as IProduct[];
            categories.value = dataWrapper.categories as ICategory[];
        }
    })
}

onMounted(() => {
    getProducts();
})
</script>
