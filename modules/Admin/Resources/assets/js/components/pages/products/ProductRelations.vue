<template>
<div>
    <AppTree :data="tree" v-if="updateTree" v-model="(form.category_id as number)" :checkbox-all="false" />
    <q-select
        filled
        v-model="form.brand_id"
        use-input
        input-debounce="0"
        label="Brand"
        :options="options"
        class="q-mt-md"
        option-label="name"
        option-value="id"
        @filter="filterBrands"
        emit-value
        :display-value="displaySelectedBrand(form.brand_id)"
    >
        <template v-slot:no-option>
        <q-item>
            <q-item-section class="text-grey">
            No results
            </q-item-section>
        </q-item>
        </template>
    </q-select>

    <q-select
        filled
        v-model.number="form.shipping_id"
        use-input
        input-debounce="0"
        label="Shipping method"
        :options="shippingOptions"
        class="q-mt-md"
        option-label="name"
        option-value="id"
        @filter="filterShippings"
        emit-value
        :display-value="displaySelectedShipping(form.shipping_id)"
    >
        <template v-slot:no-option>
        <q-item>
            <q-item-section class="text-grey">
            No results
            </q-item-section>
        </q-item>
        </template>
    </q-select>

    <q-select
        filled
        v-model.number="form.tax_rule_id"
        use-input
        input-debounce="0"
        label="Tax rule"
        :options="taxRuleOptions"
        class="q-mt-md"
        option-label="name"
        option-value="id"
        @filter="filterTaxRules"
        emit-value
        :display-value="displaySelectedTaxRule(form.tax_rule_id)"
    >
        <template v-slot:no-option>
        <q-item>
            <q-item-section class="text-grey">
            No results
            </q-item-section>
        </q-item>
        </template>
    </q-select>
</div>
</template>
<script setup lang="ts">
import { onMounted, PropType, ref, Ref, UnwrapNestedRefs, reactive } from "vue";
import useBrands from "../../../composables/brands";
import useCategories from "../../../composables/categories";
import useShipping from "../../../composables/shipping";
import useTaxRule from "../../../composables/tax-rule";
import { ICategoryTree } from "../../../contracts/pages/IBanners";
import { IProduct } from "../../../contracts/pages/IProduct";
import notify from "../../../helpers/notify";
import AppTree from "../categories/AppTree.vue";

const {getTree} = useCategories();
const {getAllShippings, filterShippings, displaySelectedShipping, shippingOptions} = useShipping();
const{getAllTaxRules, filterTaxRules, displaySelectedTaxRule, taxRuleOptions} = useTaxRule();
const {getAll, filterBrands, displaySelectedBrand, options} = useBrands();

const props = defineProps({
    form: {
        type: Object as PropType<UnwrapNestedRefs<IProduct>>,
        required: true
    }
});
const form: UnwrapNestedRefs<IProduct> = reactive(props.form);

let tree: ICategoryTree[] = [];
const updateTree: Ref<boolean> = ref(false);

// ========= brands
onMounted(() => {
     getAll();
     getAllShippings();
     getAllTaxRules();
     getTree()
    .then(res => {
        if (res.success) {
            tree = res.data;
            updateTree.value = true;
        } else {
            notify.error('Error on getting category tree');
        }
    });
})
</script>
