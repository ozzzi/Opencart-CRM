<script>
import ButtonUi from "../../UI/ButtonUi.vue";
import {router} from "@inertiajs/vue3";

export default {
    name: "SearchFilter",
    components: {ButtonUi},
    props: {
        filters: {
            type: Array,
            default: () => []
        },
        stores: {
            type: Array,
            default: () => []
        },
        statuses: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            filter: {
                date_from: this.filters.date_from || '',
                date_to: this.filters.date_to || '',
                name: this.filters.name || '',
                phone: this.filters.phone || '',
                store: this.filters.store || '',
                status: this.filters.status || '',
                not_completed: this.filters.not_completed || ''
            },
            formRef: null
        }
    },
    methods: {
        applyFilter() {
            router.get('/requests', this.filter, {preserveState: true})
        },
        resetFilter() {
            Object.assign(this.filter, {
                date_from: '',
                date_to: '',
                name: '',
                phone: '',
                store: '',
                status: '',
                not_completed: ''
            })

            this.applyFilter()
        }
    },
    mounted() {
        this.formRef = this.$refs.formRef
    }
}
</script>

<template>
    <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5 mb-4">
        <form action="" id="filter" ref="formRef" @submit.prevent="applyFilter">
            <div class="flex gap-3">
                <div>
                    <input type="date" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        v-model="filter.date_from">
                </div>
                <div>
                    <input type="date" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        v-model="filter.date_to">
                </div>
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        v-model="filter.name" placeholder="Имя">
                </div>
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        v-model="filter.phone" placeholder="Телефон">
                </div>
            </div>
            <div class="flex gap-3 mt-3">
                <div>
                    <label for="store" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Магазин</label>
                    <select id="store" name="store" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            v-model="filter.store">
                        <option></option>
                        <option v-for="store in stores">{{ store }}</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Статус</label>
                    <select id="status" name="status" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        v-model="filter.status">
                        <option></option>
                        <option v-for="status in statuses"
                                :selected="status.external_id === filter.status"
                                :value="status.external_id">{{ status.name }}</option>
                    </select>
                </div>
                <div class="flex items-center gap-1">
                    <label for="new_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Незавершенные</label>
                    <input type="checkbox" id="new_status" name="not_completed"
                           v-model="filter.not_completed"
                           :false-value="null"
                           :true-value="true"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                </div>
            </div>
            <div class="mt-3">
                <button-ui type="submit">Поиск</button-ui>
                <button class="btn btn-danger btn-sm" @click.prevent="resetFilter">Сбросить
                </button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
