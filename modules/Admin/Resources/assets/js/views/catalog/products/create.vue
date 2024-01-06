<template>
    <div class="q-my-md q-mx-lg">
        <div class="row">
            <div class="col-12">
                <h5 class="q-my-md">Create product</h5>
            </div>
        </div>
        <q-form @reset="reset" class="q-gutter-md" v-if="updateComponents==1">
            <div class="row">
                <div class="col-md-7 col-sm-12 q-pr-lg">
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="foundation" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Basic info
                                    </q-item-section>
                                </template>
                                <product-basic-info :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="perm_media" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Media
                                    </q-item-section>
                                </template>
                                <product-media :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="money" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Pricing
                                    </q-item-section>
                                </template>
                                <product-prices :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="inventory" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Inventory
                                    </q-item-section>
                                </template>
                                <product-inventory :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="query_stats" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        SEO optimization
                                    </q-item-section>
                                </template>
                                <product-seo :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <!-- Variants section -->
                    <!-- <q-card class="q-my-md" v-if="isEdit">
                        <q-card-section>
                            <q-expansion-item>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="alt_route" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Variants
                                    </q-item-section>
                                </template>
                                <product-variants-test :product-id="createForm.id" :variants="(createForm.attribute_values as IProductSkuInDB[])" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card> -->
                </div>
                <div class="col-md-5 col-sm-12">
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="toggle_on" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Additional Info
                                    </q-item-section>
                                </template>
                                <product-additional :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-my-md">
                        <q-card-section>
                            <q-expansion-item default-opened>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="category" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        Category and Brand
                                    </q-item-section>
                                </template>
                                <product-relations :form="createForm" />
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div>
                        <q-btn label="Submit" type="button" color="primary" @click="save(createForm)" />
                        <q-btn
                        label="Back"
                        type="button"
                        color="primary"
                        flat
                        class="q-ml-sm"
                        @click="router.go(-1)"
                        />
                </div>
                </div>
            </div>
        </q-form>
        <q-skeleton v-else animation="wave" />
    </div>
</template>
<script setup lang="ts">
import { onMounted, ref, Ref, UnwrapNestedRefs } from "vue";
import useProducts from '../../../composables/products';
import { IProduct, IProductAttributeValue, IProductAttributeValueInDB, IProductSkuInDB } from "../../../contracts/pages/IProduct";
import { useRouter } from "vue-router";

import ProductBasicInfo from "../../../components/pages/products/ProductBasicInfo.vue";
import ProductMedia from "../../../components/pages/products/ProductMedia.vue";
import ProductPrices from "../../../components/pages/products/ProductPrices.vue";
import ProductInventory from "../../../components/pages/products/ProductInventory.vue";
import ProductVariants from "../../../components/pages/products/ProductVariants.vue";
import ProductVariantsTest from "../../../components/pages/products/ProductVariantsTest.vue";
import ProductSeo from "../../../components/pages/products/ProductSeo.vue";
import ProductAdditional from '../../../components/pages/products/ProductAdditional.vue';
import ProductRelations from '../../../components/pages/products/ProductRelations.vue';

const router = useRouter();
const {save, reset, form, isEdit, getOne, id, formCopy} = useProducts();


let createForm: UnwrapNestedRefs<IProduct> = form;
const updateComponents: Ref<number> = ref(0);

function init() {
    if (isEdit.value) {
        getOne(id.value as number)
        .then(res => {
            createForm = res;
            createForm.images = res.images.map(img => img.url);
            createForm.videos = res.videos.map(video => video.url);
            updateComponents.value = 1;
        })
    } else {
        updateComponents.value = 1;
    }
}

const variantForm: Ref<IProductAttributeValue[]> = ref([])

function saveVariants() {

}

onMounted(() => {
    init();
})
</script>
