<script>
export default {
    name: "ButtonLink",
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
    <a :class="`text-${type}-700 hover:text-white border border-${type}-700 hover:bg-${type}-800 focus:ring-4 focus:outline-none focus:ring-${type}-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2`" :href="href"><slot /></a>
</template>

<style scoped>

</style>
