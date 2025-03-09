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
        }
    },
    data() {
        return {
            filter: {
                name: this.filters.name || '',
                contact: this.filters.contact || '',
                address: this.filters.address || '',
                store: this.filters.store || '',
                is_bad: this.filters.is_bad || ''
            },
            formRef: null
        }
    },
    methods: {
        applyFilter() {
            router.get('/clients', this.filter, {preserveState: true})
        },
        resetFilter() {
            Object.assign(this.filter, {
                name: '',
                contact: '',
                address: '',
                store: '',
                is_bad: ''
            })

            this.applyFilter()
        }
    },
    mounted() {
        this.formRef = this.$refs.form
    }
}
</script>

<template>
    <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5 mb-4">
        <form action="" id="filter" ref="formRef" @submit.prevent="applyFilter">
            <div class="flex gap-3">
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Имя"
                        v-model="filter.name">
                </div>
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Контакт"
                        v-model="filter.contact">
                </div>
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Адрес"
                        v-model="filter.address">
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
                <div class="flex items-center gap-1">
                    <label for="bad-status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Проблемный клиент</label>
                    <input type="checkbox" id="bad-status"
                           v-model="filter.is_bad"
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
