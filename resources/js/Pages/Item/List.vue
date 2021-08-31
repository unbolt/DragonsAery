<template>
    <Head title="Items" />


    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <ItemSearch />

                        <ul id="items">
                            <li v-for="item in items" :key="item.int_id">
                                <ItemTooltip :item="item" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

import ItemSearch from '@/Components/ItemSearch.vue'
import ItemTooltip from '@/Components/ItemTooltip.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        ItemSearch,
        ItemTooltip,
    },
    props: {
        items: Object,
    },
}
</script>
