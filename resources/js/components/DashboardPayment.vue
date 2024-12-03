<template>
    <section class="py-3 mb-5">
        <span class="d-block mb-5">Home/Payment History</span>
        <h3 class="mb-4">Payment History</h3>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Method</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="border-start border-end" v-if="transactions.length > 0">
                    <tr v-for="transaction in transactions" :key="transaction">
                        <td>{{ transaction.enrollment_id }}</td>
                        <td>{{ transaction.name }}</td>
                        <td>{{ shortTitle(transaction.course_title) }}</td>
                        <td>{{ transaction.payment_method }}</td>
                        <td>{{ transaction.payment_amount }}</td>
                        <td class="text-success">{{ transaction.status }}</td>
                    </tr>
                </tbody>
                <tbody class="border-start border-end" v-else>
                    <tr>
                        <td colspan="6" class="text-center text-danger">there is no payment history found!</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<style lang="scss" scoped>
.table {
    thead {
        tr {
            th {
                background-color: #677388;
                color: white;
                padding: 1rem;
                font-weight: normal;

                &:first-child {
                    border-top-left-radius: .7rem;
                }

                &:last-child {
                    border-top-right-radius: .7rem;
                }
            }
        }
    }

    tbody {
        tr {
            td {
                padding: 1rem;
            }
        }
    }
}
</style>

<script setup>
import { useAuthStore } from '@/stores/auth'
import { ref } from 'vue';
const authStore = useAuthStore()

let transactions = ref({})

axios.get(`/transactions`, {
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + authStore.authToken
    }
}).then((res) => {
    transactions.value = res.data.data.transactions
})

function shortTitle(title) {
    return title.length > 30 ? title.slice(0, 30) + '...' : title
}
</script>
