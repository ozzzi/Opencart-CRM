<script>
export default {
    name: "EditButton",
    props: {
        type: {
            type: String,
            default: "blue"
        },
        href: {
            type: String,
            default: "#"
        }
    }
}
</script>

<template>
    <a :href="href" :class="`px-3 py-2 text-${type}-700 border border-${type}-700 hover:bg-${type}-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs text-center inline-flex items-center me-2`">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg>
    </a>
</template>

<style scoped>

</style>
