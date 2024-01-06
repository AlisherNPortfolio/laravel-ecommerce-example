<template>
<div class="row q-mt-md">
    <div class="col-md-6 col-sm-12 q-pr-sm q-mb-sm">
        <q-input color="teal" filled v-model.number="form.price" label="Price" type="number">
            <template v-slot:prepend>
                <q-icon name="price_change" />
            </template>
        </q-input>
    </div>
    <div class="col-md-6 col-sm-12">
        <q-input color="teal" filled v-model.number="form.discounted_price" label="Discounted Price" type="number">
            <template v-slot:prepend>
                <q-icon name="price_change" />
            </template>
        </q-input>
    </div>
    <div class="col-md-6 col-sm-12 q-pr-sm q-my-sm">
        <q-input color="teal" filled v-model.number="form.cost" label="Purchased" type="number">
            <template v-slot:prepend>
                <q-icon name="price_change" />
            </template>
        </q-input>
    </div>
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
