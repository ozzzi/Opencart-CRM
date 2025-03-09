<script>
import Layout from "../../Layout.vue";
import Badge from "../../UI/Badge.vue";
import EditButton from "../../UI/EditButton.vue";
import DeleteButton from "../../UI/DeleteButton.vue";
import Pagination from "../../UI/Pagination.vue";
import ButtonLink from "../../UI/ButtonLink.vue";
import {router} from "@inertiajs/vue3";
import SearchFilter from "./SearchFilter.vue";

export default {
    name: "Index",
    components: {SearchFilter, Badge, ButtonLink, DeleteButton, EditButton, Pagination},
    props: ['clients', 'filters', 'stores'],
    layout: Layout,
    methods: {
        deleteItem(id) {
            router.delete(`/clients/${id}`, {
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
            Клиенты
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">Главная /</a>
                </li>
                <li class="font-medium text-primary">Клиенты</li>
            </ol>
        </nav>
    </div>

    <search-filter :filters="filters" :stores="stores" />

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                <div class="my-5">
                    <button-link type="blue" :href="route('clients.create')">Создать</button-link>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">Магазин</th>
                            <th scope="col" class="px-6 py-3">Имя</th>
                            <th scope="col" class="px-6 py-3">Телефон</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="client in clients.data"
                            :key="client.id"
                            :class="{'bg-red-400': client.is_bad}">
                            <td class="px-6 py-4">{{ client.id }}</td>
                            <td class="px-6 py-4">
                                <badge :type="client.storeColor">{{ client.store }}</badge>
                            </td>
                            <td class="px-6 py-4">{{ client.name }}</td>
                            <td class="px-6 py-4">{{ client.phone }}</td>
                            <td class="px-6 py-4">{{ client.email }}</td>
                            <td class="px-6 py-4 text-right">
                                <edit-button :href="route('clients.edit', client.id)" />
                                <delete-button @click.prevent="deleteItem(client.id)"></delete-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <pagination class="mt-5" :links="clients.links" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
