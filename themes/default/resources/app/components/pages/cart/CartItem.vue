<template>
    <tr>
        <td class="align-middle"><img :src="(item.image as string)" alt="" style="width: 50px;"> {{ item.productName }}</td>
        <td class="align-middle">${{ item.price }}</td>
        <td class="align-middle">
            <div class="input-group quantity mx-auto" style="width: 100px;">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-primary btn-minus" @click="descrease(item)" >
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
                <input v-model="item.qty" type="text" class="form-control form-control-sm bg-secondary border-0 text-center">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-primary btn-plus" @click="increase(item)">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </td>
        <td class="align-middle">${{ item.total }}</td>
        <td class="align-middle">
            <button class="btn btn-sm btn-danger" @click="remove(item)">
                <i class="fa fa-times"></i>
            </button>
        </td>
    </tr>
</template>
<script setup lang="ts">
import type { PropType } from 'vue';
import type { ICart } from "~/contracts/pages/ICart"

const props = defineProps({
    item: {
        type: Object as PropType<ICart>,
        required: true
    }
});

const emit = defineEmits(['delete', 'updateItem'])

function remove(item: ICart) {
    emit('delete', item)
}

function descrease(item: ICart) {console.log('decrease', item)
    if (item.qty && item.qty > 0) {
        item.qty--;
        (item.total as number) -= item.price as number;

        if (item.qty == 0) {
            remove(item);
            return;
        }

        updateItem(item);
    }
}
function increase(item: ICart) {console.log('increase', item)
    if (item.qty) {
        item.qty++;
        (item.total as number) += item.price as number;
        updateItem(item);
    }
}

function updateItem(item: ICart) {
    emit('updateItem', item);
}
</script>
