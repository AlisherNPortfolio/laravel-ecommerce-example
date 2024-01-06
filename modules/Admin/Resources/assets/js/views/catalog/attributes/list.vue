<template>
    <div class="q-mx-md">
        <div class="row">
            <div class="col-12">
                <h4 class="q-my-sm">Attribute methods</h4>
                <q-btn
                    color="green"
                    label="Add"
                    icon="add"
                    outline
                    to="/panel/attributes/add"
                    class="q-mb-sm"
                />
            </div>
        </div>
    </div>
    <div class="q-mx-md">
        <q-table
            flat bordered
            title="Attribute list"
            :rows="list"
            :columns="columns"
            row-key="name"
            :loading="loading"
            >
            <template v-slot:body-cell-values="props">
                <q-td :props="props">
                    <div class="q-py-sm q-px-md">
                        <q-badge
                            color="green"
                            v-for="(v, index) in props.value"
                            :label="v.value"
                            :key="index"
                            class="q-ml-sm q-py-sm q-px-md"
                        ></q-badge>
                    </div>
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn dense round flat color="grey" @click="$router.push({name: 'attribute-edit', params: {id: props.row.id}})" icon="edit"></q-btn>
                    <q-btn dense round flat color="grey" @click="deleteAttribute(props.row.id)" icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue';
import useAttribute from '../../../composables/attributes';

let { getList, columns, list, remove } = useAttribute();

    const loading = ref(false);


    function deleteAttribute(id: number) {
        remove(id);
    }

    onMounted(() => {
        getList();
    })
</script>
