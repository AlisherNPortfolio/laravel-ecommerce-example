<template>
    <div>
        <!-- <q-checkbox
            v-model="selectAllAttr"
            :label="attribute.name"
            color="teal"
            @update:model-value="selectAll()" /> -->
        <span>{{ attribute.name }}</span>
        <span class="q-mx-md">|</span>
        <q-checkbox
            v-for="(val, yindex) in attribute.values"
            v-model="attrValues"
            :val="(val.id as number)"
            :label="val.value"
            color="teal"
            :key="yindex"
            @update:model-value="selectSingle"
        />
    </div>
</template>
<script setup lang="ts">
import { PropType, Ref, onMounted, ref } from 'vue';
import { IAttribute } from '../../../contracts/pages/IAttribute';

const props = defineProps({
    attribute: {
        type: Object as PropType<IAttribute>,
        required: true
    },
    selectedValues: {
        type: Object as PropType<number[]>,
        default: () => []
    }
});

const emit = defineEmits(['selected']);

const selectedAll: Ref<boolean> = ref(false)
const selectAllAttr: Ref<boolean> = ref(false);
const attrValues: Ref<number[]> = ref([]);

function selectSingle(e: (number|null)[]) {
    const selectedVariants = e.filter(v => !!v);
console.log(selectedVariants, attrValues)
    mustAllSelect(selectedVariants.length);

    selectedVariants.forEach(v => {
        if (!attrValues.value.includes(v)) {
            attrValues.value.push(v);
        }
    })

    emit('selected', {values: attrValues.value, attribute: props.attribute.id});
}

function mustAllSelect(len: number) {
    selectAllAttr.value = len == props.attribute.values.length;
}

function selectAll() {
    selectedAll.value = !selectedAll.value;
    attrValues.value = [];
    if (selectedAll.value) {
        props.attribute.values.forEach((v, i) => {
            attrValues.value.push(v.id);
        });
    }
    emit('selected', {values: attrValues.value, attribute: props.attribute.id});
}

onMounted(() => {
    if (props.selectedValues.length > 0) {console.log('sss', props.selectedValues)
        attrValues.value = props.selectedValues;
    }
})
</script>
