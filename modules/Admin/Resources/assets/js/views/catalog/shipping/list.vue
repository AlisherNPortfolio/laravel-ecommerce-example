<template>
    <div class="q-mx-md">
        <div class="row">
            <div class="col-12">
                <h4 class="q-my-sm">Shipping methods</h4>
                <q-btn
                    color="green"
                    label="Add"
                    icon="add"
                    outline
                    to="/panel/shippings/add"
                    class="q-mb-sm"
                />
            </div>
        </div>
    </div>
    <div class="q-mx-md">
        <q-table
            flat bordered
            title="Shipping list"
            :rows="list"
            :columns="columns"
            row-key="name"
            :loading="loading"
            >
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn dense round flat color="grey" @click="$router.push({name: 'shipping-edit', params: {id: props.row.id}})" icon="edit"></q-btn>
                    <q-btn dense round flat color="grey" @click="deleteShipping(props.row.id)" icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue';
import useShipping from '../../../composables/shipping';

let { getList, columns, list, remove } = useShipping();

    const loading = ref(false);


    function deleteShipping(id: number) {
        remove(id);
    }

    onMounted(() => {
        getList();
    })
</script>
