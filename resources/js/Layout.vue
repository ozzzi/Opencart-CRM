<script>
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";

export default {
    components: {
        Header,
        Sidebar
    }
}
</script>

<template>
    <div class="flex h-screen overflow-hidden">
        <Sidebar />
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <Header />
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>

</style>
