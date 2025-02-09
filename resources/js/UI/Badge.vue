<script>
export default {
    name: "Badge",
    props: {
        type: {
            type: String,
            default: "blue"
        }
    }
}
</script>

<template>
<span :class="`bg-${type}-100 text-${type}-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded`">
    <slot />
</span>
</template>

<style scoped>

</style>
