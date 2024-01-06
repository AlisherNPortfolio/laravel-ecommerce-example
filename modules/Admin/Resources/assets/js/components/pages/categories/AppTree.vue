<template>
    <q-tree
        :nodes="tree"
        :node-key="props.nodeKey"
        :label-key="props.labelKey"
        :tick-strategy="props.checkType"
        v-model:selected="selected"
        v-model:ticked="checkeds"
        v-model:expanded="expanded"
        @update:ticked="ticked"
        default-expand-all
        selected-color="teal"
        control-color="teal-10"
        :model-value="props.modelValue"
        ref="appTree"
    >

    </q-tree>
</template>
<script setup lang="ts">
type LeafType = "leaf"|"strict"|"none";
import { computed, onMounted, PropType, ref, Ref } from "vue";
import { ICategoryTree } from "../../../contracts/pages/IBanners";
import ITree, { ITreeFields } from "../../../contracts/nested-set/ITree";
import tree_maker from "../../../helpers/tree-maker";

const props = defineProps({
    data: {
        type: Array as PropType<ICategoryTree[]>,
        default: () => []
    },
    nodeKey: {
        type: String,
        default: 'id'
    },
    labelKey: {
        type: String,
        default: 'label'
    },
    checkboxAll: {
        type: Boolean,
        default: false
    },
    modelValue: {
        type: Number,
        default: null
    },
    checkType: {
        type: String as PropType<LeafType>,
        default: 'strict'
    }
});
const appTree = ref(null)

const emit = defineEmits(['update:modelValue'])

const treeFields: ITreeFields[] = [
    {tree_key: 'slug', data_key: 'slug'},
    {tree_key: 'id', data_key: 'id'},
    {tree_key: 'avatar', data_key: 'icon'}
];

const allKeys: number[] = []

let checkeds: Ref<number[]> = ref([]);
let selected: Ref<string|null> = ref(null)
let expanded: Ref<string[]> = ref([]);


function ticked(k: number[]) {
    if (k.length == 0) return;

    const emitValues: number[] = [...k];
    const emitValue: number = emitValues.pop() as number;

    if (k.length == 2) {
        appTree.value.setTicked(emitValues, false);
    }

    emit('update:modelValue', emitValue);
}

const tree = computed(() => {
    return readyTree;
});

let readyTree: ITree[] = tree_maker(props.data, treeFields, props.checkboxAll);

onMounted(() => {
    if (props.modelValue) {
        appTree.value.setTicked([props.modelValue], true)
    }
})

// const keys: number[] = [];
// function getAllTreeKeys(data: ICategoryTree[]) {
//     for (let child of data) {
//         keys.push(child[props.nodeKey])
//         if (child.children && child.children.length) {
//             getAllTreeKeys(child.children);
//         }
//     }
// }
// getAllTreeKeys(props.data)
// console.log('keys', keys)
</script>
