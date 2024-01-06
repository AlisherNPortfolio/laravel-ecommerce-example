<template>
    <table class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark">
            <tr>
                <th>Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <CartItem
                v-for="(item, index) in list"
                :item="item"
                :key="index"
                @delete="removeItem"
                @update-item="updateItem"
            />
        </tbody>
    </table>
</template>
<script setup lang="ts">
import type { ICart } from '~/contracts/pages/ICart';
import CartItem from './CartItem.vue';

const emit = defineEmits(['cartItems']);
const {getList, list} = useCart();

const cartItems: Ref<ICart[]> = ref([
    {
        productName: "Camera",
        productId: 1,
        price: 150,
        qty: 1,
        total: 150,
        image: "assets/img/product-1.jpg"
    },
    {
        productId: 2,
        productName: "Ko'ylak",
        price: 150,
        qty: 1,
        total: 150,
        image: "assets/img/product-2.jpg"
    },
    {
        productId: 3,
        productName: "Chiroq",
        price: 150,
        qty: 1,
        total: 150,
        image: "assets/img/product-3.jpg"
    },
    {
        productId: 4,
        productName: "Snickers",
        price: 150,
        qty: 1,
        total: 150,
        image: "assets/img/product-4.jpg"
    },
    {
        productId: 5,
        productName: "Drone",
        price: 150,
        qty: 1,
        total: 150,
        image: "assets/img/product-5.jpg"
    }
]);

function removeItem(item: ICart) {
    list.value = list.value.filter(c => c.productId != item.productId);
    emitCartItems();
}

function updateItem(item: ICart) {
    const updatedItemIndex: number = cartItems.value.findIndex(i => i.productId == item.productId);

    // if (updatedItemIndex > -1) {
    //     cartItems.value[updatedItemIndex] = item;
    //     emitCartItems();
    // }
}

function emitCartItems() {
    emit('cartItems', JSON.parse(JSON.stringify(list.value)))
}

onMounted(() => {
    getList();
    emitCartItems();
})
</script>
