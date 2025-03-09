<script>
import Layout from "../../Layout.vue";
import {router} from "@inertiajs/vue3";
import ButtonUi from "../../UI/ButtonUi.vue";

export default {
    name: "Create",
    components: {ButtonUi},
    layout: Layout,
    props: ['stores', 'types', 'errors'],
    data() {
        return {
            form: {
                name: '',
                address: '',
                comment: '',
                is_bad: '',
                store: '',
                contacts: []
            },
            contact: {
                type: '',
                value: ''
            }
        }
    },
    methods: {
        submit() {
            router.post(this.route('clients.store'), this.form);
        },
        addContact() {
            this.form.contacts.push({type: this.contact.type, value: this.contact.value});
        },
        removeContact(index) {
            this.form.contacts.splice(index, 1);
        }
    }
}
</script>

<template>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">Создание клиента</h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">Главная /</a>
                </li>
                <li class="font-medium text-primary">
                    <a href="/clients">Клиенты</a>
                </li>
            </ol>
        </nav>
    </div>

    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                    <div class="mb-5">
                        <label for="inputName" class="block mb-2 text-sm font-medium text-gray-900">Имя</label>
                        <input type="text" id="inputName" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="inputAddress" class="block mb-2 text-sm font-medium text-gray-900">Адрес</label>
                        <input type="text" id="inputAddress" v-model="form.address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-5">
                        <label for="inputComment" class="block mb-2 text-sm font-medium text-gray-900">Комментарий</label>
                        <textarea id="inputComment" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                  v-model="form.comment"></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="selectStatus" class="block mb-2 text-sm font-medium text-gray-900">Магазин</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                v-model="form.store">
                            <option v-for="store in stores"
                                    :value="store">{{ store }}</option>
                        </select>
                        <p v-if="errors.store" class="mt-2 text-sm text-red-600">{{ errors.store }}</p>
                    </div>
                    <div class="mb-5">
                        <input id="checkboxBad" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                               v-model="form.is_bad"
                               :false-value="null"
                               :true-value="1">
                        <label for="checkboxBad" class="ms-2 text-sm font-medium text-gray-900 ">Проблемный клиент</label>
                    </div>
                    <button-ui type="submit">Сохранить</button-ui>
                </div>
            </div>
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default">
                    <div class="border-b border-stroke py-4 px-6.5">
                        <h3 class="font-medium text-black">Контакты</h3>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Контакт</th>
                                    <th scope="col" class="px-6 py-3"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white" v-for="(contact, index) in form.contacts" :key="contact.id">
                                        <td class="px-6 py-4">
                                            <strong>{{ contact.type }}</strong>: {{ contact.value }}
                                        </td>
                                        <td class="py-4 text-right">
                                            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg font-medium text-xs p-2.5 text-center inline-flex items-center me-2"
                                                    @click.prevent="removeContact(index)"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex-none">
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        v-model="contact.type">
                                    <option v-for="type in types"
                                            :value="type">{{ type }}</option>
                                </select>
                            </div>
                            <div class="grow">
                                <input type="text" id="inputContact" v-model="contact.value" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="flex-none">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg font-medium text-xs p-2.5 text-center inline-flex items-center me-2"
                                        @click.prevent="addContact()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p v-if="errors.contacts" class="mt-2 text-sm text-red-600">{{ errors.contacts }}</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
