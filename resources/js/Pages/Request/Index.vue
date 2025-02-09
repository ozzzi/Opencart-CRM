<script>
import Layout from "../../Layout.vue";
import ButtonLink from "../../UI/ButtonLink.vue";
import Badge from "../../UI/Badge.vue";
import Pagination from "../../UI/Pagination.vue";
import SearchFilter from "./SearchFilter.vue";
import EditButton from "../../UI/EditButton.vue";
import DeleteButton from "../../UI/DeleteButton.vue";
import {router} from "@inertiajs/vue3";

export default {
    components: {DeleteButton, EditButton, SearchFilter, Pagination, Badge, ButtonLink},
    props: ['requests', 'filters', 'stores', 'statuses'],
    layout: Layout,
    methods: {
        deleteItem(id) {
            router.delete(`/requests/${id}`, {
                preserveScroll: true,
                preserveState: true,
                onBefore: () => confirm('Вы уверены?')
            });
        }
    }
}
</script>

<template>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">
            Запросы
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">Главная</a>
                </li>
                <li class="font-medium text-primary">Запросы</li>
            </ol>
        </nav>
    </div>

    <search-filter :filters="filters" :stores="stores" :statuses="statuses" />

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                <div class="my-5">
                    <button-link type="blue" :href="route('requests.create')">Создать</button-link>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">Магазин</th>
                            <th scope="col" class="py-3"></th>
                            <th scope="col" class="px-6 py-3">Заказ</th>
                            <th scope="col" class="px-6 py-3">Статус</th>
                            <th scope="col" class="px-6 py-3">Имя</th>
                            <th scope="col" class="px-6 py-3">Телефон</th>
                            <th scope="col" class="px-6 py-3">Дата</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in requests.data"
                            :key="item?.id"
                            :class="{'bg-blue-400': item?.isNew }">
                            <td class="px-6 py-4">{{ item.id }}</td>
                            <td class="px-6 py-4">
                                <badge :type="item.storeColor">{{ item.store }}</badge>
                            </td>
                            <td class="py-4">
                                <span v-if="item.tracking" :class="`bg-${item.tracking?.color}-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded`">
                                            {{ item.tracking?.title }}
                                        </span>
                            </td>
                            <td class="px-6 py-4">
                                <a v-if="item.order_id" :href="route('orders.show', item.order_id)">{{ item.order_id }}</a>
                            </td>
                            <td class="px-6 py-4">{{ item.status?.name }}</td>
                            <td class="px-6 py-4">{{ item.name }}</td>
                            <td class="px-6 py-4">{{ item.phone }}</td>
                            <td class="px-6 py-4 text-xs">{{ item.date_added }}</td>
                            <td class="px-6 py-4 text-right">
                                <edit-button :href="route('requests.edit', item.id)" />
                                <delete-button @click.prevent="deleteItem(item.id)"></delete-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <pagination class="mt-5" :links="requests.links" />
            </div>
        </div>
    </div>
</template>

