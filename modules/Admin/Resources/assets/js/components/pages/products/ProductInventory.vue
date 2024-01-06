<template>
    <div>
        <q-input
            filled
            v-model="form.sku"
            label="SKU"
            lazy-rules
            :rules="[
            (val) => (val && val.length > 0) || 'Please type something',
            ]"
            class="q-my-md"
        />
        <!-- <q-toggle v-model="form.track_quantity" label="Track quantity" class="q-mt-md" color="green" /> -->
        <q-separator color="transparent" />
        <q-toggle v-model="form.sell_out_of_stock" label="Continue selling when out of stock" class="q-my-md" color="green" />
        <q-input color="teal" filled v-model.number="form.quantity" label="Quantity" type="number"/>
        <q-input color="teal" filled v-model="form.measure_type" label="Measure unit" class="q-mt-md" />
    </div>
</template>
<script setup lang="ts">
import { PropType, UnwrapNestedRefs, reactive } from "vue";
import { IProduct } from "../../../contracts/pages/IProduct";

const props = defineProps({
    form: {
        type: Object as PropType<UnwrapNestedRefs<IProduct>>,
        required: true
    }
});

const form: UnwrapNestedRefs<IProduct> = reactive(props.form);
</script>
