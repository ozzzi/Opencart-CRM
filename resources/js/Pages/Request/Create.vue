<script>
import Layout from "../../Layout.vue";
import {router} from "@inertiajs/vue3";
import ButtonUi from "../../UI/ButtonUi.vue";

export default {
    name: "Create",
    components: {ButtonUi},
    layout: Layout,
    props: ['stores', 'statuses', 'shipments', 'errors'],
    data() {
        return {
            form: {
                name: '',
                phone: '',
                comment: '',
                store: '',
                status_id: '',
                shipment: {
                    type: '',
                    number: '',
                }
            },
        }
    },
    methods: {
        submit() {
            router.post(this.route('requests.store'), this.form);
        }
    }
}
</script>

<template>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">Создание заявки</h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">Главная /</a>
                </li>
                <li class="font-medium text-primary">Заявки</li>
            </ol>
        </nav>
    </div>

    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-2">
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                    <div class="mb-5">
                        <label for="inputName" class="block mb-2 text-sm font-medium text-gray-900">Имя</label>
                        <input type="text" id="inputName" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="inputPhone" class="block mb-2 text-sm font-medium text-gray-900">Телефон</label>
                        <input type="text" id="inputPhone" v-model="form.phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <p v-if="errors.phone" class="mt-2 text-sm text-red-600">{{ errors.phone }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="inputComment" class="block mb-2 text-sm font-medium text-gray-900">Комментарий</label>
                        <textarea id="inputComment" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                  v-model="form.comment"></textarea>
                        <p v-if="errors.comment" class="mt-2 text-sm text-red-600">{{ errors.comment }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="selectStatus" class="block mb-2 text-sm font-medium text-gray-900">Статус</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                v-model="form.status_id">
                            <option v-for="status in statuses"
                                    :value="status.external_id">{{ status.name }}</option>
                        </select>
                        <p v-if="errors.status_id" class="mt-2 text-sm text-red-600">{{ errors.status_id }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="selectStatus" class="block mb-2 text-sm font-medium text-gray-900">Магазин</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                v-model="form.store">
                            <option v-for="store in stores"
                                    :value="store">{{ store }}</option>
                        </select>
                    </div>
                    <button-ui type="submit">Сохранить</button-ui>
                </div>
            </div>
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default">
                    <div class="border-b border-stroke py-4 px-6.5">
                        <h3 class="font-medium text-black">ТТН</h3>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5">
                        <div class="flex gap-2">
                            <div class="flex-none">
                                <label for="input-number" class="block mb-2 text-sm font-medium text-gray-900">Доставка</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        v-model="form.shipment.type">
                                    <option value=""></option>
                                    <option v-for="shipment in shipments"
                                            :value="shipment">{{ shipment }}</option>
                                </select>
                            </div>
                            <div class="grow">
                                <label for="input-number" class="block mb-2 text-sm font-medium text-gray-900">Номер</label>
                                <input type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ТТН"
                                       v-model="form.shipment.number"
                                       id="input-number">
                                <p v-if="errors['shipment.number']" class="mt-2 text-sm text-red-600">{{ errors['shipment.number'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
