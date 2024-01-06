<template>
    <div class="q-mx-md">
        <div class="row">
            <div class="col-12">
                <h4 class="q-my-sm">Products</h4>
                <q-btn
                    color="green"
                    label="Add"
                    icon="add"
                    outline
                    to="/panel/products/add"
                    class="q-mb-sm"
                />
            </div>
        </div>
    </div>
    <div class="q-mx-md">
        <q-table
            flat bordered
            title="Products list"
            :rows="list"
            :columns="columns"
            row-key="name"
            :loading="loading"
            >
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn dense round flat color="grey" @click="$router.push({name: 'product-edit', params: {id: props.row.id}})" icon="edit"></q-btn>
                    <q-btn dense round flat color="grey" @click="remove(props.row.id)" icon="delete"></q-btn>
                </q-td>
            </template>
            <template v-slot:body-cell-is_active="props">
                <q-td :props="props">
                    <div class="q-py-sm q-px-md">
                        <q-badge color="green" v-if="props.value" label="Aktiv"></q-badge>
                        <q-badge color="red" v-else label="Aktiv emas"></q-badge>
                    </div>
                </q-td>
            </template>
        </q-table>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue';
import useProducts from '../../../composables/products';

let { getList, list, columns, remove } = useProducts();

    const loading = ref(false);

    onMounted(() => {
        getList();
    })
</script>
