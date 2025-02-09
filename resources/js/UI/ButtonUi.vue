<script>
export default {
    name: "ButtonUi",
    props: {
        type: {
            type: String,
            default: "button"
        },
        color: {
            type: String,
            default: "blue"
        }
    }
}
</script>

<template>
    <button :type="type" :class="`text-white hover:text-white bg-${color}-700 hover:bg-${color}-800 border border-${color}-700 hover:bg-${color}-800 focus:ring-4 focus:outline-none focus:ring-${color}-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2`"><slot /></button>
</template>

<style scoped>

</style>
