<template>
    <div class="q-mx-md">
        <div class="row">
            <div class="col-12">
                <h4 class="q-my-sm">Payment types</h4>
                <q-btn
                    color="green"
                    label="Add"
                    icon="add"
                    outline
                    @click="addPayment"
                    class="q-mb-sm"
                />
            </div>
        </div>
    </div>
    <div class="q-mx-md">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <template v-if="list.length">
                    <q-card class="q-my-md" v-for="(payment, index) in list" :key="index">
                        <q-card-section>
                            <q-expansion-item>
                                <template v-slot:header>
                                    <q-item-section avatar>
                                        <q-avatar icon="payment" color="primary" text-color="white" />
                                    </q-item-section>

                                    <q-item-section>
                                        {{ payment.name ?? 'Payment type' }}
                                    </q-item-section>
                                    <q-item-section side>
                                        <div class="row items-center">
                                            <q-btn icon="delete" outline color="danger" @click="remove(payment.id as number)"></q-btn>
                                        </div>
                                    </q-item-section>
                                </template>
                                <payment-form :payment="payment" @save="save($event)"></payment-form>
                            </q-expansion-item>
                        </q-card-section>
                    </q-card>
                </template>
                <template v-else>
                    <q-separator class="q-my-md"></q-separator>
                    <span class="text-center block">Empty list!</span>
                </template>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue';
import usePaymentType from '../../../composables/payment-type';
import PaymentForm from '../../../components/pages/payment/PaymentForm.vue';

let { getList, list, remove, save } = usePaymentType();

function addPayment() {
    list.value.push({
        name: null,
        image: null,
        is_active: true,
        settings: []
    })
}



onMounted(() => {
    getList();
})
</script>
