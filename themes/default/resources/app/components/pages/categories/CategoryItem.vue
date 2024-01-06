<template>
    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
        <nuxt-link class="text-decoration-none" :to="`/categories/${item.slug}`">
            <div class="cat-item d-flex align-items-center mb-4">
                <div class="overflow-hidden" style="width: 100px; height: 100px;">
                    <img class="img-fluid" :src="item.icon ? store + item.icon : '_nuxt/assets/img/cat-1.jpg'" alt="">
                </div>
                <div class="flex-fill pl-3">
                    <h6>{{ item.name }}</h6>
                    <small class="text-body" v-if="item.product_qty">{{ item.product_qty }} Products</small>
                </div>
            </div>
        </nuxt-link>
    </div>
</template>
<script setup lang="ts">
import type { PropType } from 'vue';
import type { ICategory } from '~/contracts/pages/ICommon';
const store = useGlobalsStore();
const props = defineProps({
    item: {
        type: Object as PropType<ICategory>,
        required: true
    }
})
</script>
