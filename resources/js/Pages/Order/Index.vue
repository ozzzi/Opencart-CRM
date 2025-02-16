<script>
import Layout from "../../Layout.vue";
import Badge from "../../UI/Badge.vue";
import Pagination from "../../UI/Pagination.vue";
import ShowButton from "../../UI/ShowButton.vue";

export default {
    name: "Index",
    components: {ShowButton, Pagination, Badge},
    props: ['orders'],
    layout: Layout
}
</script>

<template>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">Заказы</h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">Глпвная /</a>
                </li>
                <li class="font-medium text-primary">Заказы</li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">order_id</th>
                            <th scope="col" class="px-6 py-3">Магазин</th>
                            <th scope="col" class="px-6 py-3">Имя</th>
                            <th scope="col" class="px-6 py-3">Телефон</th>
                            <th scope="col" class="px-6 py-3">Статус</th>
                            <th scope="col" class="px-6 py-3">Сумма</th>
                            <th scope="col" class="px-6 py-3">Дата создания</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders.data"
                            :key="order?.id">
                            <td class="px-6 py-4">{{ order.id }}</td>
                            <td class="px-6 py-4">{{ order.order_id }}</td>
                            <td class="px-6 py-4">
                                <badge :type="order.storeColor">{{ order.store }}</badge>
                            </td>
                            <td class="px-6 py-4">{{ order.name }}</td>
                            <td class="px-6 py-4">{{ order.phone }}</td>
                            <td class="px-6 py-4">{{ order.status?.name }}</td>
                            <td class="px-6 py-4">{{ order.total }}</td>
                            <td class="px-6 py-4">{{ order.date_added }}</td>
                            <td class="px-6 py-4 text-right">
                                <show-button :href="route('orders.show', order.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </show-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <pagination class="mt-5" :links="orders.links" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
