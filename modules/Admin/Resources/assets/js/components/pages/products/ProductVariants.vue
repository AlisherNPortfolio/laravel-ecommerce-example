<template>
    <product-variant-item
        v-for="(attr, index) in allAttributes"
        :key="index"
        :attribute="attr"
        @selected="getSelectedVariants"
        :selected-values="selectedAttributesOnUpdate[attr.id]"
    />
    <q-separator class="q-my-md" />
    <div v-if="form.variants.length > 0">
        <div v-for="(variant, xindex) in form.variants" :key="xindex">
            <div class="row" v-if="Object.keys(variant).length > 0">
                <div class="col-md-2 col-sm-12">
                    <span>{{ variant.name }}</span>
                </div>
                <div class="col-md-3 col-sm-12 q-mr-sm">
                    <q-input
                        filled
                        v-model="variant.sku"
                        label="Sku *"
                        lazy-rules
                        :rules="[
                        (val) => (val && val.length > 0) || 'Please type something',
                        ]"
                        class="q-my-md"
                    />
                </div>
                <div class="col-md-3 col-sm-12 q-mr-sm">
                    <q-input
                        filled
                        v-model.number="variant.quantity"
                        label="Quantity *"
                        type="number"
                        lazy-rules
                        :rules="[
                        (val) => (val && val > 0) || 'Please type something',
                        ]"
                        class="q-my-md"
                    />
                </div>
                <div class="col-md-3 col-sm-12 q-mr-sm">
                    <q-input
                        filled
                        v-model.number="variant.price"
                        label="Price *"
                        type="number"
                        lazy-rules
                        :rules="[
                        (val) => (val && val > 0) || 'Please type something',
                        ]"
                        class="q-my-md"
                    />
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12 col-sm-12">
                    <q-btn label="Save variants" type="button" color="primary" @click="save(form)" />
                </div>
            </div>
    </div>
</template>
<script setup lang="ts">
import { Ref, UnwrapNestedRefs, onMounted, reactive, ref, computed, PropType, watch } from 'vue';
import ProductVariantItem from './ProductVariantItem.vue';
import useAttribute from '../../../composables/attributes';
import { IProductAttributeValue, IProductSkuInDB } from '../../../contracts/pages/IProduct';
import ProductService from '../../../services/api/product-service';
import notify from '../../../helpers/notify';
interface IVariant {
    attribute_value_id: number,
    attribute_name: string
}

interface IVariantForm {
    product_id: number|null,
    variants: IProductAttributeValue[]
}
const props = defineProps({
    productId: {
        type: Number,
        required: true
    },
    variants: {
        type: Object as PropType<IProductSkuInDB[]>,
        default: () => []
    }
});

const form: UnwrapNestedRefs<IVariantForm> = reactive({
    product_id: props.productId,
    variants: []
});

const attribute_values: UnwrapNestedRefs<object> = reactive({});
const cartesianProducts: Ref<any[]> = ref([]);
const selectedAttributesOnUpdate = reactive({});

const {getAllAttributes, allAttributes} = useAttribute();
function getSelectedVariants(attribute: {values: number[], attribute: number}) {
    console.log('selected', attribute)
    if (attribute.values.length == 0) {
        delete attribute_values[`${attribute.attribute}`];
    }

    attribute.values.forEach(v => {
        if (attribute.values.length > 0 && !attribute_values.hasOwnProperty(attribute.attribute)) {
            attribute_values[`${attribute.attribute}`] = [];
        }

        insertNewAttr(v, attribute.attribute);
    });

    if (attribute_values[`${attribute.attribute}`] && attribute_values[`${attribute.attribute}`].length > 0) {
        attribute_values[`${attribute.attribute}`].forEach((v, i) => {
            if (!attribute.values.includes(v.attribute_value_id)) {
                attribute_values[`${attribute.attribute}`].splice(i, 1);
            }
        })
    }

    cartesianProducts.value = buildVariantCombinations(attribute_values);
    console.log('attribute_values', attribute_values, cartesianProducts.value)
    // console.log(attribute_values, cartesianProducts.value)
}
function insertNewAttr(v: number, attribute: number) {
    const newAttr = fillAttributeValue(v);
    if (!attribute_values[`${attribute}`]) {
        attribute_values[`${attribute}`] = [newAttr];
    } else {
        const index: number = (attribute_values[`${attribute}`] as []).findIndex((a: IVariant) => a.attribute_value_id == v);
        if (index > -1) {
            attribute_values[`${attribute}`][index] = newAttr;
        } else {
            attribute_values[`${attribute}`].push(newAttr);
        }
    }
}
function fillAttributeValue(attr_val_id: number): IVariant {
    const values: any[] = allAttributes.value.map(attr => {
                return attr.values.find(v => v.id == attr_val_id)
            }).filter(v => !!v);

    const attribute_value: IVariant = {
            attribute_value_id: attr_val_id,
            attribute_name: values[0].value
        }

    return attribute_value;
}

function buildVariantCombinations(attr_values) {
    return Object.values(attr_values).reduce((a: any[], b) =>
    // @ts-ignore
    a.map(x => b.map(y => x.concat(y)))
    .reduce((a, b) => a.concat(b), []), [[]]);
}

function save(form: IVariantForm) {
    console.log(form)
    ProductService.saveVariants(form)
    .then(res => {
        if (res.success) {
            notify.success('Saved');
        } else {
            notify.error('Error on saving variants!')
        }
    })
}

function whenOnEdit() {
    if (props.variants.length > 0) {
        props.variants.forEach(v => {
                const item: IProductAttributeValue = {name: "", sku: null, quantity: 0, price: null, values: []};

                v.values.forEach((val, i) => {
                    item.name += val.value + (i < v.values.length -1 ? " + " : '');
                    item.values.push(val.id);
                    if (selectedAttributesOnUpdate.hasOwnProperty(val.attribute_id) && !selectedAttributesOnUpdate[val.attribute_id].includes(val.id)) {
                        selectedAttributesOnUpdate[val.attribute_id].push(val.id);
                    } else if (!selectedAttributesOnUpdate.hasOwnProperty(val.attribute_id)) {
                        selectedAttributesOnUpdate[val.attribute_id] = [val.id];
                    }
                });

                item.sku = v.sku;
                item.quantity = v.quantity;
                item.price = v.price;

                form.variants.push(item);
            });
    }
}
onMounted(() => {
    getAllAttributes();
    whenOnEdit();
});

watch(cartesianProducts, () => {
    let variants: IProductAttributeValue[] = cartesianProducts.value.map(v => {
        const item: IProductAttributeValue = {name: null, sku: null, quantity: 0, price: null, values: []};
        if (v.length) {
            v.forEach((a: IVariant) => {
                if (!item.name) {
                    item.name = a.attribute_name;
                    // item.attribute_values
                } else {
                    item.name += " + " + a.attribute_name
                }
                item.values.push(a.attribute_value_id)
            });

            return item;
        }
    });

    variants = variants.filter(v => !!v);
    if (form.variants.length>0) {
        form.variants = [...form.variants, ...variants];
    } else {
        form.variants = JSON.parse(JSON.stringify(variants))
    }
})
</script>
